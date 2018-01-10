<?php
// http://www.meekro.com/quickstart.php
require_once 'meekrodb.2.3.class.php';
// http://pear.php.net/manual/en/package.http.http-request2.php
require_once 'HTTP/Request2.php';
require_once 'db.conf';

$msg = "";
$results = DB::query("SELECT source, MerchantProductCategoryPath, count(*) count FROM x_products where category_id is null group by MerchantProductCategoryPath having count > 10 order by count desc, MerchantProductCategoryPath;");
if (sizeof($results) > 0) {
    foreach($results as $row) {
        $msg .= $row['source'].' - '.$row['MerchantProductCategoryPath'].' ('.$row['count']." produktów)\n";
    }
    $msg = "Lista nieprzypisanych kategorii:\n\n" . $msg;
    mail('lukasz@pasujemi.com, kasia@pasujemi.com', 'Import - nieprzypisane kategorie', $msg, 'From: System PasujeMi.pl <no-reply@pasujemi.com>');
}

$msg = "";
$results = DB::query("SELECT data_importu FROM x_import_in_progress;");
if (sizeof($results) > 0) {
    $data = $results[0]['data_importu'];
    $msg = "Uwaga - nie zakończył się import do bazy uruchomiony $data";
    mail('lukasz@pasujemi.com, kasia@pasujemi.com', 'Import - błąd w imporcie do bazy danych!!!', $msg, 'From: System PasujeMi.pl <no-reply@pasujemi.com>');
}
// usuniecie obrazkow do produktow ktore nie maja ofert
/*
$results = DB::query("select pi.id, pi.absolute_path from product_image pi left join offer o on o.product_id = pi.product_id where pi.temporary_product_id is null and pi.product_id is not null and o.id is null limit 1000;");
if (sizeof($results) > 0) {
    $msg = "";
    foreach($results as $row) {
        unlink($row['absolute_path']);
        DB::query("delete from product_image where id = ".$row['id'].";");
        $msg .= "Usunięto zdjęcie id=".$row['id']." (".$row['absolute_path'].")\n";
    }
    mail('lukasz@pasujemi.com, kasia@pasujemi.com', 'Import - usunięto zdjęcia', $msg, 'From: System PasujeMi.pl <no-reply@pasujemi.com>');
}
*/

?>
