<?php
// http://www.meekro.com/quickstart.php
require_once '/home/lrzepecki/php/meekrodb.2.3.class.php';
require_once '/home/lrzepecki/php/db.conf';

function zanox($file, $source) {
    $row = 1;
    $cols = '';
    $count = 0;
	$countErr = 0;
    if (($handle = fopen($file, "r")) !== FALSE) {
	while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
	    if ($row == 1) {
		$colsZanox = array('MerchantProductCategoryPath','MerchantProductNumber','ZanoxCategoryIds','Zupid','ProgramId','ProductName','ProductPrice','ProductPriceOld','CurrencySymbolOfPrice','UpdateDate','ProductShortDescription','ProductLongDescription','TermsOfContract','MerchantProductMainCategory','MerchantProductSubCategory','MerchantProductThirdCategory','ImageSmallURL','ImageMediumURL','ImageLargeURL','ValidFromDate','ValidToDate','ZanoxProductLink','StockStatus','StockAmount','AdditionalProductFeatures','SavingsPercent','SavingsAbsolute','ExtraTextOne','ExtraTextTwo','ExtraTextThree','ExtraTextFour','ExtraTextFive','ExtraTextSix','ExtraTextSeven','ExtraTextEight','ExtraTextNine','ProductEAN','ProductGTIN','ISBN','DeliveryTime','BasePrice','BasePriceAmount','BasePriceText','ShippingAndHandling','ShippingAndHandlingCosts','ProductCondition','SizeStockStatus','SizeStockAmount','ProductManufacturerBrand','ProductModel','ProductColor','ProductMaterial','Size','Gender','AdditionalImage1','AdditionalImage2','AdditionalImage3');
		$data[0] = 'MerchantProductCategoryPath';		
		if ($source == 'Stradivarius') $data[22] = 'StockStatus';
		if ($source == 'Stylepit') $data[4] = 'ProgramId';
		$colsArr = $data;
		if ($colsZanox !== $colsArr) {
                    echo "Brak zgodnosci kolumn";
					mail('lukasz@pasujemi.com, kasia@pasujemi.com', 'Import z Zanox - problem!', 'Bledny import - brak zgodnosci kolumn podczas importu z '.$source, 'From: System PasujeMi.pl <no-reply@pasujemi.com>');
                    break;
                }
		$colsNum = sizeof($colsArr);
	    } else {
		$rowArr = array();
		if (sizeof($data) == $colsNum) { // liczba przeparsowanych kolumn musi sie zgadzac, ominiecie wierszy o niewlasciwym formacie np. bez escape przecinka
		    for ($j = 0; $j < $colsNum; $j++) {
			$rowArr[trim($colsArr[$j], " \t\n\r\0\x0B\"\\")] = trim($data[$j], " \t\n\r\0\x0B\"\\");
		    }
			$rowArr['MerchantProductCategoryPath'] = str_replace('Sale / ', '', $rowArr['MerchantProductCategoryPath']);
			$rowArr['MerchantProductCategoryPath'] = str_replace('Premium / ', '', $rowArr['MerchantProductCategoryPath']);
			$rowArr['MerchantProductCategoryPath'] = str_replace('Promocje / ', '', $rowArr['MerchantProductCategoryPath']);
//			$rowArr['MerchantProductCategoryPath'] = str_replace('Home / ', '', $rowArr['MerchantProductCategoryPath']);
		    // nie importowac produktow z tych kategorii
		    if (strpos($rowArr['MerchantProductCategoryPath'], 'Men') !== 0
		    && strpos($rowArr['MerchantProductCategoryPath'], 'Męż') !== 0
			&& strpos($rowArr['MerchantProductCategoryPath'], 'MĘŻ') !== 0
			&& strpos($rowArr['MerchantProductCategoryPath'], 'MEŻ') !== 0
			&& strpos($rowArr['MerchantProductCategoryPath'], 'MALE') !== 0
		    && strpos($rowArr['MerchantProductCategoryPath'], 'men /') !== 0
		    && strpos($rowArr['MerchantProductCategoryPath'], 'ON /') !== 0
		    && strpos($rowArr['MerchantProductCategoryPath'], 'ON/') !== 0
		    && strpos($rowArr['MerchantProductCategoryPath'], 'DZIEWCZ') !== 0
		    && strpos($rowArr['MerchantProductCategoryPath'], 'CHŁOP') !== 0
		    && strpos($rowArr['MerchantProductCategoryPath'], 'Dziec') !== 0
		    && strpos($rowArr['MerchantProductCategoryPath'], 'Bielizna') === false
		    && strpos($rowArr['MerchantProductCategoryPath'], 'Lingerie') === false
		    && strpos($rowArr['MerchantProductCategoryPath'], 'Make-Up') === false
		    && strpos($rowArr['MerchantProductCategoryPath'], 'Kosmetyk') === false
		    && strpos($rowArr['MerchantProductCategoryPath'], 'Pielęgnacja') === false
		    && strpos($rowArr['MerchantProductCategoryPath'], 'Rajstopy') === false
		    && strpos($rowArr['MerchantProductCategoryPath'], 'skarpet') === false
		    && strpos($rowArr['MerchantProductCategoryPath'], 'Skarpet') === false
		    && strpos($rowArr['MerchantProductCategoryPath'], 'rajstopy') === false
		    && strpos($rowArr['MerchantProductCategoryPath'], 'Sprzęt') === false
		    && strpos($rowArr['MerchantProductCategoryPath'], 'Skarpety') === false
		    && strpos($rowArr['MerchantProductCategoryPath'], 'Gadżety') === false
		    && strpos($rowArr['MerchantProductCategoryPath'], 'Ropa y accesorios') === false
		    && strpos($rowArr['MerchantProductCategoryPath'], 'On /') !== 0
		    && strpos($rowArr['MerchantProductCategoryPath'], 'DZIEC') !== 0
		    && strpos($rowArr['MerchantProductCategoryPath'], 'Uroda') === false
		    && strpos($rowArr['MerchantProductCategoryPath'], 'Sport / Outdoor') !== 0
		    && strpos($rowArr['MerchantProductCategoryPath'], 'Narciars') === false
		    && strpos($rowArr['MerchantProductCategoryPath'], 'Sport / Pływanie') !== 0
		    && strpos($rowArr['MerchantProductCategoryPath'], 'Sport / Piłka') !== 0
		    && strpos($rowArr['MerchantProductCategoryPath'], 'KOLEKCJA MĘSKA') !== 0
		    && strpos($rowArr['MerchantProductCategoryPath'], 'Sport / Narciarstwo') !== 0
			&& strpos($rowArr['MerchantProductCategoryPath'], 'Męski') === false
			&& strpos($rowArr['ProductName'], 'zieci') === false
		    ) {			
				$rowArr['source'] = $source;
				if ($source == 'STYLEBOP' && strpos($rowArr['ImageLargeURL'], '_detail01') !== false) $rowArr['ImageLargeURL'] = str_replace('_detail01', '', $rowArr['ImageLargeURL']);
				$r = DB::insertUpdate('x_products', $rowArr);
				$count++;
				//print_r($rowArr);
		    }
		} else {
			$countErr++;
		}
	    }
	    $row++;
	//if ($row == 50) break;
	}
	fclose($handle);
    }
    mail('lukasz@pasujemi.com, kasia@pasujemi.com', 'Import z Zanox', 'Zaimportowano '.$count.' produktow z '.$source.' do bazy tymczasowej, '.$countErr.' produktow blednych.', 'From: System PasujeMi.pl <no-reply@pasujemi.com>');
}

// skrypt odpalany po import.sh (pobranie plikow CSV z Zanox)

//zanox("/home/lrzepecki/php/import-answear.csv", "Answear");
//zanox("/home/lrzepecki/php/import-asos.csv", "Asos");
zanox("/home/lrzepecki/php/import-zalando.csv", "Zalando");
//zanox("/home/lrzepecki/php/import-stylepit.csv", "Stylepit");
//zanox("/home/lrzepecki/php/import-badura.csv", "Badura");
//zanox("/home/lrzepecki/php/import-mivo.csv", "Mivo");
//zanox("/home/lrzepecki/php/import-primamoda.csv", "Primamoda");
//zanox("/home/lrzepecki/php/import-stylebop.csv", "STYLEBOP");

//zanox("/home/lrzepecki/php/import-pullbear.csv", 'Pull&Bear');

//include '/home/lrzepecki/php/import-tradedoubler.php';

// nastepnie import-db.php

?>
