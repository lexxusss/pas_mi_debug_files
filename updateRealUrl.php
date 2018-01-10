<?php
// http://www.meekro.com/quickstart.php
require_once 'meekrodb.2.3.class.php';
// http://pear.php.net/manual/en/package.http.http-request2.php
require_once 'HTTP/Request2.php';
require_once 'db.conf';

$cnt = 0;
$time_start = microtime(true); 
$results = DB::query("SELECT id,product_url FROM offer WHERE real_url IS NULL and available = 1 LIMIT 50000");
foreach ($results as $row) {
    $id = $row['id'];
    $url = $row['product_url'];
    $request = new HTTP_Request2($url, HTTP_Request2::METHOD_GET);
    $request->setHeader('connection', 'Keep-Alive');
    $request->setConfig(array(
        'adapter' => 'HTTP_Request2_Adapter_Curl',
        'connect_timeout' => 15,
        'timeout' => 30,
        'follow_redirects' => TRUE,
        'max_redirects' => 5,
    ));
    try {
        $response = $request->send();
        if (200 == $response->getStatus()) {
            $real_url = $response->getEffectiveUrl();
            $body = $response->getBody();
            if (DB::update('offer', array('real_url' => $real_url), "id=%i", $id)) { $cnt++; echo 1; } else { echo 0; }
        } else {
            echo 'Unexpected HTTP status: '.$response->getStatus().' '.$response->getReasonPhrase();
        }
    } catch (HTTP_Request2_Exception $e) {
        echo 'Error: '.$e->getMessage();
    }
    echo "\n";
}
echo 'exec time: '.(microtime(true)-$time_start);

$msg = "Zaktualizowano $cnt linkow do produktow w sklepach w czasie ".round(microtime(true)-$time_start)." sek.";

mail('lukasz@pasujemi.com, kasia@pasujemi.com', 'Aktualizacja linkow do produktow', $msg, 'From: System PasujeMi.pl <no-reply@pasujemi.com>');

?>
