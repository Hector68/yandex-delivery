<?php

namespace Hector68\YandexDelivery\config;


/**
 * Class AbstractConfig
 * @package Hector68\YandexDelivery\config
 */
abstract class AbstractConfig implements InterfaceYdConfigure
{

    /**
     * @var string
     */
    protected $client_id = '####';
    /**
     * @var string
     */
    protected $sender_id = '###';
    /**
     * @var string
     */
    protected $requisite_id = '###';
    /**
     * @var string
     */
    protected $warehouse_id = '###';

    /**
     * @var array
     *
     * this array unical for every account, need keep secret
     */
    protected $method_keys = [];

    /**
     * @var int
     */
    protected $defaultWeight = 1;

    /**
     * @var int
     */
    protected $defaultLength = 15;

    /**
     * @var int
     */
    protected $defaultWidth = 15;

    /**
     * @var int
     */
    protected $defaultHeight = 15;

    /**
     * @var int Отгрузка на единый склад/на склад службы доставки
     */
    protected $defaultYdWarehouse = 1;

    /**
     * @return string
     */
    abstract public function getApiServer();
    

    /**
     * @return int
     */
    public function getDefaultWeight()
    {
        return $this->defaultWeight;
    }

    /**
     * @return int
     */
    public function getDefaultLength()
    {
        return $this->defaultLength;
    }

    /**
     * @return int
     */
    public function getDefaultWidth()
    {
        return $this->defaultWidth;
    }

    /**
     * @return int
     */
    public function getDefaultHeight()
    {
        return $this->defaultHeight;
    }


    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->client_id;
    }

    /**
     * @return string
     */
    public function getSenderId()
    {
        return $this->sender_id;
    }

    /**
     * @return string
     */
    public function getRequisiteId()
    {
        return $this->requisite_id;
    }

    /**
     * @return string
     */
    public function getWarehouseId()
    {
        return $this->warehouse_id;
    }

    /**
     * @return array
     */
    public function getMethodKeys()
    {
        return $this->method_keys;
    }

    /**
     * @return int
     */
    public function getDefaultYdWarehouse()
    {
        return (int) $this->defaultYdWarehouse;
    }
    
}