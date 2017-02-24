<?php

namespace Hector68\YandexDelivery\Tests;

use Hector68\YandexDelivery\config\InterfaceYdConfigure;
use Hector68\YandexDelivery\entity\Delivery;
use Hector68\YandexDelivery\entity\DeliveryPoint;
use Hector68\YandexDelivery\entity\interfaceOrder;
use Hector68\YandexDelivery\entity\Item;
use Hector68\YandexDelivery\entity\Order;
use Hector68\YandexDelivery\entity\Recipient;
use Hector68\YandexDelivery\YdApi;
use Hector68\YandexDelivery\YdHelper;

/**
 * Class ApiTest
 * @package Hector68\YandexDelivery\Tests
 */
class ApiTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var YdApi
     */
    protected $api;

    /**
     * @var InterfaceYdConfigure
     */
    protected $config;

    /**
     *
     */
    protected function setUp()
    {
        $this->config = include(dirname(__FILE__) . '/_get_config.php');
        $this->api = new YdApi($this->config);
    }

    /**
     *
     */
    public function testSearchPoints()
    {

        $result = $this->api->searchDeliveryList('Москва', 'Москва', 2, 10, 10, 10, 500, 500);

        $this->assertNotNull($result);

        $this->assertTrue(isset($result['status']));

        $this->assertTrue(isset($result['data']));

        $this->assertTrue(empty($result['data']) == false);


    }

    public function addDataProvider()
    {
        $order_items = [
            new Item([
                'orderitem_name' => 'Test',
                'orderitem_quantity' => '2',
                'orderitem_cost' => 22.66,
                'orderitem_weight' => 2.6,
                'orderitem_length' => 5.34,
                'orderitem_width' => 54,5,
                'orderitem_height' => 23.33
            ]),
            new Item([
                'orderitem_name' => 'Test2',
                'orderitem_quantity' => 1,
                'orderitem_cost' => rand(1,500),
                'orderitem_weight' => 2.6,
                'orderitem_length' => 5.34,
                'orderitem_width' => 54,5,
                'orderitem_height' => 23.33
            ]),
            new Item([
                'orderitem_name' => 'Test2',
                'orderitem_quantity' => 1,
                'orderitem_cost' => rand(1,500),
                'orderitem_weight' => 2.7,
                'orderitem_length' => 5.34,
                'orderitem_width' => 54,5,
                'orderitem_height' => 23.33
            ])
        ];

        $deliverypoint = new DeliveryPoint([
            'city' => 'Москва',
            'street' => 'Советская 20'
        ]);

        $recipient = new Recipient([
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'phone' => '+7999999999',
            'email' => 'test@test.ru'
        ]);


        $deliveryTodor = new Delivery(
            [
                'to_yd_warehouse' => 1,
                'pickuppoint' => null,
                'delivery' => 1385,
                'tariff' => 1565,
                'direction' => 699,
                'interval' => 3421
            ]
        );

        $deliveryPickup = new Delivery(
            [
                'to_yd_warehouse' => 1,
                'pickuppoint' => 249518,
                'delivery' => 1498,
                'tariff' => 1568,
                'direction' => 6,
                'interval' => 3337
            ]
        );


        $response1 = file_get_contents(dirname(__FILE__).'/ydWidgetResponse1.json');
        $response2 =  file_get_contents(dirname(__FILE__).'/ydWidgetResponse2.json');
        $deliveryTodorFromYdWidget = YdHelper::getDeliveryFromWidgetResponse(json_decode($response1, true));
        $deliveryPickupFromYdWidget =  YdHelper::getDeliveryFromWidgetResponse(json_decode($response2, true));




        return [
            [$order_items, $deliveryTodor, $deliverypoint, $recipient],
            [$order_items, $deliveryPickup, $deliverypoint, $recipient],
            [$order_items, $deliveryTodorFromYdWidget, $deliverypoint, $recipient],
            [$order_items, $deliveryPickupFromYdWidget, $deliverypoint, $recipient],
        ];
    }

    /**
     * @dataProvider addDataProvider
     */
    public function testCreateOrder($order_items, $delivery, $deliverypoint, $recipient )
    {
        $order = new Order(
            [
                'order_num' => '2',
                'order_items' => $order_items,
                'delivery' => $delivery,
                'deliverypoint' => $deliverypoint,
                'recipient' => $recipient,

            ],
            $this->config
        );


        $this->assertTrue($order->getOrderWidth() > 0);

        $result = $this->api->createOrder($order);

        $this->assertTrue(is_array($result));

        $this->assertNotEmpty($result);

        $this->assertEquals('ok', $result['status']);
    }
    

}