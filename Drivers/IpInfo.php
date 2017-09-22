<?php

namespace ap369\yii2location\Drivers;

use ap369\yii2location\Position;

class IpInfo extends Driver
{
    /**
     * {@inheritdoc}
     */
    protected function hydrate(Position $position, $location)
    {

        $position->countryCode = $location['country'];
        $position->regionName = $location['region'];
        $position->cityName = $location['city'];
        //$position->zipCode = $location['postal'];

        if ($location['loc']) {
            $coordinates = explode(',', $location['loc']);

            if (array_key_exists(0, $coordinates)) {
                $position->latitude = $coordinates[0];
            }

            if (array_key_exists(1, $coordinates)) {
                $position->longitude = $coordinates[1];
            }
        }

        return $position;
    }

    /**
     * {@inheritdoc}
     */
    protected function process($ip)
    {
        try {
            return json_decode($this->getUrlContent($this->url() . $ip . '/json'), true);
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function url()
    {
        return 'http://ipinfo.io/';
    }
}
