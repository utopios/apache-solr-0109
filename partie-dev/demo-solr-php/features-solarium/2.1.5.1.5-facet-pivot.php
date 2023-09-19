<?php

require_once(__DIR__.'/init.php');
htmlHeader();

// create a client instance
$client = new Solarium\Client($adapter, $eventDispatcher, $config);

// get a select query instance
$query = $client->createSelect();

// get the facetset component
$facetSet = $query->getFacetSet();

// create two facet pivot instances
$facet = $facetSet->createFacetPivot('genre-date');
$facet->addFields('genre,initial_release_date');
$facet->setMinCount(0);

$facet = $facetSet->createFacetPivot('directedby-genre');
$facet->addFields('genre,directed_by');

// this executes the query and returns the result
$resultset = $client->select($query);

// display the total number of documents found by Solr
echo 'NumFound: '.$resultset->getNumFound();

// display facet results
$facetResult = $resultset->getFacetSet()->getFacet('genre-date');
//echo '<h3>cat &raquo; popularity &raquo; instock</h3>';
foreach ($facetResult as $pivot) {
    displayPivotFacet($pivot);
}

$facetResult = $resultset->getFacetSet()->getFacet('directedby-genre');
//echo '<h3>popularity &raquo; cat</h3>';
foreach ($facetResult as $pivot) {
    displayPivotFacet($pivot);
}

htmlFooter();


/**
 * Recursively render pivot facets
 *
 * @param $pivot
 */
function displayPivotFacet($pivot)
{
    echo '<ul>';
    echo '<li>Field: '.$pivot->getField().'</li>';
    echo '<li>Value: '.$pivot->getValue().'</li>';
    echo '<li>Count: '.$pivot->getCount().'</li>';
    foreach ($pivot->getPivot() as $nextPivot) {
        displayPivotFacet($nextPivot);
    }
    echo '</ul>';
}
