<?php

require "header.php";

$update = $client->createUpdate();

$buffer = $client->getPlugin("bufferedadd");
$buffer->setBufferSize(20);

$client->getEventDispatcher()->addListener(
    Solarium\Plugin\BufferedAdd\Event\Events::PRE_FLUSH,
    function (\Solarium\Plugin\BufferedAdd\Event\PreFlush $event) {
        var_dump($event->getBuffer());
        echo "flush ". count($event->getBuffer())."<br />";
    }
);

for($i=1; $i<=65; $i++) {
    $document = [
        "id" => "film_".$i,
        "name" => "inception_".$i,
        "genre" => ["Action", "Sci-Fi"]
    ];
    $buffer->createDocument($document);
}

$buffer->flush();