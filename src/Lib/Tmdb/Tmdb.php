<?php

namespace Tmdb\Lib\Tmdb\Driver;

use Cake\Core\Configure;
use Cake\Network\Http\Client;
use Muffin\Webservice\AbstractDriver;

class Tmdb extends AbstractDriver
{
    /**
     * Whether to log queries generated during this connection.
     *
     * @var bool
     */
    protected $_logQueries = false;

    /**
     * Setup the TMDB client using the configured API key.
     *
     * @return void
     */
    public function initialize()
    {
        $apiKey = $this->config('api_key');
        $this->_client = new \Tmdb\Client(new \Tmdb\ApiToken($apiKey));
        return;
    }

    /**
     * Get the configuration name for this connection.
     *
     * @return string
     */
    public function configName()
    {
        if (empty($this->_config['name'])) {
            return '';
        }
        return $this->_config['name'];
    }

    /**
     * Enables or disables query logging for this connection.
     *
     * @param bool $enable whether to turn logging on or disable it.
     *   Use null to read current value.
     * @return bool
     */
    public function logQueries($enable = null)
    {
        if ($enable === null) {
            return $this->_logQueries;
        }
        $this->_logQueries = $enable;
    }

    /**
     * Sets the logger object instance. When called with no arguments
     * it returns the currently setup logger instance.
     *
     * @param object $instance logger object instance
     * @return object logger instance
     */
    public function logger($instance = null)
    {
        if ($instance === null) {
            if ($this->_logger === null) {
                $this->_logger = new QueryLogger;
            }
            return $this->_logger;
        }
        $this->_logger = $instance;
    }

    public function getClient()
    {
        return $this->_client;
    }
}
