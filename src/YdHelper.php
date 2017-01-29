<?php

namespace Hector68\YandexDelivery;


use Hector68\YandexDelivery\entity\Delivery;

/**
 * Class YdHelper
 * @package Hector68\YandexDelivery
 */
class YdHelper
{
    /**
     * @param $response
     * @return Delivery|null
     */
    public static function getDeliveryFromWidgetResponse($response)
    {
        $data = json_decode($response, true);

        if (isset($data['type'], $data['is_pickup_point'], $data['tariffId'], $data['delivery']['id'], $data['direction'])) {
            $deliveryParams = [
                'pickuppoint' => isset($data['pickuppointId']) ? $data['pickuppointId'] : null,
                'tariff' => $data['tariffId'],
                'delivery' => $data['delivery']['id'],
                'direction' => $data['direction'],
            ];
            return new Delivery($deliveryParams);
        }

        return null;
    }
}