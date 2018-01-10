<?php
require_once '/home/lrzepecki/php/meekrodb.2.3.class.php';
require_once '/home/lrzepecki/php/db.conf';


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
    DB::update('product', array('view_count' => $row['cnt']), "id=%i", $row['_id']['productId']);
    $count++;
    if ($count/1000==1) { $count = 1; echo $pack." 000\n"; $pack++; }
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
    DB::update('stylization', array('view_count' => $row['cnt']), "id=%i", $row['_id']['stylizationId']);
    $count++;
    if ($count/100==1) { $count = 1; echo $pack."00\n"; $pack++; }
}

?>
