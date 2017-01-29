<?php

namespace Hector68\YandexDelivery\entity;


trait traitConstruct
{
    /**
     * @param array $params
     */
    public function __construct($params = [])
    {
        $this->loadData($params);
    }
}