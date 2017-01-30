<?php

namespace Hector68\YandexDelivery\entity;


/**
 * Class Item
 * @package Hector68\YandexDelivery\entity
 */
class Item implements interfaceAsArray, interfaceYandexOrderItem
{
    use traitAsArray;

    use traitSetObject;
    
    use traitConstruct;

    /**
     * @var string
     */
    protected $orderitem_name;
    /**
     * @var int
     */
    protected $orderitem_quantity;
    /**
     * @var int
     */
    protected $orderitem_cost;
    /**
     * @var int
     */
    protected $orderitem_id;
    /**
     * @var string
     */
    protected $orderitem_article;
    /**
     * @var double
     */
    protected $orderitem_weight;
    /**
     * @var double
     */
    protected $orderitem_length;
    /**
     * @var double
     */
    protected $orderitem_width;

    /**
     * @var double
     */
    protected $orderitem_height;

    /**
     * @return string
     */
    public function getOrderitemName()
    {
        return $this->orderitem_name;
    }

    /**
     * @return int
     */
    public function getOrderitemQuantity()
    {
        return $this->orderitem_quantity;
    }

    /**
     * @return float
     */
    public function getOrderitemCost()
    {
        return $this->orderitem_cost;
    }

    /**
     * @return int
     */
    public function getOrderitemId()
    {
        return $this->orderitem_id;
    }

    /**
     * @return string
     */
    public function getOrderitemArticle()
    {
        return $this->orderitem_article;
    }

    /**
     * @return float
     */
    public function getOrderitemWeight()
    {
        return $this->orderitem_weight;
    }

    /**
     * @return float
     */
    public function getOrderitemLength()
    {
        return $this->orderitem_length;
    }

    /**
     * @return float
     */
    public function getOrderitemWidth()
    {
        return $this->orderitem_width;
    }

    /**
     * @return float
     */
    public function getOrderitemHeight()
    {
        return $this->orderitem_height;
    }



}