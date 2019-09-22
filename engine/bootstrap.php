<?php

require_once __DIR__.'/../vendor/autoload.php';

use engine\cms;
use engine\di\di;

try{
    //Объект ди
    $di = new di();

    $services = require __DIR__.'/config/service.php';

    foreach ($services as $service)
    {
        $provider = new $service($di);
        $provider->init();
    }

    $cms = new cms($di);

    $cms->run();

} catch(\ErrorException $e){
    echo $e->getMessage();
}