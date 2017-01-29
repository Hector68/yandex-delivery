# yandex-delivery


Базовый класс для поиска точек и создания заказов
Примеры создания заказов, можно посмотреть в тестах

Пример использования

1. Настраивает ApiConfig, где $method_keys и $data - текстовые поля, которые берутся в личном кабинете
```php
$config = \Hector68\YandexDelivery\config\ApiProxyConfig($method_keys, $data);
```

2. Формируем заказ
```php

 $order_items = [
            new Item([
                'orderitem_name' => 'Test',
                'orderitem_quantity' => '2',
                'orderitem_cost' => rand(1,500)
            ]),
            new Item([
                'orderitem_name' => 'Test2',
                'orderitem_quantity' => 1,
                'orderitem_cost' => rand(1,500)
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


        $order = new Order(
            [
                'order_num' => '2',
                'order_items' => $order_items,
                'delivery' => $delivery,
                'deliverypoint' => $deliverypoint,
                'recipient' => $recipient,

            ]
        );

        $api = new YdApi($config);


        $result = $api->createOrder($order);
```

```YdHelper::getDeliveryFromWidgetResponse($response)``` Получает объект класса Delivery, из данных который получает корзинный виджет.