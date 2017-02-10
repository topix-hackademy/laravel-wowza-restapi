



# Fast readme

composer require topix-hackademy/laravel-wowza-restapi
    
config/app.php

    'providers' => [
        ..
        Topix\Hackademy\LaravelWowza\ServiceProvider::class,
        ..
         ]
        
    'aliases' => [
    ..
        'LaravelWowza' => \Topix\Hackademy\LaravelWowza\Facade::class,
        ]
        

# Official docs

pip install -r requirements.txt
cd documentation
mkdocs serve