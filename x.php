<?php
// http://www.meekro.com/quickstart.php
require_once '/home/lrzepecki/php/meekrodb.2.3.class.php';
require_once '/home/lrzepecki/php/db.conf';

function go($file, $source) {
    $row = 1;
    $cols = '';
    $count = 0;
    if (($handle = fopen($file, "r")) !== FALSE) {
	while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
	    if ($row == 1) {
		$data[0] = 'MerchantProductCategoryPath';
		if ($source == 'Stradivarius') $data[22] = 'StockStatus';
		$colsArr = $data;
		$colsNum = sizeof($colsArr);
	    } else {
		$rowArr = array();
		for ($j = 0; $j < $colsNum; $j++) {
		    $rowArr[trim($colsArr[$j], " \t\n\r\0\x0B\"\\")] = trim($data[$j], " \t\n\r\0\x0B\"\\");
		}
		// nie importowac produktow z tych kategorii
		if (strpos($rowArr['MerchantProductCategoryPath'], 'Men') !== 0
		&& strpos($rowArr['MerchantProductCategoryPath'], 'Męż') !== 0
		&& strpos($rowArr['MerchantProductCategoryPath'], 'ON /') !== 0
		&& strpos($rowArr['MerchantProductCategoryPath'], 'ON/') !== 0
		&& strpos($rowArr['MerchantProductCategoryPath'], 'DZIEWCZ') !== 0
		&& strpos($rowArr['MerchantProductCategoryPath'], 'CHŁOP') !== 0
		&& strpos($rowArr['MerchantProductCategoryPath'], 'Dziec') !== 0
		&& strpos($rowArr['MerchantProductCategoryPath'], 'Bielizna') === false
		&& strpos($rowArr['MerchantProductCategoryPath'], 'Lingerie') === false
		&& strpos($rowArr['MerchantProductCategoryPath'], 'Make-Up') === false
		) {
		    $rowArr['source'] = $source;
//		    $r = DB::insertUpdate('x_products', $rowArr);
		    $count++;
		    //print_r($rowArr);
		}
	    }
	    $row++;
	//if ($row == 50) break;
	}
	fclose($handle);
    }
    mail('lukasz@pasujemi.com', 'Import z Zanox', 'Zaimportowano '.$count.' produktow z '.$source, 'From: no-reply@pasujemi.com');
}

go("/home/lrzepecki/php/import-answear.csv", "Answear");
go("/home/lrzepecki/php/import-asos.csv", "Asos");
go("/home/lrzepecki/php/import-zalando.csv", "Zalando");
go("/home/lrzepecki/php/import-stradiv.csv", "Stradivarius");

// wywolanie procedury do importu 
//DB::query('call runImportProd;');

?>
