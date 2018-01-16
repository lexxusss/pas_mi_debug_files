<?php
// http://www.meekro.com/quickstart.php
require_once '/home/lrzepecki/php/config/meekrodb.2.3.class.php';
require_once '/home/lrzepecki/php/config/db.conf';
$cat = array (
        "Kamizelka" => "Marynarki",
        "Koszula" => "Bluzki i tuniki:Koszule",
        "Koszulka" => "Topy:t-shirts",
        "Bluzki i koszule" => "Bluzki i tuniki:Koszule",
        "Kurtka" => "Kurtki",
        "Marynarka" => "Marynarki",
        "Nakrycie głowy" => "Akcesoria:Czapki i kapelusze",
        "Nakrycie g??owy" => "Akcesoria:Czapki i kapelusze",
        "Okulary" => "Akcesoria:Okulary",
        "Pasek" => "Akcesoria:Paski",
        "Rękawiczki" => "Akcesoria:Rękawiczki",
        "R??kawiczki" => "Akcesoria:Rękawiczki",
        "Spódnica" => "Spódnice",
        "Sp??dnica" => "Spódnice",
        "Spodenki" => "Spodnie:Szorty",
        "Spodnie damskie" => "Spodnie",
        "Strój kąpielowy" => "Moda plażowa:Stroje kąpielowe",
        "Str??j k??pielowy" => "Moda plażowa:Stroje kąpielowe",
        "Sukienka" => "Sukienki",
        "Sweter" => "Swetry i Bluzy:Swetry",
        "Szalik" => "Akcesoria:Apaszki i chusty",
        "Torebka" => "Akcesoria:Torby i torebki",
        "Tshirt" => "Topy:t-shirts",
        "Zegarek" => "Akcesoria:Zegarki",
        "Jeansy" => "Spodnie:Jeansy",
        "Bluzka" => "Topy",
        "Bluza" => "Swetry i Bluzy:Bluzy",
        "Biżuteria" => "Akcesoria:Biżuteria",
        "Bi??uteria" => "Akcesoria:Biżuteria",
        "Buty" => "Obuwie",
        "Majtki" => "Akcesoria",
        "Biustonosz" => "Akcesoria",
        "Portfel" => "Akcesoria",
        "Akcesoria" => "Akcesoria",
        "Skarpetki" => "Akcesoria",
        "Rajstopy" => "Akcesoria",
        "Plecak" => "Akcesoria:Torby i torebki",
        "Żakiet" => "Marynarki",
        "??akiet" => "Marynarki",
        "Kurtka snowboardowa" => "Kurtki:Outdoor",
        "Click Fashion" => "Marynarki",
        "Modstrom" => "Marynarki",
        "Rinascimento" => "Marynarki",
        "Simple" => "Marynarki",
        "Soaked in Luxury" => "Marynarki",
        "Vero Moda" => "Marynarki"
    );
foreach ($cat as $ext => $int) {
    $tmp = explode(':', $int);
    $nam = $tmp[sizeof($tmp)-1];
    if (!empty($nam)) {
        $id = DB::queryFirstField("SELECT id FROM category WHERE name_match = %s", $nam);
        if ($id) //echo "blad $nam <<";
            DB::insertUpdate('x_category_match', array('source' => 'Answear', 'name' => trim($ext), 'category_id' => $id));
    }
}
?>