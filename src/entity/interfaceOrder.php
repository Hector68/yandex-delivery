<?php

namespace Hector68\YandexDelivery\entity;


interface interfaceOrder
{
    /**
     * @return int
     */
    public function getOrderNum();

    /**
     * @return float
     */
    public function getOrderWeight();

    /**
     * @return int
     */
    public function getOrderLength();

    /**
     * @return int
     */
    public function getOrderWidth();

    /**
     * @return int
     */
    public function getOrderHeight();

    /**
     * @return int
     */
    public function getOrderAssessedValue();

    /**
     * @return string
     */
    public function getOrderDeliveryCost();

    /**
     * @return boolean
     */
    public function isIsManualDeliveryCost();

    /**
     * @return float
     */
    public function getOrderAmountPrepaid();

    /**
     * @return string
     */
    public function getOrderShipmentDate();

    /**
     * @return string
     */
    public function getOrderShipmentType();

    /**
     * @return string
     */
    public function getOrderComment();

    /**
     * @return array|interfaceYandexOrderItem[]
     */
    public function getOrderItems();

    /**
     * @return Delivery
     */
    public function getDelivery();

    /**
     * @return DeliveryPoint
     */
    public function getDeliverypoint();

    /**
     * @return Recipient
     */
    public function getRecipient();

    /**
     * @return int
     */
    public function getToYdWarehouse();
    
    /**
     * @return array
     */
    public function asArray();
    
}