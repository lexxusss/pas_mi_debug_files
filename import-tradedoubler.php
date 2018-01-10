<?php
// http://www.meekro.com/quickstart.php
require_once '/home/lrzepecki/php/meekrodb.2.3.class.php';
require_once '/home/lrzepecki/php/db.conf';

function tradedoubler($file, $source) {
    $row = 1;
    $cols = '';
    $count = 0;
	$countErr = 0;
    if (($handle = fopen($file, "r")) !== FALSE) {
	while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
	    if ($row == 1) {
		$colsTD = array('name','productImage','description','categories','fields','weight','size','model','brand','manufacturer','techSpecs','shortDescription','promoText','ean','upc','isbn','mpn','sku','feedId','productUrl','priceValue','priceCurrency','modified','dateFormat','inStock','availability','deliveryTime','sourceProductId','warranty','condition','programLogo','programName','shippingCost','id');
		$colsArr = $data;
                if ($colsTD !== $colsArr) {
                    echo "Brak zgodnosci kolumn";
                    break;
                } else {
                    // przetlumaczenie nazw kolumn na x_products (Zanoxowe)
                    // $colsZanox = array('MerchantProductCategoryPath','MerchantProductNumber','ZanoxCategoryIds','Zupid','ProgramId','ProductName','ProductPrice','ProductPriceOld','CurrencySymbolOfPrice','UpdateDate','ProductShortDescription','ProductLongDescription','TermsOfContract','MerchantProductMainCategory','MerchantProductSubCategory','MerchantProductThirdCategory','ImageSmallURL','ImageMediumURL','ImageLargeURL','ValidFromDate','ValidToDate','ZanoxProductLink','StockStatus','StockAmount','AdditionalProductFeatures','SavingsPercent','SavingsAbsolute','ExtraTextOne','ExtraTextTwo','ExtraTextThree','ExtraTextFour','ExtraTextFive','ExtraTextSix','ExtraTextSeven','ExtraTextEight','ExtraTextNine','ProductEAN','ProductGTIN','ISBN','DeliveryTime','BasePrice','BasePriceAmount','BasePriceText','ShippingAndHandling','ShippingAndHandlingCosts','ProductCondition','SizeStockStatus','SizeStockAmount','ProductManufacturerBrand','ProductModel','ProductColor','ProductMaterial','Size','Gender','AdditionalImage1','AdditionalImage2','AdditionalImage3');
                    $colsArr[0] = 'ProductName';
                    $colsArr[1] = 'ImageLargeURL';
                    $colsArr[2] = 'ProductLongDescription';
                    $colsArr[3] = 'MerchantProductCategoryPath';
                    $colsArr[4] = '__NIE_IMPORTOWAC__'; //'fields'
                    $colsArr[5] = '__NIE_IMPORTOWAC__'; //'weight'
                    $colsArr[6] = 'Size';
                    $colsArr[7] = 'ProductModel';
                    $colsArr[8] = 'ProductManufacturerBrand';
                    $colsArr[9] = '__NIE_IMPORTOWAC__'; //'manufacturer'-?
                    $colsArr[10] = 'ExtraTextTwo'; //'techSpecs'
                    $colsArr[11] = 'ProductShortDescription';
                    $colsArr[12] = 'ExtraTextOne'; //'promoText'
                    $colsArr[13] = 'ProductEAN';
                    $colsArr[14] = '__NIE_IMPORTOWAC__'; //'upc'
                    $colsArr[15] = 'ISBN'; //'isbn';
                    $colsArr[16] = '__NIE_IMPORTOWAC__'; //mpn'
                    $colsArr[17] = '__NIE_IMPORTOWAC__'; //'sku'
                    $colsArr[18] = 'ProgramId'; //'feedId'
                    $colsArr[19] = 'ZanoxProductLink';
                    $colsArr[20] = 'ProductPrice';
                    $colsArr[21] = 'CurrencySymbolOfPrice';
                    $colsArr[22] = 'UpdateDate'; //'modified' unix timestamp EPOCH
                    $colsArr[23] = '__NIE_IMPORTOWAC__'; //'dateFormat'
                    $colsArr[24] = '__NIE_IMPORTOWAC__'; //'inStock';
                    $colsArr[25] = 'StockStatus';
                    $colsArr[26] = 'DeliveryTime';
                    $colsArr[27] = 'MerchantProductNumber';
                    $colsArr[28] = '__NIE_IMPORTOWAC__'; //'warranty'
                    $colsArr[29] = '__NIE_IMPORTOWAC__'; //'condition';
                    $colsArr[30] = '__NIE_IMPORTOWAC__'; //'programLogo'
                    $colsArr[31] = '__NIE_IMPORTOWAC__'; //'programName'
                    $colsArr[32] = 'ShippingAndHandlingCosts';
                    $colsArr[33] = 'Zupid';
                }
		$colsNum = sizeof($colsArr);
	    } else {
		$rowArr = array();
                if (sizeof($data) == $colsNum) { // liczba przeparsowanych kolumn musi sie zgadzac, ominiecie wierszy o niewlasciwym formacie np. bez escape przecinka
                    //print_r($data);
                    for ($j = 0; $j < $colsNum; $j++) {
                        if ($colsArr[$j] != '__NIE_IMPORTOWAC__')
                            $rowArr[trim($colsArr[$j], " \t\n\r\0\x0B\"\\")] = trim($data[$j], " \t\n\r\0\x0B\"\\");
                            if ($colsArr[$j] == 'UpdateDate') $rowArr['UpdateDate'] = date("Y-m-d H:i:s", $data[$j]/1000);
                            if ($colsArr[$j] == 'ImageLargeURL') {
								$img = explode(';', $data[$j]); $rowArr['ImageLargeURL'] = $img[0];
								//if (strpos($img, '_detail01') !== false) $img = str_replace('_detail01', '', $img);
							}
                    }
                    // nie importowac produktow z tych kategorii
                    if (true && strpos($rowArr['MerchantProductCategoryPath'], 'Men') !== 0
                    && strpos($rowArr['MerchantProductCategoryPath'], 'Męż') !== 0
					&& strpos($rowArr['MerchantProductCategoryPath'], 'Dziec') !== 0
					&& strpos($rowArr['MerchantProductCategoryPath'], 'Bielizna') === false
					&& strpos($rowArr['ProductName'], 'zieci') === false
					&& strpos($rowArr['ProductLongDescription'], 'męski') === false
                    ) {
                        $rowArr['source'] = $source;
                        $r = DB::insertUpdate('x_products', $rowArr);
                        $count++;
                        //print_r($rowArr);
                    }
                } else {
					$countErr++;
				}
	    }
	    $row++;
	//if ($row == 5) break;
	}
	fclose($handle);
    }
    mail('lukasz@pasujemi.com, kasia@pasujemi.com', 'Import z TradeDoubler', 'Zaimportowano '.$count.' produktow z '.$source.' do bazy tymczasowej, '.$countErr.' produktow blednych.', 'From: System PasujeMi.pl <no-reply@pasujemi.com>');
}

tradedoubler("/home/lrzepecki/php/import-bonprix.csv", "Bonprix");
tradedoubler("/home/lrzepecki/php/import-osho.csv", "Osho");
tradedoubler("/home/lrzepecki/php/import-deichmann.csv", "Deichmann");

?>
