<?php
// http://www.meekro.com/quickstart.php
require_once 'config/meekrodb.2.3.class.php';
// http://pear.php.net/manual/en/package.http.http-request2.php
require_once 'HTTP/Request2.php';
require_once 'config/db.conf';

$cnt = 0;
$time_start = microtime(true);
$results = DB::query('SELECT o.id,o.real_url FROM offer o join product p on p.offer_id = o.id
WHERE o.real_url is not NULL and o.available = 1 and (p.sort_order < 100000 or p.stylization_count > 0) and o.shop_id in (10, 11) LIMIT 10000'); //tylko zalando i asos
//SELECT o.id,o.product_url FROM offer o join product p on p.offer_id = o.id WHERE o.available = 1 and ((p.view_count > 0 and p.sort_order > 100000) or p.stylization_count > 0) and o.shop_id = 11 LIMIT 50000");
foreach ($results as $row) {    
    $id = $row['id'];
    $url = $row['real_url'];
    $request = new HTTP_Request2($url, HTTP_Request2::METHOD_GET);
    $request->setHeader('connection', 'Keep-Alive');
    $request->setConfig(array(
        'adapter' => 'HTTP_Request2_Adapter_Curl',
        'connect_timeout' => 7,
        'timeout' => 7,
        'follow_redirects' => TRUE,
        'max_redirects' => 3,
    ));
    try {
        $response = $request->send();
        if (200 == $response->getStatus()) {
            $real_url = $response->getEffectiveUrl();
            $body = $response->getBody();
            $available = (strpos($body, 'outofstock-msg') !== false OR strpos($body, 'notification-item') !== false) ? 0 : 1;
            if ($available == 0 && DB::update('offer', array('real_url' => $real_url, 'available' => $available), "id=%i", $id)) $cnt++;
            echo "[$available]";
        } else {
            echo 'Unexpected HTTP status: '.$response->getStatus().' '.$response->getReasonPhrase();
        }
    } catch (HTTP_Request2_Exception $e) {
        echo 'Error: '.$e->getMessage();
    }
    echo "\n";
}
echo 'exec time: '.(microtime(true)-$time_start);

$msg = "Sprawdzono ".sizeof($results)." produktów i zaktualizowano $cnt nieaktywnych w czasie ".round(microtime(true)-$time_start)." sek.";

mail('lukasz@pasujemi.com, kasia@pasujemi.com', 'Aktualizacja dostepnosci produktow', $msg, 'From: System PasujeMi.pl <no-reply@pasujemi.com>');

?>
