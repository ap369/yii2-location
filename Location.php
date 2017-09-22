<?php

namespace ap369\yii2location;

use ap369\yii2location\Drivers\Driver;
use ap369\yii2location\Drivers\IpInfo;
use Yii;
use yii\base\NotSupportedException;


/**
 * Location class
 */
class Location
{

    /**
     * @param null $ip
     * @param null $driver
     * @return Position|false
     */
    public static function get($ip = null, $driver = null)
    {

        if ($ip === null) {
            $ip = Yii::$app->request->userIP;
        }
        if ($driver === null) {
            $driver = IpInfo::class;
        }

        return self::getLocation($ip, $driver);
    }

    /**
     * @param string $ip The IP address
     * @param string $driverClass The driver class name
     * @return Position|bool
     */
    public static function getLocation($ip, $driverClass)
    {
        $driver = self::getDriver($driverClass);

        return $driver->get($ip);
    }


    /**
     * Returns the specified driver.
     * @param string $driver The driver class name
     * @return Driver A driver instance
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
