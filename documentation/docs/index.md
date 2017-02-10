# Welcome to Laravel Wowza Api Documentation

This package aim is to provide a transparent method to interact with Wowza apis

# Installation
 
`composer require topix-hackademy/laravel-wowza-restapi`

In order to use the facade add in config/app.php

    'providers' => [
        ..
        Topix\Hackademy\LaravelWowza\ServiceProvider::class,
        ..
         ]
        
    'aliases' => [
    ..
        'LaravelWowza' => \Topix\Hackademy\LaravelWowza\Facade::class,
        ]
        

# Usage

The Facade expose the methods of WowzaHandlerSdk to prepare the call of the apis

- `credentials`: pass username and password to authorize api on wowza server. `LaravelWowza::credentials($user, $passoword)`
- `url`: pass the url of the wowza server. `LaravelWowza::url($url)`
- `port`: pass the port on which the api are configured. `LaravelWowza::port($port)`


All these methods returns the instance of the handler itself so it allows to create nice concatenation

    $wowzaHandler = LaravelWowza::credentials($user, $passoword)
        ->url($url)->port($port);
                
The method `with` allow to insert the Api class that will call the api with its own methods and return the results. It return as well the instance of the main WowzaHandlerSdk.

When the handler is fully parametrized you can use the method of the api class directly from the handler, that will forward the call to the object that was passed in the method `with` 

    LaravelWowza::credentials($user, $passoword)
    ->url($url)->port($port)->with(WowzaConnectionCount::class)->connectionCounts();
                
Changing the wrapped object it's possible to use the same configuration more time.

    $wowzaHandler->with(VserversApi::class)->getServersConfig();
    $wowzaHandler->with(VserversserverNamevhostsApi::class)->getVHostsConfig($serverName);
                
                
In the with method you can use every api class of Wowza Rest Api package.

