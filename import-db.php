<?php
// http://www.meekro.com/quickstart.php
require_once '/home/lrzepecki/php/config/meekrodb.2.3.class.php';
require_once '/home/lrzepecki/php/config/db.conf';

// wywolanie procedury do importu 
$res = DB::query('call runImportProd;');
$res = DB::query('call runImportProd;');

if (!is_array($res)) {
    mail('lukasz@pasujemi.com, kasia@pasujemi.com', 'Blad w imporcie produktow', $res, 'From: System PasujeMi.pl <no-reply@pasujemi.com>');
}

#$msg = "";
#$results = DB::query("SELECT data_importu FROM x_import_in_progress;");
#if (sizeof($results) > 0) {
#    $data = $results[0]['data_importu'];
#    $msg = "Uwaga - nie zakończył się import do bazy uruchomiony $data";
#    mail('lukasz@pasujemi.com, kasia@pasujemi.com', 'Import - błąd w imporcie do bazy danych!', $msg, 'From: System PasujeMi.pl <no-reply@pasujemi.com>');
#}

?>
