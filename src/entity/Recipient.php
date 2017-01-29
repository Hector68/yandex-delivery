<?php


namespace Hector68\YandexDelivery\entity;


/**
 * Class Recipient Получатель заказа
 * @package Hector68\YandexDelivery\entity
 */
class Recipient  implements interfaceAsArray
{

    use traitAsArray;

    use traitSetObject;

    use traitConstruct;
    
    /**
     * @var string
     */
    protected $first_name;
    /**
     * @var string
     */
    protected $last_name;
    /**
     * @var string
     */
    protected $middle_name;
    /**
     * @var int
     */
    protected $is_company;
    /**
     * @var string
     */
    protected $company_name;
    /**
     * @var string
     */
    protected $company_inn;
    /**
     * @var string
     */
    protected $phone;
    /**
     * @var string
     */
    protected $additional_phone;
    /**
     * @var string
     */
    protected $email;
    /**
     * @var string
     */
    protected $comment;
}