<?php

namespace Hector68\YandexDelivery\entity;


use Hector68\YandexDelivery\config\InterfaceYdConfigure;

/**
 * Class Order
 * @package Hector68\YandexDelivery\entity
 */
class Order implements interfaceOrder, interfaceAsArray
{
    use traitAsArray;

    use traitSetObject;

    use traitConstruct;

    /**
     * @var int Номер заказа магазина (не больше 15 цифр)
     */
    protected $order_num;

    /**
     * @var double Вес заказа, кг
     */
    protected $order_weight;

    /**
     * @var int Длина заказа, см (округляется до целого в большую сторону)
     */
    protected $order_length;

    /**
     * @var int Ширина заказа, см (округляется до целого в большую сторону)
     */
    protected $order_width;

    /**
     * @var int Высота заказа, см (округляется до целого в большую сторону)
     */
    protected $order_height;

    /**
     * @var int Объявленная ценность, руб.
     */
    protected $order_assessed_value;

    /**
     * @var string Стоимость доставки, руб.
     */
    protected $order_delivery_cost;

    /**
     * @var bool (1) Стоимость доставки устанавливается вручную (0) Применяются условия доставки из настроек
     */
    protected $is_manual_delivery_cost = 0;

    /**
     * @var double Сумма предоплаты по заказу, руб.
     */
    protected $order_amount_prepaid;

    /**
     * @var string 03-13 (string) - Дата отгрузки заказа
     */
    protected $order_shipment_date;

    /**
     * @var string Способ доставки заказа todoor Курьером; pickup Самовывоз; post Почтой России
     */
    protected $order_shipment_type;

    /**
     * @var string Комментарий к заказу
     */
    protected $order_comment;

    /**
     * @var array|Item[]
     */
    protected $order_items;

    /**
     * @var Delivery
     */
    protected $delivery;

    /**
     * @var DeliveryPoint
     */
    protected $deliverypoint;

    /**
     * @var Recipient
     */
    protected $recipient;

    /**
     * @var InterfaceYdConfigure
     */
    protected $configYd;


    /**
     * @var int Отгрузка на единый склад/на склад службы доставки
     */
    protected $to_yd_warehouse;


    protected $hasItemsWeightInfoFlag;

    /**
     * @return int
     */
    public function getOrderNum()
    {
        return $this->order_num;
    }

    /**
     * @return float
     */
    public function getOrderWeight()
    {
        if($this->hasItemsWeightInfo() ) {
            $this->order_weight = 0;
            foreach ($this->getOrderItems() as $item) {
                $this->order_weight += ($item->getOrderitemWeight() * $item->getOrderitemQuantity());
            }
            $this->order_weight = ceil($this->order_weight);
        }
        return $this->order_weight;
    }

    /**
     * @return int
     */
    public function getOrderLength()
    {
        if(empty($this->order_length) && $this->hasItemsWeightInfo() ) {
            $this->order_length = 0;
            foreach ($this->getOrderItems() as $item) {
                $this->order_length = max($this->order_length , ceil($item->getOrderitemLength()));
            }
        }
        return $this->order_length;
    }

    /**
     * @return int
     */
    public function getOrderWidth()
    {
        if($this->hasItemsWeightInfo() ) {
            $this->order_width = 0;
            foreach ($this->getOrderItems() as $item) {
                $this->order_width = max($this->order_width , ceil($item->getOrderitemWidth()));
            }
        }
        return $this->order_width;
    }

    /**
     * @return int
     */
    public function getOrderHeight()
    {
        if($this->hasItemsWeightInfo() ) {
            $this->order_height = 0;
            foreach ($this->getOrderItems() as $item) {
                $this->order_height = max($this->order_height ,  ceil($item->getOrderitemHeight()));
            }
        }
        return $this->order_height;
    }

    /**
     * @return int
     */
    public function getOrderAssessedValue()
    {
        return $this->order_assessed_value;
    }

    /**
     * @return string
     */
    public function getOrderDeliveryCost()
    {
        return $this->order_delivery_cost;
    }

    /**
     * @return boolean
     */
    public function isIsManualDeliveryCost()
    {
        return $this->is_manual_delivery_cost;
    }

    /**
     * @return float
     */
    public function getOrderAmountPrepaid()
    {
        return $this->order_amount_prepaid;
    }

    /**
     * @return string
     */
    public function getOrderShipmentDate()
    {
        return $this->order_shipment_date;
    }

    /**
     * @return string
     */
    public function getOrderShipmentType()
    {
        return $this->order_shipment_type;
    }

    /**
     * @return string
     */
    public function getOrderComment()
    {
        return $this->order_comment;
    }

    /**
     * @return array|Item[]
     */
    public function getOrderItems()
    {
        return $this->order_items;
    }

    /**
     * @return Delivery
     */
    public function getDelivery()
    {
        return $this->delivery;
    }

    /**
     * @return DeliveryPoint
     */
    public function getDeliverypoint()
    {
        return $this->deliverypoint;
    }

    /**
     * @return Recipient
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * @return int
     */
    public function getToYdWarehouse()
    {
        return $this->to_yd_warehouse;
    }

    /**
     * Возвращает все ли дочернии итемы имеют информацию о весе и размере
     * @return bool
     */
    protected function hasItemsWeightInfo()
    {

        if ($this->hasItemsWeightInfoFlag === null) {
            foreach ($this->getOrderItems() as $item) {
                if ($item instanceof Item && $item->hasWeightInfo()) {
                    $this->hasItemsWeightInfoFlag = true;
                } else {
                    $this->hasItemsWeightInfoFlag = false;
                    break;
                }
            }
        }
        return $this->hasItemsWeightInfoFlag;
    }

}