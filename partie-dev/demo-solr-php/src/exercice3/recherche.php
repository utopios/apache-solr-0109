<?php

require __DIR__."/../header.php";

if($_POST) {
    $query = $client->createSelect();
    $query->setQuery('name:'.$_POST['search'].' OR genre:'.$_POST['search']);
    $hl = $query->getHighlighting();
    $hl->getField("name")->setSimplePrefix("<b>");
    $hl->getField("name")->setSimplePostfix("</b>");
    $hl->getField("id");
    $result = $client->select($query);
    $resulthl = $result->getHighlighting();

    //Auto complete
    $termQuery = $client->createTerms();
    $termQuery->setFields("name");
    $termQuery->setPrefix($_POST["search"]);

    $autocompleteResult = $client->terms($termQuery);

    var_dump($autocompleteResult);
}


?>

<div>
    <form method="post">
        <input type="text" name="search" />
        <button type="submit">rechercher</button>
    </form>
</div>

<?php
if(isset($result)) {
    foreach ($result as $document) {
        ?>
        <div>
            <?php
            // var_dump($document->getFields());
            ?>
            <?php echo $document["id"]; ?>
        </div>
        <div>
            hl:
            <?php
            $hlDoc = $resulthl->getResult($document->id);
            //echo $hlDoc->getFields();
            var_dump($hlDoc->getFields()["name"][0]);
            ?>
        </div>
        <?php
    }

}