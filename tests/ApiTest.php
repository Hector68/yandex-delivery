<?php

namespace Hector68\YandexDelivery\Tests;

use Hector68\YandexDelivery\config\DebugConfig;
use Hector68\YandexDelivery\YdApi;

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

    protected function setUp()
    {
        $config = new DebugConfig();
        $this->api = new YdApi($config);
    }

    public function testRunCommand()
    {

        $result = $this->api->searchDeliveryList('Москва', 'Москва', 2, 10, 10, 10, 500, 500);

        $this->assertNotNull($result);

        $this->assertTrue(isset($result['status']));

        $this->assertTrue(isset($result['data']));

        $this->assertTrue(!empty($result['data']));


    }

}