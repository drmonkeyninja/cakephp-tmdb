<?php

namespace CakeTmdb\View\Helper;

use Cake\View\Helper;

class TmdbHelper extends Helper
{
    public $helpers = ['Html'];

    /**
     * TMDB image.
     *
     * @param  string $path   TMDB image path
     * @param  string $size   TMDB image size
     * @param  array  $params Image HTML attributes
     * @return string         Complete img tag
     */
    public function image($path, $size, $params = [])
    {
        $url = $this->imageHelper()->getUrl($path, $size);

        return $this->Html->image($url, $params);
    }

    /**
     * Returns the TMDB image helper from the API wrapper.
     *
     * @return object Image helper
     */
    public function imageHelper()
    {
        $tmdb = \Cake\Datasource\ConnectionManager::get('Tmdb');
        $configRepository = new \Tmdb\Repository\ConfigurationRepository($tmdb->getClient());
        $config = $configRepository->load();

        return new \Tmdb\Helper\ImageHelper($config);
    }
}
