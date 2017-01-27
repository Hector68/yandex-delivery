<?php

namespace Hector68\YandexDelivery\config;


class DebugConfig extends AbstractConfig
{
    /**
     * @var string
     */
    private $api_server = 'https://private-anon-b4b8e6d6c8-yandexdelivery.apiary-mock.com/api/last/';

    /**
     * DebugConfig constructor.
     */
    public function __construct()
    {
        $this->method_keys =  [
            "getPaymentMethods" => "#####",
            "getSenderOrders" => "#####",
            "getSenderOrderLabel" => "#####",
            "getSenderParcelDocs" => "#####",
            "autocomplete" => "#####",
            "getIndex" => "#####",
            "createOrder" => "#####",
            "updateOrder" => "#####",
            "deleteOrder" => "#####",
            "getSenderOrderStatus" => "#####",
            "getSenderOrderStatuses" => "#####",
            "getSenderInfo" => "#####",
            "getWarehouseInfo" => "#####",
            "getRequisiteInfo" => "#####",
            "getIntervals" => "#####",
            "createWithdraw" => "#####",
            "confirmSenderOrders" => "#####",
            "updateWithdraw" => "#####",
            "createImport" => "#####",
            "updateImport" => "#####",
            "getDeliveries" => "#####",
            "getOrderInfo" => "#####",
            "searchDeliveryList" => "#####",
            "confirmSenderParcels" => "#####"
        ];
    
    }

    public function getApiServer()
    {
        return $this->api_server;
    }


}