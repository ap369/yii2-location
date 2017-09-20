<?php

namespace ap369\yii2location\Drivers;

use ap369\yii2location\Position;

class IpInfo extends Driver
{
    /**
     * {@inheritdoc}
     */
    protected function url()
    {
        return 'http://ipinfo.io/';
    }

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
            $coords = explode(',', $location['loc']);

            if (array_key_exists(0, $coords)) {
                $position->latitude = $coords[0];
            }

            if (array_key_exists(1, $coords)) {
                $position->longitude = $coords[1];
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
            $response = json_decode($this->getUrlContent($this->url().$ip.'/json'),true);
            return $response;
        } catch (\Exception $e) {
            return false;
        }
    }
}
