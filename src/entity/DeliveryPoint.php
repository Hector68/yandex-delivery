<?php


namespace Hector68\YandexDelivery\entity;


/**
 * Class DeliveryPoint
 * @package Hector68\YandexDelivery\entity
 */
class DeliveryPoint  implements interfaceAsArray
{
    use traitAsArray;

    use traitSetObject;

    use traitConstruct;

    /**
     * @var string
     */
    protected $city;
    /**
     * @var int
     */
    protected $geo_id;
    /**
     * @var string
     */
    protected $index;
    /**
     * @var string
     */
    protected $street;
    /**
     * @var string
     */
    protected $house;
    /**
     * @var string
     */
    protected $housing;
    /**
     * @var string
     */
    protected $building;
    /**
     * @var string
     */
    protected $porch;
    /**
     * @var string
     */
    protected $floor;
    /**
     * @var string
     */
    protected $flat;
    /**
     * @var string
     */
    protected $comment;
    /**
     * @var string
     */
    protected $station;
}