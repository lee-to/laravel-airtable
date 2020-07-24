<?php

namespace AirTableLaravel;

use AirTable\AirTable as AirTableLaravel;
use AirTableLaravel\AirTable as AirTableClient;

class AirTableManager
{
    /**
     * The application instance.
     *
     * @var \Illuminate\Foundation\Application
     */
    protected $app;


    public function __construct($app)
    {
        $this->app = $app;
    }

    public function table(string $table = "")
    {
        $base = $this->app['config']['airtable.base'];
        $access_token = $this->app['config']['airtable.token'];
        $http_client = $this->app['config']['airtable.http_client'];

        if($table == "") {
            $table  = $this->app['config']['airtable.default_table'];
        }

        $client = new AirTableLaravel($access_token, $base, $http_client);

        return new AirTableClient($client->table($table));
    }

    public function __call($method, $parameters)
    {
        return $this->table()->$method(...$parameters);
    }
}