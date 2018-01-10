<?php
// http://www.meekro.com/quickstart.php
require_once '/home/lrzepecki/php/meekrodb.2.3.class.php';
require_once '/home/lrzepecki/php/db.conf';

function insist($file, $source) {
    $row = 0;
    $count = 0;
    if (($handle = fopen($file, "r")) !== FALSE) {
	while (($data = fgetcsv($handle, 0, ";")) !== FALSE) {
	    if ($row > 0) {
                $rowArr = array();
                $rowArr['MerchantProductNumber'] = $data[0];
                $rowArr['StockStatus'] = $data[1];
                $rowArr['ProductName'] = $data[2];
                $rowArr['ProductPrice'] =  $data[3];
                //$rowArr['vat'] = $data[4];
                //$rowArr['unit'] = $data[5];
                $rowArr['MerchantProductCategoryPath'] = $data[6];
                $rowArr['CurrencySymbolOfPrice'] = 'PLN';
                $rowArr['Zupid'] = 'insist-'.$data[0];
                $rowArr['source'] = $source;
                print_r($rowArr);
		$r = DB::insertUpdate('x_products', $rowArr);
                $count++;
	    }
	    $row++;
	}
	fclose($handle);
    }
    mail('lukasz@pasujemi.com, kasia@pasujemi.com', 'Import z Insist', 'Zaimportowano '.$count.' produktow z '.$source.' do bazy tymczasowej.', 'From: System PasujeMi.pl <no-reply@pasujemi.com>');
}

insist("/home/lrzepecki/php/import-insist.csv", "Insist");

?>
