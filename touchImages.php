<?php
// http://www.meekro.com/quickstart.php
require_once '/home/lrzepecki/php/config/meekrodb.2.3.class.php';
require_once '/home/lrzepecki/php/config/db.conf';

$cnt = DB::query("SELECT count(*) as cnt from product_image;");
$count = $cnt[0]['cnt'];

echo $count."\n";

function touchImages($start = 0, $count) {
    $num = 1000;
    $results = DB::query("SELECT absolute_path from product_image limit $start, $num;");
    echo "$start, $num\n";
    foreach ($results as $row)
        touch($row['absolute_path']);
    if (($start + $num) < $count)
        touchImages($start + $num, $count);
}

touchImages(0, $count);

?>
