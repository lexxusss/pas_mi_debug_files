<?php
// http://www.meekro.com/quickstart.php
require_once 'config/meekrodb.2.3.class.php';
// http://pear.php.net/manual/en/package.http.http-request2.php
require_once 'HTTP/Request2.php';
require_once 'config/db.conf';

$path = '/var/www/html/pasujemi/web/sitemap';

$header = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
';

$data = '<url><loc>https://pasujemi.pl/</loc><lastmod>'.date("Y-m-d")."</lastmod><changefreq>daily</changefreq><priority>1.0</priority></url>
<url><loc>https://pasujemi.pl/stylizacje</loc><lastmod>".date("Y-m-d")."</lastmod><changefreq>daily</changefreq><priority>1.0</priority></url>
<url><loc>https://pasujemi.pl/stylizacje/uzytkowniczek</loc><lastmod>".date("Y-m-d")."</lastmod><changefreq>daily</changefreq><priority>0.5</priority></url>
<url><loc>https://pasujemi.pl/ubrania/najnowsze</loc><lastmod>".date("Y-m-d")."</lastmod><changefreq>daily</changefreq><priority>1.0</priority></url>
<url><loc>https://pasujemi.pl/ubrania/wszystkie</loc><lastmod>".date("Y-m-d")."</lastmod><changefreq>daily</changefreq><priority>0.9</priority></url>
<url><loc>https://pasujemi.pl/premium/ubrania/najnowsze</loc><lastmod>".date("Y-m-d")."</lastmod><changefreq>daily</changefreq><priority>0.9</priority></url>
<url><loc>https://pasujemi.pl/premium/ubrania/wszystkie</loc><lastmod>".date("Y-m-d")."</lastmod><changefreq>daily</changefreq><priority>0.8</priority></url>
<url><loc>https://pasujemi.pl/blogosfera</loc><lastmod>".date("Y-m-d")."</lastmod><changefreq>hourly</changefreq><priority>1.0</priority></url>
<url><loc>https://pasujemi.pl/s/jeans</loc><lastmod>".date("Y-m-d")."</lastmod><changefreq>weekly</changefreq><priority>0.7</priority></url>
<url><loc>https://pasujemi.pl/s/sukienka</loc><lastmod>".date("Y-m-d")."</lastmod><changefreq>weekly</changefreq><priority>0.7</priority></url>
";

$footer = "</urlset>";

$cnt = 8;
$time_start = microtime(true);

$results = DB::query("SELECT slug,section FROM page");
foreach ($results as $row) {
    $prio = $row['section'] < 3 ? '0.2' : '0.3';
    $data .= '<url><loc>https://pasujemi.pl/'.$row['slug'].'</loc><lastmod>'.date("Y-m-01")."</lastmod><changefreq>monthly</changefreq><priority>$prio</priority></url>\n";
    $cnt++;
}

$results = DB::query("SELECT slug,show_in_menu FROM stylization_category where hidden = 0");
foreach ($results as $row) {
    $prio = $row['show_in_menu'] == 1 ? '1.0' : '0.8';
    $data .= '<url><loc>https://pasujemi.pl/stylizacje/'.$row['slug'].'</loc><lastmod>'.date("Y-m-d")."</lastmod><changefreq>daily</changefreq><priority>$prio</priority></url>\n";
    $cnt++;
}

$results = DB::query("SELECT slug,parent_id FROM category where hidden = 0");
foreach ($results as $row) {
    $prio = $row['parent_id'] == '' ? '0.9' : '0.7';
    $data .= '<url><loc>https://pasujemi.pl/ubrania/'.$row['slug'].'</loc><lastmod>'.date("Y-m-d")."</lastmod><changefreq>daily</changefreq><priority>$prio</priority></url>\n";
    $cnt++;
    $prio = $row['parent_id'] == '' ? '0.6' : '0.5';
    $data .= '<url><loc>https://pasujemi.pl/premium/ubrania/'.$row['slug'].'</loc><lastmod>'.date("Y-m-d")."</lastmod><changefreq>weekly</changefreq><priority>$prio</priority></url>\n";
    $cnt++;
}

$results = DB::query("SELECT concat(c.slug, '/marka/', b.slug) path
from product p join brand b on b.id = p.brand_id join category c on c.id = p.category_id
where p.status = 0 and p.category_id is not null and p.offer_id is not null and p.brand_id is not null
group by p.brand_id, p.category_id having count(*) > 0");
foreach ($results as $row) {
    $prio = '0.8';
    $data .= '<url><loc>https://pasujemi.pl/ubrania/'.$row['path'].'</loc><lastmod>'.date("Y-m-d")."</lastmod><changefreq>daily</changefreq><priority>$prio</priority></url>\n";
    $cnt++;
}

$results = DB::query("SELECT sc.slug as category_slug,s.slug,DATE_FORMAT(s.updated_at,'%Y-%m-%d') as date FROM stylization s JOIN stylization_category_stylization scs on s.id=scs.stylization_id join stylization_category sc on sc.id = scs.stylization_category_id where s.active = 1");
foreach ($results as $row) {
    $prio = '0.6';
    $data .= '<url><loc>https://pasujemi.pl/stylizacja/'.$row['category_slug'].'/'.$row['slug'].'</loc><lastmod>'.$row['date']."</lastmod><changefreq>weekly</changefreq><priority>$prio</priority></url>\n";
    $cnt++;
}

$results = DB::query("SELECT b.slug, count(*) as count FROM brand b join product p on p.brand_id = b.id join offer o on o.product_id = p.id where o.visible = 1 and b.slug is not null group by p.brand_id having count(*) > 8;");
foreach ($results as $row) {
    $prio = $row['count'] > 80 ? '0.7' : '0.5';
    $data .= '<url><loc>https://pasujemi.pl/marki/'.$row['slug'].'</loc><lastmod>'.date("Y-m-d")."</lastmod><changefreq>weekly</changefreq><priority>$prio</priority></url>\n";
    $cnt++;
}

/* #tymczasowo wylaczone
$results = DB::query("SELECT bl.slug, b.hash_id ,DATE_FORMAT(b.created_at,'%Y-%m-%d') as date FROM blogosphere_entries b JOIN blogosphere bl ON bl.id = b.blog_id where b.active = 1 and bl.active = 1");
foreach ($results as $row) {
    $prio = '0.1';
    $data .= '<url><loc>https://pasujemi.pl/blogosfera/'.$row['slug'].'/'.$row['hash_id'].'</loc><lastmod>'.$row['date']."</lastmod><changefreq>monthly</changefreq><priority>$prio</priority></url>\n";
    $cnt++;
}
*/

$num = 1;
file_put_contents($path.$num.'.xml', $header.$data);
$results = DB::query("SELECT count(*) as count FROM product p join offer o on o.product_id = p.id where o.visible = 1");
$k = round($results[0]['count']/10000, 0);

for ($ii = 0; $ii <= $k; $ii++) {
    $data = '';
    echo $cnt."\n";
    $results = DB::query("SELECT p.category_slug,p.slug,o.available,DATE_FORMAT(p.updated_at,'%Y-%m-%d') as date,((p.stylization_count+1)*(p.view_count+1)) as pop FROM product p join offer o on o.product_id = p.id where o.visible = 1 LIMIT ".($ii*10000).",10000");
    foreach ($results as $row) {
        $prio = $row['pop'] > 5 ? '0.5' : '0.4';
	if ($row['available'] == 0) $prio = '0.1';
        $data .= '<url><loc>https://pasujemi.pl/ubranie/'.$row['category_slug'].'/'.$row['slug'].'</loc><lastmod>'.$row['date']."</lastmod><changefreq>weekly</changefreq><priority>$prio</priority></url>\n";
        $cnt++;
        if ($cnt/40000 == $num) {
            file_put_contents($path.$num.'.xml', $data.$footer, FILE_APPEND);
            chmod($path.$num.'.xml', 0755);
            $num++;
            file_put_contents($path.$num.'.xml', $header);
            $data = '';
        }
    }
    file_put_contents($path.$num.'.xml', $data, FILE_APPEND);
}
file_put_contents($path.$num.'.xml', $footer, FILE_APPEND);
chmod($path.$num.'.xml', 0755);

$index = '<?xml version="1.0" encoding="UTF-8"?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";
for($j = 1; $j <= $num; $j++) {
$index .= "<sitemap>
    <loc>https://pasujemi.pl/sitemap".$j.".xml</loc>
    <lastmod>".date("c")."</lastmod>
</sitemap>\n";
}   
$index .= '</sitemapindex>';
file_put_contents($path.'.xml', $index);
chmod($path.'.xml', 0755);

echo "count: $cnt, maps: $num, exec time: ".(microtime(true)-$time_start);

$msg = "Zapisano $cnt linkow w mapie strony w czasie ".round(microtime(true)-$time_start)." sek.";

mail('lukasz@pasujemi.com, kasia@pasujemi.com', 'Aktualizacja mapy strony', $msg, 'From: System PasujeMi.pl <no-reply@pasujemi.com>');

?>
