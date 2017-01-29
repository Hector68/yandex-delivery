<?php

namespace Hector68\YandexDelivery\entity;


trait traitAsArray
{
    /**
     * @return array
     */
    public function asArray()
    {
        $reflect = new \ReflectionClass($this);
        $props = $reflect->getProperties(\ReflectionProperty::IS_PROTECTED);
        $result = [];
        foreach ($props as $prop) {
            $val = $this->{$prop->getName()};
            if (is_array($val) === true) {
                $resTmp = [];
                foreach ($val as $k => $v) {
                    if($v instanceof interfaceAsArray) {
                        $resTmp[$k] = $v->asArray();
                    } else {
                        $resTmp[$k] = $v;
                    }
                }
                $val = $resTmp;

            } elseif (is_object($val) === true) {
                if ($val instanceof interfaceAsArray) {
                    $val = $val->asArray();
                } else {
                    $val = null;
                }
            }
            if ($val !== null) {
                $result[$prop->getName()] = $val;
            }
        }
        return $result;
    }
}