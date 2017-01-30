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
     * @return int
     */
    public function getOrderitemWeight();
    /**
     * @return int
     */
    public function getOrderitemLength();

    /**
     * @return int
     */
    public function getOrderitemWidth();

    /**
     * @return int
     */
    public function getOrderitemHeight();

    /**
     * @return array
     */
    public function asArray();
}