<?php
// http://www.meekro.com/quickstart.php
require_once 'meekrodb.2.3.class.php';
// http://pear.php.net/manual/en/package.http.http-request2.php
require_once 'HTTP/Request2.php';
require_once 'db.conf';
//DB::debugMode();

function go($results = array(), $temporary = 0) {
    $cnt = 0;
    $path = '/var/www/html/pasujemi/web/uploads/product2015/'; //ze slashem na koncu
    foreach ($results as $row) {
        $id = $row['id'];
        $url = !empty($row['ImageLargeURL']) ? $row['ImageLargeURL'] : $row['ImageMediumURL'];
        //tutaj pracujemy na URL z bazy
        $fileName = basename(parse_url($url, PHP_URL_PATH));
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        $name = md5($url).'.'.$ext;
        $dir = substr($name, 0, 1).'/'.substr($name, 1, 1).'/';
        switch ($temporary) { case 0: $col = 'product_id'; break; case 1: $col = 'temporary_product_id'; break; case 3: $col = 'id'; }
        if (!file_exists($path.$dir.$name)) {
            //echo "$id:$url\n";
            $request = new HTTP_Request2($url, HTTP_Request2::METHOD_GET);
            $request->setHeader('connection', 'Keep-Alive');
            $request->setConfig(array(
                'adapter' => 'HTTP_Request2_Adapter_Curl',
                'connect_timeout' => 10,
                'timeout' => 15,
                'follow_redirects' => TRUE,
                'max_redirects' => 2,
            ));
            try {
                $response = $request->send();
                if (200 == $response->getStatus()) {
                    $real_url = $response->getEffectiveUrl();
                    //tutaj mamy prawdziwy URL z odpowiedzi serewera
                    $fileName = basename(parse_url($real_url, PHP_URL_PATH));
                    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                    $name = md5(str_replace('https://', 'http://', $real_url)).'.'.$ext;
                    $dir = substr($name, 0, 1).'/'.substr($name, 1, 1).'/';
                    @mkdir($path.$dir, 0777, true);
                    @chown($path.$dir, 'apache');
                    if (file_put_contents($path.$dir.$name, $response->getBody())) {
                        echo $real_url.':'; //.$path.$dir.$name.':';
                        @chown($path.$dir.$name, 'apache');
                        if ($temporary < 3) {
                            $r = DB::insertIgnore('product_image', array($col => $id, 'name' => $name, 'absolute_path' => $path.$dir.$name));
                            echo "Insert $col=".DB::insertId();
                        } else {
                            $r = DB::insertUpdate('product_image', array($col => $id, 'name' => $name, 'absolute_path' => $path.$dir.$name));
                            echo "Ponowne pobranie id=$id";
                        }
                        $cnt++;
                    }
                } else {
                    echo 'Unexpected HTTP status: '.$response->getStatus().' '.$response->getReasonPhrase();
                }
            } catch (HTTP_Request2_Exception $e) {
                echo 'Error: '.$e->getMessage();
            }
            echo "\n";
        } else {
            $r = DB::insertUpdate('product_image', array($col => $id, 'name' => $name, 'absolute_path' => $path.$dir.$name));
            //echo "$url:Plik istnieje\n";
        }
    }
    return $cnt;
}

$time_start = microtime(true);

echo "--1--\n";
$results = DB::query("select p.id, xp.ImageMediumURL, xp.ImageLargeURL from product p
join x_products xp on xp.product_id = p.id
join offer o on o.product_id = p.id
left join product_image pi on pi.product_id = p.id
where o.available = 1 and pi.id is null;");
$cnt1 = go($results, 0);

echo "--2--\n";
$results = DB::query("select tp.id, xp.ImageMediumURL, xp.ImageLargeURL from temporary_product tp
join offer o on o.temporary_product_id = tp.id
join x_products xp on xp.offer_id = o.id
left join product_image pi on pi.temporary_product_id = tp.id
where o.available = 1 and pi.id is null;");
$cnt2 = go($results, 1);

echo "--3--\n";
$results = DB::query("select tp.id, xp.ImageMediumURL, xp.ImageLargeURL from temporary_product tp, offer o, x_products xp
                     where o.available = 1 and o.visible = 0 and o.temporary_product_id = tp.id and o.id = xp.offer_id;");
$cnt3 = go($results, 1);

echo "--4--\n";
$results = DB::query("select tp.id, xp.ImageMediumURL, xp.ImageLargeURL from temporary_product tp, offer o, x_products xp
                     where o.available = 1 and o.visible = 0 and o.temporary_product_id = tp.id and tp.ean = xp.ProductEAN;");
$cnt4 = go($results, 1);

echo "--5--\n";
// pobranie brakujacych plikow do wpisow ktore sa w bazie (nie powinno tak byc ale sie zdarzylo)
$results = DB::query("select pi.id, xp.ImageMediumURL, xp.ImageLargeURL from product_image pi join x_products xp on pi.product_id = xp.product_id;");
$cnt5 = go($results, 3);

DB::query('update offer o inner join product_image pi on o.product_id = pi.product_id set o.visible = 1
          where pi.product_id is not null and o.visible = 0;');

DB::query('update offer o inner join product_image pi on o.temporary_product_id = pi.temporary_product_id set o.visible = 1
          where pi.temporary_product_id is not null and o.visible = 0;');

echo 'exec time: '.(microtime(true)-$time_start);

$msg = "Pobrano zdjecia do ".($cnt1+$cnt2+$cnt3+$cnt4+$cnt5)." produktow w czasie ".round(microtime(true)-$time_start)." sek.";

mail('lukasz@pasujemi.com, kasia@pasujemi.com', 'Import zdjec produktow', $msg, 'From: System PasujeMi.pl <no-reply@pasujemi.com>');

?>
