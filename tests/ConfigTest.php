<?php


namespace Hector68\YandexDelivery\Tests;


use Hector68\YandexDelivery\config\DebugConfig;
use Hector68\YandexDelivery\config\InterfaceYdConfigure;
use Hector68\YandexDelivery\YdApi;

class ConfigTest extends \PHPUnit_Framework_TestCase
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
        $this->config = new DebugConfig();
        $this->api = new YdApi($this->config);

    }

    public function testInterface()
    {
        $this->assertInstanceOf(InterfaceYdConfigure::class, $this->config);
    }

    public function testDefaultData()
    {

        $this->assertEquals($this->config->getWarehouseId(), '###');

        $this->assertEquals($this->config->getDefaultWeight(), 1);
        $this->assertEquals($this->config->getDefaultHeight(), 15);
        $this->assertEquals($this->config->getDefaultWidth(), 15);
        $this->assertEquals($this->config->getDefaultLength(), 15);

        $this->config->setDefaultData(2,10,34,66);

        $this->assertEquals($this->config->getDefaultWeight(), 2);
        $this->assertEquals($this->config->getDefaultHeight(), 10);
        $this->assertEquals($this->config->getDefaultWidth(), 34);
        $this->assertEquals($this->config->getDefaultLength(), 66);
    }





}