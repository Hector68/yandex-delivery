<?php

namespace Hector68\YandexDelivery\entity;


/**
 * Class Delivery
 * @package Hector68\YandexDelivery\entity
 */
class Delivery implements interfaceAsArray
{
    use traitAsArray;

    use traitSetObject;

    use traitConstruct;

    /**
     * @var int
     */
    protected $to_yd_warehouse = 1;
    /**
     * @var int ID пункта выдачи
     */
    protected $pickuppoint;
    /**
     * @var int ID тарифа доставки
     */
    protected $tariff;
    /**
     * @var int ID службы доставки
     */
    protected $delivery;
    /**
     * @var int ID направления доставки
     */
    protected $direction;
    /**
     * @var int ID интервала доставки
     */
    protected $interval;

}