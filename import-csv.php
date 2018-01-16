<?php
// http://www.meekro.com/quickstart.php
require_once 'config/meekrodb.2.3.class.php';
require_once 'config/db.conf';

require_once 'helpers/helpers.php';
require_once 'helpers/columns_modify.php';

$colsZanox = require_once 'import_settings/cols_zanox_old.php';
$colsZanoxNew = require_once 'import_settings/cols_zanox_new.php';
$colsZanoxOldNew = require_once 'import_settings/cols_zanox_old_new.php';

$categoriesToImport = require_once 'import_settings/categories_to_import.php';
$categoriesNotToImport = require_once 'import_settings/categories_not_to_import.php';

$trimChars = " \t\n\r\0\x0B\"\\";

function zanox($file, $source, $newTemplate = false) {
    global $colsZanox, $colsZanoxNew, $colsZanoxOldNew, $categoriesToImport, $categoriesNotToImport, $trimChars;

    echo "db-import $file ... \r\n";

    $count = 0;
    $countErr = 0;

    if (($handle = fopen($file, "r")) !== FALSE) {
        $row = 1;
        $colsArr = [];
        $colsNum = 0;
        
        while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
            if ($row == 1) {
                $colsArr = $data;
                $colsNum = count($colsArr);

                if ($newTemplate) {
                    if (count(array_diff($colsArr, $colsZanoxNew))) {
                        echo "Brak zgodnosci kolumn z $source:\r\n";
    					mail('lukasz@pasujemi.com, kasia@pasujemi.com', 'Import z Zanox - problem!', 'Bledny import - brak zgodnosci kolumn podczas importu z '.$source, 'From: System PasujeMi.pl <no-reply@pasujemi.com>');
                        break;
                    }
                } else {
                    $colsArr[0] = $colsZanox[0];
                    if ($source == 'Stradivarius') {
                        $colsArr[22] = 'StockStatus';
                    }
                    if ($source == 'Stylepit') {
                        $colsArr[4] = 'ProgramId';
                    }
                    if (count(array_diff($colsArr, $colsZanox))) {
                        echo "Brak zgodnosci kolumn z $source\r\n";
    					mail('lukasz@pasujemi.com, kasia@pasujemi.com', 'Import z Zanox - problem!', 'Bledny import - brak zgodnosci kolumn podczas importu z '.$source, 'From: System PasujeMi.pl <no-reply@pasujemi.com>');
                        break;
                    }

                    array_walk($colsArr, function(&$item, $key) use($trimChars) {
                        $item = trim($item, $trimChars);
                    });
                }
            } else {
                $rowArr = array();

                if (count($data) == $colsNum) {
                    for ($j = 0; $j < $colsNum; $j++) {
                        $columnName = $colsArr[$j];

                        if ($newTemplate) {
                            if (!isset($colsZanoxOldNew[$columnName])) {
                                continue;
                            }

                            $columnName = $colsZanoxOldNew[$columnName];
                        }

                        $rowArr[$columnName] = trim($data[$j], $trimChars);
                    }

                    foreach (['Sale / ', 'Premium / ', 'Promocje / ', /*'Home / '*/] as $category) {
                        $rowArr['MerchantProductCategoryPath'] = str_replace($category, '', $rowArr['MerchantProductCategoryPath']);
                    }

                    // nie importowac produktow z tych kategorii
                    if (
                        strpos_of_needles_array_equals_to($rowArr['MerchantProductCategoryPath'], $categoriesNotToImport, 0, false) &&
                        strpos_of_needles_array_not_equals_to($rowArr['MerchantProductCategoryPath'], $categoriesToImport, 0, 0) &&
                        strpos($rowArr['ProductName'], 'zieci') === false
                    ) {
                        $rowArr['source'] = $source;

                        if ($source == 'STYLEBOP' && strpos($rowArr['ImageLargeURL'], '_detail01') !== false) {
                            $rowArr['ImageLargeURL'] = str_replace('_detail01', '', $rowArr['ImageLargeURL']);
                        }

                        DB::insertUpdate('x_products', $rowArr);

                        $count++;
                    }
                } else {
                    $countErr++;
                }
            }
            $row++;
        }

        echo "... imported $count rows\r\n";

        fclose($handle);
    }
    mail('lukasz@pasujemi.com, kasia@pasujemi.com', 'Import z Zanox', 'Zaimportowano '.$count.' produktow z '.$source.' do bazy tymczasowej, '.$countErr.' produktow blednych.', 'From: System PasujeMi.pl <no-reply@pasujemi.com>');
}

/*-- import files to db --*/
// import old templates
zanox("/home/lrzepecki/php/csv/import-answear.csv", "Answear");
zanox("/home/lrzepecki/php/csv/import-asos.csv", "Asos");
zanox("/home/lrzepecki/php/csv/import-zalando.csv", "Zalando");
zanox("/home/lrzepecki/php/csv/import-stylepit.csv", "Stylepit");
zanox("/home/lrzepecki/php/csv/import-badura.csv", "Badura");
zanox("/home/lrzepecki/php/csv/import-mivo.csv", "Mivo");
zanox("/home/lrzepecki/php/csv/import-primamoda.csv", "Primamoda");
zanox("/home/lrzepecki/php/csv/import-stylebop.csv", "STYLEBOP");
zanox("/home/lrzepecki/php/csv/import-pullbear.csv", 'Pull&Bear');

// import new templates
//zanox("/home/lrzepecki/php/csv/import-new-datafeed.csv", 'NewDataFeed', true);
/*-- /import files to db --*/

//include '/home/lrzepecki/php/import-tradedoubler.php';

// nastepnie import-db.php

?>
