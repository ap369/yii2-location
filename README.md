Yii2 location extension
====================================================================================================
Retrieve a users location from their IP address using external web services

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist ap369/yii2-location "*"
```

or add

```
"ap369/yii2-location": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
use ap369\yii2location\Location;

use ap369\yii2location\Drivers\GeoPlugin;
use ap369\yii2location\Drivers\IpInfo;
use ap369\yii2location\Drivers\FreeGeoIp;

```
```php
$position = Location::get(); 

echo $position->latitude;
echo $position->longitude;

```

With given IP address : 

```php
$position = Location::get('44.85.3.2'); 
```

Choosing the Driver : 

You can use one of three drivers to get position data : GeoPlugin, IpInfo, FreeGeoIp


```php
$position =  Location::get(null,GeoPlugin::class); // position from GeoPluin
$position =  Location::get('44.85.3.2',FreeGeoIp::class);  // position from FreeGeoIp

```


This extension is based on stevebauman/location laravel extention.
https://github.com/stevebauman/location





