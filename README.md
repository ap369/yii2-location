Yii2 location extension
====================================================================================================
Retrieve a user's location from their IP address using an external web services

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require ap369/yii2-location dev-master
```

or add

```
"ap369/yii2-location": "dev-master"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, use it in your code like this:

```php
$position = Location::get('44.85.3.2'); 

echo $position->latitude;
echo $position->longitude;

```

If you don't provide an IP address, it will default to `Yii::$app->request->userIP`.

Additionally, you can chose what driver will be used to resolve the IP
address location, by passing its class as the second parameter.

```php
$position =  Location::get('44.85.3.2', FreeGeoIp::class);
```

You can also pass `null` as the address to have it automatically resolved:

```php
$position =  Location::get(null,GeoPlugin::class); // position from GeoPluin
```

Supported drivers
-----------------

Currently, the following drivers are supported by this extension:

* IpInfo (default)
* GeoPlugin
* FreeGeoIp

Acknowledgment
--------------

This extension is based on [stevebauman/location](https://github.com/stevebauman/location) laravel extension.
