<?php
// http://www.meekro.com/quickstart.php
require_once '/home/lrzepecki/php/config/meekrodb.2.3.class.php';
require_once '/home/lrzepecki/php/config/db.conf';

$msg = '';

$msg .= "\n\nTOP 30 produktów z ostatniego miesiąca:\n======================================\n";
$res = DB::query('select name, slug, category_slug, view_count from product order by view_count desc limit 30');
foreach ($res as $r) {
    $msg .= $r['view_count'].': '.$r['name'].' (https://pasujemi.pl/ubranie/'.$r['category_slug'].'/'.$r['slug'].")\n";
}

/*
$res = DB::query("select count(*) ZANOX_LICZBA, p.source ZRODLO, left(p.Timestamp, 10) DATA_AKTUALIZACJI, IF(p.category_id IS NULL, 'brak kategorii', 'ok') KATEGORIA from x_products p where p.Timestamp > date_sub(now(), interval 3 day) group by p.source, left(p.Timestamp, 10), IF(p.category_id IS NULL, 0, 1);");

$msg .= "PRODUKTY POBRANE Z ZANOX Z OSTATNICH 3 DNI\n======================================\n";
foreach ($res as $row) { foreach ($row as $key => $val) {
  $msg .= "$key: " . $val . "\n";
} $msg .= "\n"; }

$res = DB::query('select count(*) PRODUKTY_LICZBA, o.available DOSTEPNE, o.visible WIDOCZNE from offer o join product p on p.id = o.product_id where o.temporary_product_id is null group by o.available, o.visible;');

$msg .= "PRODUKTY W BAZIE PASUJEMI\n======================================\n";
foreach ($res as $row) { foreach ($row as $key => $val) {
  $msg .= "$key: " . $val . "\n";
} $msg .= "\n"; }

$res = DB::query('select count(*) TYMCZASOWE_LICZBA, o.available DOSTEPNE, o.visible WIDOCZNE from offer o join temporary_product p on p.id = o.temporary_product_id where o.product_id is null group by o.available, o.visible;');

$msg .= "PRODUKTY TYMCZASOWE (NIEWIDOCZNE W SERWISIE)\n======================================\n";
foreach ($res as $row) { foreach ($row as $key => $val) {
  $msg .= "$key: " . $val . "\n";
} $msg .= "\n"; }
*/

$res = DB::query('select concat(s.name, ": ", count(*)) as stat from offer o join product p on p.id = o.product_id join shop s on s.id = o.shop_id where o.temporary_product_id is null and o.available = 1 and o.visible = 1 group by o.shop_id  order by count(*) desc');
$msg .= "LICZBA produktów dostępnych w bazie\n======================================\n";
$total = 0;
foreach ($res as $row) {
    $msg .= $row['stat']."\n";
}
//$msg .= "Liczba wszystkich produktow: $total";

mail('lukasz@pasujemi.com, kasia@pasujemi.com, ewa@pasujemi.com', 'Statystyki', $msg, 'From: System PasujeMi.pl <no-reply@pasujemi.com>');
?>
