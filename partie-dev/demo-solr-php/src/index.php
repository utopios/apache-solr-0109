<?php

require "header.php";


//Simple requête
//$query = $client->createQuery($client::QUERY_SELECT);
$query = $client->createSelect();
$query->setQuery("name:inception");
$query->setStart(0);
$query->setRows(20);
$result = $client->select($query);

echo "Number of document : ". $result->getNumFound()."<br/>";

foreach ($result as $document) {
    echo $document->name . "<br/>";
}


