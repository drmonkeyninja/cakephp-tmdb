# CakePHP TMDB

[![License](https://poser.pugx.org/drmonkeyninja/cakephp-tmdb/license.svg)](https://packagist.org/packages/drmonkeyninja/cakephp-tmdb) [![Build Status](https://travis-ci.org/drmonkeyninja/cakephp-tmdb.svg?branch=master)](https://travis-ci.org/drmonkeyninja/cakephp-tmdb)

This CakePHP 3 plugin provides integration with the TMDB API for retrieving data on movies and television from [themoviedb.org](https://www.themoviedb.org/). It makes use of an established [TMDB API wrapper](https://github.com/php-tmdb/api) and the [Webservice](https://github.com/UseMuffin/Webservice) plugin for CakePHP.

## Requirements

* CakePHP 3.x
* A valid TMDB API key

## Installation

Install using composer: `composer require drmonkeyninja/cakephp-tmdb:3.0.*`

Then add the following lines to bootstrap.php to load the plugin:
```php
Plugin::load('Muffin/Webservice');
Plugin::load('CakeTmdb');
```

## Configuration

You will need to configure a new webservice in config/app.php using your TMDB API key:
```php
'Webservices' => [
    'Tmdb' => [
        'className' => 'Muffin\Webservice\Connection',
        'service' => 'CakeTmdb\Lib\Tmdb\Driver\Tmdb',
        'api_key' => 'your_tmdb_api_key'
    ]
]
```

Then in bootstrap.php instruct the `ConnectionManager` to consume the webservice:
```php
ConnectionManager::setConfig(Configure::consume('Webservices'));
```

## Usage

This plugin uses the [TMDB API library](https://github.com/php-tmdb/api) so you have full access to all of the methods provided there.

For example, to search the database for movies with the title 'Toy Story':
```php
$tmdb = \Cake\Datasource\ConnectionManager::get('Tmdb');
$data = $tmdb->getSearchApi()->searchMovies('Toy Story');
```

### TmdbHelper

A handy little helper comes with the plugin for rendering TMDB images using the paths returned by the API. To use include the `Tmdb` helper in your controller as normal:-

```php
public $helpers = ['CakeTmdb.Tmdb'];
```

Then in your view:-

```php
<?= $this->Tmdb->image($movie->poster, 'w154'); ?>
```

The first parameter needs to be the image path (provided by TMDB); the second parameter is the TMDB size. You can also pass an optional array of image attributes as the third parameter:-

```php
<?= $this->Tmdb->image($movie->poster, 'w154', ['alt' => $movie->title]); ?>
```
