<?php

namespace Hector68\YandexDelivery\entity;


trait traitSetObject
{
    
    public function loadData($params = [])
    {
        $reflect = new \ReflectionClass($this);
        $props = $reflect->getProperties(\ReflectionProperty::IS_PROTECTED);
        foreach ($props as $prop) {
            $propName = $prop->getName();
            if (isset($params[$propName])) {
                $val = $params[$propName];
                if ($val !== null) {
                    if (preg_match('/@var\s+([^\s]+)/', $prop->getDocComment(), $matches)) {
                        list(, $type) = $matches;
                        switch ($type) {
                            case 'string':
                                $val = (string)$val;
                                break;
                            case 'int':
                                $val = (int)$val;
                                break;
                            case 'double':
                                $val = (double)$val;
                                break;
                            case 'array':
                                $val = (array) $val;
                                break;
                        }
                    }
                    $this->{$propName} = $val;
                }
            }
        }
        
    }

}