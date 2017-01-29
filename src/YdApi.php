<?php

namespace Hector68\YandexDelivery;


use Hector68\YandexDelivery\config\InterfaceYdConfigure;
use Hector68\YandexDelivery\entity\interfaceOrder;
/**
 * @author Dmitriy Ronzhin <hector.tmb@gmail.com>
 * @author Obukhov.S <proweb50@gmail.com>
 */
class YdApi
{

    /**
     * @var InterfaceYdConfigure
     */
    private $config;


    /**
     * YdApi constructor.
     * @param InterfaceYdConfigure $config
     */
    public function __construct(InterfaceYdConfigure $config)
    {
        $this->config = $config;
        
    }



    /**
     * @param $method_name
     * @param array $arParams
     * @return bool true|false
     *
     * check for the required parameters of the method
     */
    private function isRequireParams($method_name, $arParams = Array())
    {
        //todo check params with yandex api, because yandex api can get more params.
        $RequireParam = Array();
        $RequireParam["getPaymentMethods"] = Array("secret_key", "client_id", "sender_id");
        $RequireParam["getSenderOrders"] = Array("secret_key", "client_id", "sender_id");
        $RequireParam["getSenderOrderLabel"] = Array("secret_key", "client_id", "sender_id", "order_id");
        $RequireParam["getSenderParcelDocs"] = Array("secret_key", "client_id", "sender_id", "parcel_id");
        $RequireParam["autocomplete"] = Array("secret_key", "client_id", "sender_id", "term", "type");
        $RequireParam["getIndex"] = Array("secret_key", "client_id", "sender_id", "address");
        $RequireParam["createOrder"] = Array("secret_key", "client_id", "sender_id", "order_num");
        $RequireParam["updateOrder"] = Array();
        $RequireParam["deleteOrder"] = Array("secret_key", "client_id", "sender_id", "order_id");
        $RequireParam["getSenderOrderStatus"] = Array("secret_key", "client_id", "sender_id", "order_id");
        $RequireParam["getSenderOrderStatuses"] = Array("secret_key", "client_id", "sender_id", "order_id");
        $RequireParam["getSenderInfo"] = Array("secret_key", "client_id", "sender_id");
        $RequireParam["getWarehouseInfo"] = Array("secret_key", "client_id", "sender_id", "warehouse_id");
        $RequireParam["getRequisiteInfo"] = Array("secret_key", "client_id", "sender_id", "requisite_id");
        $RequireParam["getIntervals"] = Array("secret_key", "client_id", "sender_id", "shipment_date", "delivery_name", "shipment_type");
        $RequireParam["createWithdraw"] = Array("secret_key", "client_id", "sender_id", "requisite_id", "shipment_date", "interval", "delivery_name", "warehouse_from_id", "weight", "volume", "type", "sort");
        $RequireParam["confirmSenderOrders"] = Array("client_id", "sender_id", "order_ids", "shipment_date", "type");
        $RequireParam["updateWithdraw"] = Array();
        $RequireParam["createImport"] = Array("secret_key", "client_id", "sender_id", "requisite_id", "shipment_date", "interval", "delivery_name", "warehouse_from_id", "weight", "volume", "import_type", "name", "sort");
        $RequireParam["updateImport"] = Array();
        $RequireParam["getDeliveries"] = Array("secret_key", "client_id", "sender_id");
        $RequireParam["getOrderInfo"] = Array("secret_key", "client_id", "sender_id", "order_id");
        $RequireParam["searchDeliveryList"] = Array("secret_key", "client_id", "sender_id", "city_from", "city_to", "weight", "height", "width", "length");  //todo check params
        $RequireParam["confirmSenderParcels"] = Array("secret_key", "client_id", "sender_id", "parcel_ids");
        if (array_intersect($arParams, $RequireParam[$method_name]) == $RequireParam[$method_name])
            return true;
        else return false;
    }
    /**
     * @param $method
     * @return mixed
     *
     * get secret method-key for method by him Name
     */
    private function getMethodKeyByName($method)
    {
        return htmlspecialchars($this->config->getMethodKeys()[$method]);
    }
    /**
     * @param bool|false $show_value
     * @return array
     *
     * get a list of available methods
     */
    private function getMethodList($show_value = false)
    {
        $methods = Array();
        if ($show_value == true) {
            foreach ($this->config->getMethodKeys() as $method_name => $method_key) {
                $methods[$method_name] = $method_key;
            }
        } else {
            foreach ($this->config->getMethodKeys() as $method_name => $method_key) {
                $methods[] = $method_name;
            }
        }
        return $methods;
    }
    /**
     * @param $method
     * @param array $arParams
     * @return string
     *
     * calculate secret_key by yandex delivery api algorithm
     */
    private function getSecretKey($method, $arParams = Array())
    {
        $secret_key = '';
        $keys = array_keys($arParams);
        sort($keys);
        foreach ($keys as $key) {
            if (!is_array($arParams[$key])) {
                $secret_key .= $arParams[$key];
            } else {
                $subkeys = array_keys($arParams[$key]);
                sort($subkeys);
                foreach ($subkeys as $subkey) {
                    if (!is_array($arParams[$key][$subkey])) {
                        $secret_key .= $arParams[$key][$subkey];
                    } else {
                        $subsubkeys = array_keys($arParams[$key][$subkey]);
                        sort($subsubkeys);
                        foreach ($subsubkeys as $subsubkey) {
                            if (!is_array($arParams[$key][$subkey][$subsubkey])) {
                                $secret_key .= $arParams[$key][$subkey][$subsubkey];
                            }
                        }
                    }
                } //end foreach
            }// endif
        }
        $secret_key = md5($secret_key . $this->getMethodKeyByName($method));
        return $secret_key;
    }
    /**
     * @param $method
     * @param $arParams
     * @return bool|string
     *
     * collect input params from array in query line (use in jQuery ajax)
     */
    private function getQuery($method, $arParams = Array())
    {
        $secret_key = $this->getSecretKey($method, $arParams);
        /** query формируется неправильно, раз мы имеем массивы
         * сортировка впринципе не нужна
         */
        $arParams["secret_key"] = $secret_key;
        return http_build_query($arParams);
    }
    /**
     * @param $method
     * @param array $arParams
     * @return mixed
     *
     */
    protected function getCurlResult($method, $arParams = Array())
    {
        $string = $this->getQuery($method, $arParams);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->config->getApiServer() . $method);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        #notice this string for only test version without https
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded"));
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }
    /**
     * @param array $query
     * @param string $separator
     * @param string $nbsp
     * @param bool|false $lastExclude
     * @param array $exclude
     * @return bool|string
     *
     * connects the incoming words from the array specified delimiter
     * may ask the gaps at the separator (param $nbsp, example: ' & ' or '&')
     * $lastExclude avoids adding separator before the last element
     * $exclude avoids adding separator before custom serial number element from array
     */
    private function concat($query = Array(), $separator = 'AND', $nbsp = '', $lastExclude = false, $exclude = Array())
    {
        if (!empty($query)) {
            $result = '';
            if ($nbsp != '') $nbsp = ' ';
            $last_elem = count($query);
            $last_elem2 = count($query) - 1;
            if ($last_elem > 2) {
                foreach ($query as $k => $elem) {
                    #before first element and before define elements does not need set concatenation
                    if (
                        (($k == 0) || (in_array($k, $exclude))) &&
                        ($k != $last_elem2)
                    ) {
                        $result .= trim($elem);
                    } #processing last iteration
                    elseif (($k == $last_elem2) && ($lastExclude == true)) {
                        $result .= trim($elem);
                    } elseif (($k == $last_elem2) && ($lastExclude == false)) {
                        $result .= $nbsp . $separator . $nbsp . trim($elem);
                    } #coustom case
                    else {
                        $result .= $nbsp . $separator . $nbsp . trim($elem);
                    }
                }
                return $result;
            } elseif ($last_elem == 2) {
                if ($lastExclude == false) {
                    return trim($query[0]) . $nbsp . $separator . $nbsp . trim($query[1]);
                } else {
                    return trim($query[0]) . $nbsp . trim($query[1]);
                }
            } elseif ($last_elem == 1) return trim($query[0]);
        } else {
            return false;
        }
    }


    /**
     * @return array
     */
    public function getOrderRequisite()
    {
        $params = Array('client_id' => $this->config->getClientId(), 'sender_id' => $this->config->getSenderId(), 'requisite_id' => $this->config->getRequisiteId());
        $r = $this->getCurlResult('getRequisiteInfo', $params);
        $order_width = $r["data"]["promoRequest"]["width"];
        $order_height = $r["data"]["promoRequest"]["height"];
        $order_length = $r["data"]["promoRequest"]["length"];
        $weight = $r["data"]["promoRequest"]["weight"];
        $result = Array('width' => $order_width, 'height' => $order_height, 'length' => $order_length, 'weight' => $weight);
        return $result;
    }


    /**
     * @param $city_from
     * @param $city_to
     * @param $weight
     * @param $length
     * @param $width
     * @param $height
     * @param $assessed_value
     * @param $order_cost
     * @return mixed
     */
    public function searchDeliveryList($city_from, $city_to, $weight, $length, $width, $height, $assessed_value, $order_cost)
    {
        $searchParams = [
            'client_id' => $this->config->getClientId(),
            'sender_id' => $this->config->getSenderId(),
            'requisite_id' => $this->config->getRequisiteId(),
            'city_from' => $city_from,
            'city_to' => $city_to,
            'weight' => $weight,
            'length' => $length,
            'width' => $width,
            'height' => $height,
            'assessed_value' => $assessed_value,
            'order_cost' => $order_cost
        ];

        return $this->getCurlResult('searchDeliveryList', $searchParams);
    }


    /**
     * @param interfaceOrder $order
     * @return mixed
     */
    public function createOrder(interfaceOrder $order)
    {
        $orderResult = [
            'client_id' => $this->config->getClientId(),
            'sender_id' => $this->config->getSenderId(),
        ];

        if (empty($order->getOrderWeight()) && !empty($this->config->getDefaultWeight())) {
            $orderResult['order_weight'] = $this->config->getDefaultWeight();
        }

        if (empty($order->getOrderWeight()) && !empty($this->config->getDefaultWidth())) {
            $orderResult['order_width'] = $this->config->getDefaultWeight();
        }

        if (empty($order->getOrderHeight()) && !empty($this->config->getDefaultHeight())) {
            $orderResult['order_height'] = $this->config->getDefaultHeight();
        }

        if (empty($order->order_length) && !empty($this->config->getDefaultLength())) {
            $orderResult['order_length'] = $this->config->getDefaultHeight();
        }

        $params = array_merge(
            $order->asArray(),
            $orderResult
        );

        return $this->getCurlResult('createOrder', $params);
    }


}