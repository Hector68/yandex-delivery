<?php

namespace Hector68\YandexDelivery\entity;

interface interfaceYandexOrderItem
{
    /**
     * @return string
     */
    public function getOrderitemName();

    /**
     * @return int
     */
    public function getOrderitemQuantity();

    /**
     * @return int
     */
    public function getOrderitemCost();

    /**
     * @return int
     */
    public function getOrderitemId();

    /**
     * @return string
     */
    public function getOrderitemArticle();

    /**
     * @return float
     */
    public function getOrderitemWeight();
    /**
     * @return float
     */
    public function getOrderitemLength();

    /**
     * @return float
     */
    public function getOrderitemWidth();

    /**
     * @return float
     */
    public function getOrderitemHeight();

    /**
     * @return array
     */
    public function asArray();
}