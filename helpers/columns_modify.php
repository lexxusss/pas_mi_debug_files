<?php

$results = DB::query('SELECT column_name FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA="pasujemi" AND TABLE_NAME="x_products";');

$columns = array_column($results, 'column_name');

if (!in_array('RealUrl', $columns)) {
    $insert = DB::query('ALTER TABLE x_products ADD RealUrl VARCHAR(255) NULL AFTER Zupid;');
}
