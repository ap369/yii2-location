<?php

namespace ap369\yii2location;

use ap369\yii2location\Drivers\Driver;
use ap369\yii2location\Drivers\FreeGeoIp;
use ap369\yii2location\Drivers\GeoPlugin;
use ap369\yii2location\Drivers\IpInfo;
use yii\base\NotSupportedException;


/**
 * Location class
 */
class Location /*extends \yii\base\Widget*/
{

    /**
     * @return Position|false
     */
    public static function get($ip = null,$driver = null){

        if($ip == null) $ip = \Yii::$app->request->getUserIP();
        if($driver == null) $driver = "IpInfo";

        return self::getLocation($ip,$driver);
    }

    /**
     * @param $ip string
     * @param $driverClass string
     * @return Position|bool
     */
    public  static  function getLocation($ip,$driverClass) {
        $driver = self::getDriver($driverClass);
        return $driver->get($ip);
    }


    /**
     * Returns the specified driver.
     *
     * @param string $driver
     *
     * @return Driver
     *
     * @throws NotSupportedException
     */
    protected static function getDriver($driver)
    {
        if (class_exists($driver)) {
            return new $driver();
        }

        throw new NotSupportedException("The driver [{$driver}] does not exist.");
    }


}
