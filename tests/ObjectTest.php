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

class ObjectTest extends \PHPUnit_Framework_TestCase
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

    public function testSimpleItem()
    {
        $item = new Item([
            'orderitem_name' => 'Test',
            'orderitem_quantity' => '2'
        ]);
        $result = $item->asArray();
        $this->assertTrue($item->getOrderitemQuantity() === 2);
        $this->assertTrue($result['orderitem_name'] === 'Test');
    }


    public function testItemWithWeight()
    {
        $item =  new Item([
            'orderitem_name' => 'Test2',
            'orderitem_quantity' => 1,
            'orderitem_cost' => rand(1,500),
            'orderitem_weight' => 2.6,
            'orderitem_length' => 5.34,
            'orderitem_width' => 54,5,
            'orderitem_height' => 23.33
        ]);

        $this->assertTrue($item->hasWeightInfo());
    }


    public function addDeliveryWidgetProvider()
    {
        return [
            [
                file_get_contents(dirname(__FILE__) . '/ydWidgetResponse1.json'),
            ],
            [
                file_get_contents(dirname(__FILE__) . '/ydWidgetResponse2.json'),
            ]
        ];
    }


    /**
     * @dataProvider addDeliveryWidgetProvider
     */
    public function testDeliveryFromWidget($response)
    {
        $data = json_decode($response, true);
        $delivery = YdHelper::getDeliveryFromWidgetResponse($data);

        $this->assertInstanceOf(Delivery::class, $delivery );

    }


    public function testSimpleOrder()
    {
        $order_items = [
            new Item([
                'orderitem_name' => 'Test',
                'orderitem_quantity' => '2',
                'orderitem_weight' => 2.6,
                'orderitem_length' => 5.34,
                'orderitem_width' => 54,5,
                'orderitem_height' => 23.33
            ]),
            new Item([
                'orderitem_name' => 'Test2',
                'orderitem_quantity' => 1,
                'orderitem_weight' => 2.6,
                'orderitem_length' => 5.34,
                'orderitem_width' => 54,5,
                'orderitem_height' => 23.33
            ])
        ];

        $delivery = new Delivery(
            [
                'to_yd_warehouse' => 1,
                'pickuppoint' => null,
                'delivery' => 1385,
                'tariff' => 1565,
                'direction' => 699,
                'interval' => 3421
            ]
        );

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


        $order = new Order(
            [
                'order_num' => '2',
                'order_shipment_type' => 'todoor',
                'order_items' => $order_items,
                'delivery' => $delivery,
                'deliverypoint' => $deliverypoint,
                'recipient' => $recipient,

            ],
            $this->config
        );

        $resultArray = $order->asArray();
        
        $this->assertTrue($order->getOrderWidth() > 0);
        
        $this->assertTrue($order instanceof interfaceOrder);

        $this->assertTrue($order->getRecipient() == $recipient);

        $this->assertTrue(is_array($resultArray));

        $this->assertEquals('Имя', $resultArray['recipient']['first_name']);

        $this->assertEquals('Москва', $resultArray['deliverypoint']['city']);

        $this->assertEquals(1385, $resultArray['delivery']['delivery']);

    }




}