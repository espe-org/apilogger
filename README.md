# API Logger

This is a small package that can helps in debugging api logs. It can log 
request method, url, duration, request payload, which models are retrieved, controller and method. 


##  Installation

1. In composer.json
    "require": {
        ....
        "espe-org/apilogger":"*"
    },
        "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/espe-org/apilogger"
        }
    ]
    


2. Publish the config file with:

```bash
php artisan vendor:publish --tag=config --provider="AWT\Providers\ApiLogServiceProvider"
```

You can also configure which fields should not be logged like passwords, secrets, etc.

***You dont need to migrate if you are just using file driver***

```bash
php artisan migrate
```

3. Add middleware named ***apilogger*** to the route or controller you want to log data

```php
//in route.php or web.php
Route::middleware('apilogger')->post('/test',function(){
    return response()->json("test");
});
```

4. Dashboard can be accessible via ***yourdomain.com/apilogs***

## Clear the logs

You can permenently clear the logs by using the following command.
```bash
php artisan apilog:clear
```
## Implement your own log driver

From copy example/Apilogs to you app
In apilog.php edit driver to \App\Apilogs\RESTLogger::class

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
