<?php

namespace Hector68\YandexDelivery\config;


/**
 * Class ApiConfig
 * @package Hector68\YandexDelivery\config
 */
class ApiConfig extends AbstractConfig
{

    /**
     * @var string
     */
    private $api_server = 'https://delivery.yandex.ru/api/last/';


    /**
     * ApiConfig constructor.
     * @param $jsonMethodKeys
     * @param $jsonClientData
     */
    public function __construct($jsonMethodKeys, $jsonClientData)
    {
        $this->method_keys = json_decode($jsonMethodKeys, true);
        $clientData = json_decode($jsonClientData, true);

        $this->client_id = $clientData['client']['id'];
        $this->warehouse_id = $clientData['warehouses'][0]['id'];
        $this->sender_id = $clientData['senders'][0]['id'];
        $this->requisite_id = $clientData['requisites'][0]['id'];
    }


    /**
     * @return string
     */
    public function getApiServer()
    {
        return $this->api_server;
    }
}