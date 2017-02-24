<?php

namespace Hector68\YandexDelivery\config;


/**
 * Interface InterfaceYdConfigure
 * @package Hector68\YandexDelivery\config
 */
interface InterfaceYdConfigure
{

    /**
     * @return string
     */
    public function getApiServer();
    
    /**
     * @return int
     */
    public function getDefaultWeight();

    /**
     * @return int
     */
    public function getDefaultLength();

    /**
     * @return int
     */
    public function getDefaultWidth();

    /**
     * @return int
     */
    public function getDefaultHeight();


    /**
     * @return string
     */
    public function getClientId();

    /**
     * @return string
     */
    public function getSenderId();

    /**
     * @return string
     */
    public function getRequisiteId();

    /**
     * @return string
     */
    public function getWarehouseId();

    /**
     * @return array
     */
    public function getMethodKeys();
    
    /**
     * @return int
     */
    public function getDefaultYdWarehouse();
    
}