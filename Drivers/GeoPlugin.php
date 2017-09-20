<?php

namespace ap369\yii2location\Drivers;

use ap369\yii2location\Position;

class GeoPlugin extends Driver
{
    /**
     * {@inheritdoc}
     */
    protected function url()
    {
        return 'http://www.geoplugin.net/json.gp?ip=';
    }

    /**
     * {@inheritdoc}
     */
    protected function hydrate(Position $position, $location)
    {
        $position->countryCode = $location['geoplugin_countryCode'];
        $position->countryName = $location['geoplugin_countryName'];
        $position->regionName = $location['geoplugin_regionName'];
        $position->regionCode = $location['geoplugin_regionCode'];
        $position->cityName = $location['geoplugin_city'];
        $position->latitude = $location['geoplugin_latitude'];
        $position->longitude = $location['geoplugin_longitude'];
        $position->areaCode = $location['geoplugin_areaCode'];

        return $position;
    }

    /**
     * {@inheritdoc}
     */
    protected function process($ip)
    {
        try {
            $response = json_decode($this->getUrlContent($this->url().$ip),true);
            return $response;
        } catch (\Exception $e) {
            return false;
        }
    }
}
