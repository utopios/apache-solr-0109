<?php
use \Solarium\Core\Client\Adapter\Curl;
use \Symfony\Component\EventDispatcher\EventDispatcher;
use \Solarium\Client;
require __DIR__.'/../vendor/autoload.php';

$config = [
    "endpoint" => [
        "localhost" => [
            "scheme" => "http",
            "host" => "127.0.0.1",
            "port" => 8983,
            "path" => "/",
            //"context" => "solr"
            "core" => "films"
        ]
    ]
];

$adapter = new Curl();
$eventDispatcher = new EventDispatcher();

$client = new Client($adapter, $eventDispatcher, $config);