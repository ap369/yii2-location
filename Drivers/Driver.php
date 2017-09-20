<?php

namespace ap369\yii2location\Drivers;

use ap369\yii2location\Position;

abstract class Driver
{
    /**
     * The fallback driver.
     *
     * @var Driver
     */
    protected $fallback;

    /**
     * Append a fallback driver to the end of the chain.
     *
     * @param Driver $handler
     */
    public function fallback(Driver $handler)
    {
        if (is_null($this->fallback)) {
            $this->fallback = $handler;
        } else {
            $this->fallback->fallback($handler);
        }
    }

    /**
     * Handle the driver request.
     *
     * @param string $ip
     *
     * @return Position|bool
     */
    public function get($ip)
    {
        $location = $this->process($ip);

        if (!$location && $this->fallback) {
            $location = $this->fallback->get($ip);
        }

        if (is_array($location)) {
            $position = $this->hydrate(new Position(), $location);

            $position->driver = get_class($this);

            return $position;
        }

        return false;
    }

    /**
     * Returns url content as string.
     *
     * @param string $url
     *
     * @return mixed
     */
    protected function getUrlContent($url)
    {
        $timeout = 5;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $urlContent = curl_exec($ch);
        curl_close($ch);

        return $urlContent;
    }

    /**
     * Returns the URL to use for querying the current driver.
     *
     * @return string
     */
    abstract protected function url();

    /**
     * Hydrates the position with the given location
     * instance using the drivers array map.
     *
     * @param Position $position
     * @param [] $location
     *
     * @return \ap369\yii2location\Position
     */
    abstract protected function hydrate(Position $position, $location);

    /**
     * Process the specified driver.
     *
     * @param string $ip
     *
     * @return array|bool
     */
    abstract protected function process($ip);
}
