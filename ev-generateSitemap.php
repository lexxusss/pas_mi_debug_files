<?php
// https://www.meekro.com/quickstart.php
require_once 'meekrodb.2.3.class.php';
// https://pear.php.net/manual/en/package.http.http-request2.php
require_once 'HTTP/Request2.php';
require_once 'ev-db.conf';

$path = '/var/www/html/eventi/web/sitemap';

$header = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
';

$data = '<url><loc>https://eventi.pl/</loc><lastmod>'.date("Y-m-d").'</lastmod><changefreq>weekly</changefreq><priority>1.0</priority></url>
<url><loc>https://eventi.pl/about</loc><lastmod>'.date("Y-m-01").'</lastmod><changefreq>monthly</changefreq><priority>0.4</priority></url>
<url><loc>https://eventi.pl/regulations</loc><lastmod>'.date("Y-m-01").'</lastmod><changefreq>monthly</changefreq><priority>0.3</priority></url>
<url><loc>https://eventi.pl/privacy</loc><lastmod>'.date("Y-m-01").'</lastmod><changefreq>monthly</changefreq><priority>0.2</priority></url>
<url><loc>https://eventi.pl/faq</loc><lastmod>'.date("Y-m-01").'</lastmod><changefreq>monthly</changefreq><priority>0.5</priority></url>
<url><loc>https://eventi.pl/pricing</loc><lastmod>'.date("Y-m-01").'</lastmod><changefreq>monthly</changefreq><priority>0.5</priority></url>
<url><loc>https://eventi.pl/contact</loc><lastmod>'.date("Y-m-01").'</lastmod><changefreq>monthly</changefreq><priority>0.4</priority></url>
<url><loc>https://partner.eventi.pl</loc><lastmod>'.date("Y-m-d").'</lastmod><changefreq>weekly</changefreq><priority>1.0</priority></url>
<url><loc>https://partner.eventi.pl/catering</loc><lastmod>'.date("Y-m-d").'</lastmod><changefreq>weekly</changefreq><priority>0.9</priority></url>
<url><loc>https://partner.eventi.pl/dekoracje-i-akcesoria</loc><lastmod>'.date("Y-m-d").'</lastmod><changefreq>weekly</changefreq><priority>0.9</priority></url>
<url><loc>https://partner.eventi.pl/muzyka</loc><lastmod>'.date("Y-m-d").'</lastmod><changefreq>weekly</changefreq><priority>0.9</priority></url>
<url><loc>https://partner.eventi.pl/kosmetyczne</loc><lastmod>'.date("Y-m-d").'</lastmod><changefreq>weekly</changefreq><priority>0.9</priority></url>
<url><loc>https://partner.eventi.pl/rozrywka</loc><lastmod>'.date("Y-m-d").'</lastmod><changefreq>weekly</changefreq><priority>0.9</priority></url>
<url><loc>https://partner.eventi.pl/konsultanci</loc><lastmod>'.date("Y-m-d").'</lastmod><changefreq>weekly</changefreq><priority>0.9</priority></url>
<url><loc>https://partner.eventi.pl/transport</loc><lastmod>'.date("Y-m-d").'</lastmod><changefreq>weekly</changefreq><priority>0.9</priority></url>
<url><loc>https://partner.eventi.pl/fotografia-i-filmowanie</loc><lastmod>'.date("Y-m-d").'</lastmod><changefreq>weekly</changefreq><priority>0.9</priority></url>
<url><loc>https://partner.eventi.pl/wynajem</loc><lastmod>'.date("Y-m-d").'</lastmod><changefreq>weekly</changefreq><priority>0.9</priority></url>
<url><loc>https://eventi.pl/login</loc><lastmod>'.date("Y-m-01").'</lastmod><changefreq>monthly</changefreq><priority>0.6</priority></url>
<url><loc>https://eventi.pl/registration</loc><lastmod>'.date("Y-m-01").'</lastmod><changefreq>monthly</changefreq><priority>0.7</priority></url>
';

$footer = "</urlset>";

$cnt = 19;
$time_start = microtime(true);

$results = DB::query("SELECT distinct(slug) slug FROM event_type_translation where locale = 'pl'");
foreach ($results as $row) {
    $data .= '<url><loc>https://krakow.eventi.pl/'.$row['slug'].'</loc><lastmod>'.date("Y-m-d")."</lastmod><changefreq>daily</changefreq><priority>0.8</priority></url>\n";
	$data .= '<url><loc>https://katowice.eventi.pl/'.$row['slug'].'</loc><lastmod>'.date("Y-m-d")."</lastmod><changefreq>daily</changefreq><priority>0.8</priority></url>\n";
    $cnt++; $cnt++;
}

$results = DB::query("SELECT distinct(slug) slug FROM service_category_translation where locale = 'pl'");
foreach ($results as $row) {
    $data .= '<url><loc>https://krakow.eventi.pl/'.$row['slug'].'</loc><lastmod>'.date("Y-m-d")."</lastmod><changefreq>daily</changefreq><priority>0.7</priority></url>\n";
	$data .= '<url><loc>https://katowice.eventi.pl/'.$row['slug'].'</loc><lastmod>'.date("Y-m-d")."</lastmod><changefreq>daily</changefreq><priority>0.7</priority></url>\n";
    $cnt++; $cnt++;
}

$results = DB::query("SELECT t.slug as typ, c.slug as kat FROM event_type_translation t
	join event_categories ec on ec.event_id = t.translatable_id
	join service_category_translation c on c.translatable_id = ec.category_id
	where t.locale = 'pl' and c.locale = 'pl'");
foreach ($results as $row) {
	$data .= '<url><loc>'.'https://eventi.pl/creator/configuration?'.urlencode('t='.$row['typ'].'&c='.$row['kat'].'&l=Kraków').'</loc><lastmod>'.date("Y-m-d")."</lastmod><changefreq>daily</changefreq><priority>0.8</priority></url>\n";
	$data .= '<url><loc>'.'https://eventi.pl/creator/configuration?'.urlencode('t='.$row['typ'].'&c='.$row['kat'].'&l=Katowice').'</loc><lastmod>'.date("Y-m-d")."</lastmod><changefreq>daily</changefreq><priority>0.8</priority></url>\n";
    $cnt++; $cnt++;
}

/*
https://eventi.pl/creator/configuration?t=slub
c - lista slugów kategorii usług np. "catering,muzyka-dj,muzyka-naglosnienie"
t  - slug typu wydarzenia np. slub
d - termin wydarzenia, w następujących dwóch wariantach: <DATETIME>-<DATETIME> lub <DATETIME> (<DATETIME> do data w formacie DD-MM-YYYY HH:mm:ss lub DD-MM-YYYY)
l - lokalizacja wydarzenia zgodnie z gramatyką:
LOKALIZACJA ::=  PARAMETR ("," PARAMETR)*
PARAMETR ::= KOD_POCZTOWY | MIEJSCOWOŚĆ | KOD_KRAJU
KOD_POCZTOWY ::= ^([0-9]|-)+$
MIEJSCOWOŚĆ ::= slug 
KOD_KRAJU ::= ^[A-Z]{2}*
*/

$results = DB::query("SELECT distinct(slug) slug, updatedAt FROM fos_user where slug is not null and slug not like '%test%' and id > 143 and roles like '%ROLE_PARTNER%';");
foreach ($results as $row) {
    $data .= '<url><loc>https://eventi.pl/partner/'.$row['slug'].'</loc><lastmod>'.substr($row['updatedAt'], 0, 10)."</lastmod><changefreq>monthly</changefreq><priority>0.5</priority></url>\n";
    $cnt++;
}

file_put_contents($path.'.xml', $header.$data.$footer);
chmod($path.'.xml', 0755);

echo "count: $cnt, exec time: ".(microtime(true)-$time_start);

$msg = "Zapisano $cnt linkow w mapie strony w czasie ".round(microtime(true)-$time_start)." sek.";

mail('lukasz@rzepecki.net', 'Aktualizacja mapy strony', $msg, 'From: System Eventi.pl <no-reply@eventi.pl>');

?>
