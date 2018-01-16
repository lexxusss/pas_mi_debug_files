<?php
require_once '/home/lrzepecki/php/config/meekrodb.2.3.class.php';
require_once '/home/lrzepecki/php/config/db.conf';


$date = new MongoDate(strtotime("-1 month"));

/* Kolekcje w MongoDB (baza pasujemi):
product_view_log - klikniecia w produkty (wyjscia)
redirect_log - nie uzywane
stylization_view_log - klikniecia w stylizacje
*/

$m = new MongoClient(); // connect
$db = $m->selectDB("pasujemi");

// PRODUKTY

$out = $db->selectCollection("product_view_log")->aggregateCursor(
    array( array(
        '$match' => array(
            'date' => array('$gt' => $date)
        )
    ),
    array(
        '$group' => array(
            '_id' => array('productId' => '$productId'),
            'cnt' => array('$sum' => 1)
        )
    ) ),
    [ "cursor" => [ "batchSize" => 100 ] ]
);
$out->batchSize(100);
$count = 1;
$pack = 1;
$r = DB::query('update product set view_count = 0');
foreach ($out as $row) {
    echo $row['cnt'] .'-'. $row['_id']['productId'] ."\n";
}

// STYLIZACJE
$out = $db->selectCollection("stylization_view_log")->aggregateCursor(
    array( array(
        '$match' => array(
            'date' => array('$gt' => $date)
        )
    ),
    array(
        '$group' => array(
            '_id' => array('stylizationId' => '$stylizationId'),
            'cnt' => array('$sum' => 1)
        )
    ) ),
    [ "cursor" => [ "batchSize" => 100 ] ]
);
$out->batchSize(100);
$count = 1;
$pack = 1;
$r = DB::query('update stylization set view_count = 0');
foreach ($out as $row) {
    echo $row['cnt'] .'-'. $row['_id']['stylizationId'] ."\n";
}

?>
