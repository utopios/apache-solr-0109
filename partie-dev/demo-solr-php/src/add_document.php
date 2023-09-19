<?php

require "header.php";

$update = $client->createUpdate();

$document = $update->createDocument();
$document->id = "2010/inception";
$document->name = "inception";
$document->genre = ["Action", "Sci-Fi"];

$update->addDocument($document);
$update->addCommit();

$result = $client->update($update);

echo "Status: ".$result->getStatus();
