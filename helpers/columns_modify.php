<?php

$results = DB::query('SELECT column_name, data_type, character_maximum_length FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA="pasujemi" AND TABLE_NAME="x_products";');

$columns = array_column($results, null, 'column_name');

if (!isset($columns['RealUrl'])) {
    $insert = DB::query('ALTER TABLE x_products ADD RealUrl VARCHAR(255) NULL AFTER Zupid;');
}
if ($columns['MerchantProductMainCategory']['character_maximum_length'] < 1200) {
    $insert = DB::query('ALTER TABLE x_products MODIFY MerchantProductMainCategory VARCHAR(1200);');
}
if ($columns['Size']['character_maximum_length'] < 460) {
    $insert = DB::query('ALTER TABLE x_products MODIFY Size VARCHAR(460);');
}
if ($columns['ProductModel']['character_maximum_length'] < 140) {
    $insert = DB::query('ALTER TABLE x_products MODIFY ProductModel VARCHAR(140);');
}
if ($columns['ProductColor']['character_maximum_length'] < 140) {
    $insert = DB::query('ALTER TABLE x_products MODIFY ProductColor VARCHAR(140);');
}
if ($columns['ProductMaterial']['character_maximum_length'] < 140) {
    $insert = DB::query('ALTER TABLE x_products MODIFY ProductMaterial VARCHAR(140);');
}
if ($columns['ProductLongDescription']['data_type'] != 'text') {
    $insert = DB::query('ALTER TABLE x_products MODIFY ProductLongDescription text;');
}

