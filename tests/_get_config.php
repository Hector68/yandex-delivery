<?php

if(is_file(dirname(__FILE__).'/_get_config_local.php')) {
    return include (dirname(__FILE__).'/_get_config_local.php');
}
return new \Hector68\YandexDelivery\config\DebugConfig();