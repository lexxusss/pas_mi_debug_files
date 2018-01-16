<?php
//SimplePie
require_once '/usr/share/php/php-simplepie/autoloader.php';

//MeekroDB (http://www.meekro.com/quickstart.php)
require_once '/home/lrzepecki/php/config/meekrodb.2.3.class.php';
require_once '/home/lrzepecki/php/config/db.conf';

#DB::$dbName = 'pasujemi20151027'; //pasujemi20151027 //pasujemi_dev_sfth

#blogspot
$blogs = array(
#   '101' => array('type' => 0,    'name' => 'JEANS PLEASE!',   'slug' => 'jeansplease',   'url' => 'http://jeansplease.blogspot.com/feeds/posts/default'),
#   '102' => array('type' => 0,    'name' => 'roksana-t',       'slug' => 'roksana-t',     'url' => 'http://www.roksana-t.com/feeds/posts/default'),
#   '103' => array('type' => 0,    'name' => 'Cammy    ',       'slug' => 'cammy',         'url' => 'http://www.cammy.com.pl/feeds/posts/default'),
    '104' => array('type' => 0,    'name' => 'disturbed-style', 'slug' => 'disturbed-style',        'url' => 'http://disturbed-style.blogspot.com/feeds/posts/default'),
    '105' => array('type' => 0,    'name' => 'jesuismonika',    'slug' => 'jesuismonika',  'url' => 'http://jesuismonika.blogspot.com/feeds/posts/default'),
    '106' => array('type' => 0,    'name' => 'kadikbabik',      'slug' => 'kadikbabik',    'url' => 'http://www.kadikbabik.pl/feeds/posts/default'),
    '107' => array('type' => 0,    'name' => 'sylviagaczorek',  'slug' => 'sylviagaczorek','url' => 'http://www.sylviagaczorek.blogspot.com/feeds/posts/default'),
##  '108' => array('type' => 0,    'name' => 'newlifewithfashion', 'slug' => 'newlifewithfashion',  'url' => 'http://www.newlifewithfashion.com/feeds/posts/default'), #nie dziala
#   '109' => array('type' => 0,    'name' => 'me---gusta',      'slug' => 'me---gusta',    'url' => 'http://me---gusta.blogspot.com/feeds/posts/default'),
#   '110' => array('type' => 0,    'name' => 'aim-style',       'slug' => 'aim-style',     'url' => 'http://aim-style.blogspot.com/feeds/posts/default'),
    '111' => array('type' => 0,    'name' => 'girl-fsh',        'slug' => 'girl-fsh',      'url' => 'http://girl-fsh.blogspot.com/feeds/posts/default'),
    '112' => array('type' => 0,    'name' => 'a-cup-of-ideas',  'slug' => 'a-cup-of-ideas','url' => 'http://a-cup-of-ideas.blogspot.com/feeds/posts/default'),
#   '113' => array('type' => 0,    'name' => 'blogwspodnicy',   'slug' => 'blogwspodnicy', 'url' => 'http://blogwspodnicy.blogspot.com/feeds/posts/default'),
    '114' => array('type' => 0,    'name' => 'patrycjatyszka',  'slug' => 'patrycjatyszka','url' => 'http://www.patrycjatyszka.com/feeds/posts/default'),
    '115' => array('type' => 0,    'name' => 'szafasztywniary', 'slug' => 'szafasztywniary','url' => 'http://szafasztywniary.blogspot.com/feeds/posts/default'),
#   '116' => array('type' => 0,    'name' => 'maniaszycia',     'slug' => 'maniaszycia',   'url' => 'http://www.maniaszycia.blogspot.com/feeds/posts/default'),
#   '117' => array('type' => 0,    'name' => 'magicffashion',   'slug' => 'magicffashion', 'url' => 'http://magicffashion.blogspot.com/feeds/posts/default'),
#   '118' => array('type' => 0,    'name' => 'sylviainvogue',   'slug' => 'sylviainvogue', 'url' => 'http://sylviainvogue.blogspot.com/feeds/posts/default'),
    '119' => array('type' => 0,    'name' => 'moniqueinfashionland',  'slug' => 'moniqueinfashionland',   'url' => 'http://moniqueinfashionland.blog.pl/rss'),
#   '120' => array('type' => 0,    'name' => 'tohavefabulousday',     'slug' => 'tohavefabulousday',      'url' => 'http://tohavefabulousday.blogspot.com/feeds/posts/default'),
    '121' => array('type' => 0,    'name' => 'frankybronky',          'slug' => 'frankybronky',           'url' => 'http://frankybronky.blogspot.com/feeds/posts/default'),
#   '122' => array('type' => 0,    'name' => 'avangarda-magazine',    'slug' => 'avangarda-magazine',     'url' => 'http://avangarda-magazine.blogspot.com/feeds/posts/default'),
    '123' => array('type' => 0,    'name' => 'neonowastrzala',        'slug' => 'neonowastrzala',         'url' => 'http://neonowastrzala.blogspot.com/feeds/posts/default'),
    '124' => array('type' => 0,    'name' => 'musthavefashion',       'slug' => 'musthavefashion',        'url' => 'http://www.musthavefashion.pl/rss'),
    '125' => array('type' => 0,    'name' => 'paniaga',               'slug' => 'paniaga',                'url' => 'http://paniaga.com.pl/rss'),
    '126' => array('type' => 1,    'name' => 'garancedore',           'slug' => 'garancedore',            'url' => 'www.garancedore.fr/en/feed'),
    '127' => array('type' => 1,    'name' =>'blueisinfashionthisyear','slug' => 'blueisinfashionthisyear','url' => 'http://blueisinfashionthisyear.com/feed'),
##  '128' => array('type' => 1,    'name' => 'kayture',               'slug' => 'kayture',                'url' => 'http://www.kayture.com/feed'), #nie dziala
    '129' => array('type' => 1,    'name' => 'thefashionfruit',       'slug' => 'thefashionfruit',        'url' => 'http://www.thefashionfruit.com/feed'),
    '130' => array('type' => 1,    'name' => 'theblondesalad',        'slug' => 'theblondesalad',         'url' => 'http://www.theblondesalad.com/feed'),
#   '131' => array('type' => 0,    'name' => 'mikalafashion',         'slug' => 'mikalafashion',          'url' => 'http://mikalafashion.blogspot.com/feeds/posts/default'),
##  '132' => array('type' => 0,    'name' => 'raspberryandred',         'slug' => 'raspberryandred',          'url' => 'http://raspberryandred.net/rss'), #nie dziala
    '133' => array('type' => 0,    'name' => 'cajmel',         'slug' => 'cajmel',          'url' => 'http://www.cajmel.pl/feeds/posts/default'),
#   '134' => array('type' => 0,    'name' => 'beauty-fashion-shopping',         'slug' => 'beauty-fashion-shopping',          'url' => 'http://beauty-fashion-shopping.pl/rss'),
    '135' => array('type' => 0,    'name' => 'kapuczina',         'slug' => 'kapuczina',          'url' => 'http://kapuczina.com/rss'),
    '136' => array('type' => 0,    'name' => 'sasanja',         'slug' => 'sasanja',          'url' => 'http://sasanja.blogspot.com/feeds/posts/default'),
    '137' => array('type' => 0,    'name' => 'tufafin',         'slug' => 'tufafin',          'url' => 'http://tufafin.blogspot.com/feeds/posts/default'),
    '138' => array('type' => 0,    'name' => 'dashblog',         'slug' => 'dashblog',          'url' => 'http://www.dashblog.pl/rss'),
    '139' => array('type' => 0,    'name' => 'modishyou',         'slug' => 'modishyou',          'url' => 'http://www.modishyou.com/feeds/posts/default'),
    '140' => array('type' => 0,    'name' => 'maaryclark',         'slug' => 'maaryclark',          'url' => 'http://maaryclark.com/rss'),
    '141' => array('type' => 0,    'name' => 'shinysyl',         'slug' => 'shinysyl',          'url' => 'http://shinysyl.com/rss'),
#   '142' => array('type' => 0,    'name' => 'Blueberry',         'slug' => 'stylowakobieta',          'url' => 'http://stylowakobieta.info.pl/rss'),
    '143' => array('type' => 1,    'name' => 'fashion-landscape',         'slug' => 'fashion-landscape',          'url' => 'http://fashion-landscape.com/rss'),
    '144' => array('type' => 1,    'name' => 'Thrifts and Threads',         'slug' => 'thriftsandthreads',          'url' => 'http://www.thriftsandthreads.com/rss'),
    '145' => array('type' => 1,    'name' => 'TCOH',         'slug' => 'thechroniclesofher',          'url' => 'http://thechroniclesofher.blogspot.it/feeds/posts/default'),
    '146' => array('type' => 0,    'name' => 'joannabiawo',         'slug' => 'joannabiawo',          'url' => 'http://joannabiawo.com/rss'),
    '147' => array('type' => 0,    'name' => 'horkruks',         'slug' => 'horkruks',          'url' => 'http://www.horkruks.com/feeds/posts/default'),
    '148' => array('type' => 0,    'name' => 'oliviakijo',         'slug' => 'oliviakijo',          'url' => 'http://www.oliviakijo.com/feeds/posts/default'),
    '149' => array('type' => 1,    'name' => 'oraclefox',         'slug' => 'oraclefox',          'url' => 'http://oraclefox.com/rss'),
    '150' => array('type' => 1,    'name' => 'herwearabouts',         'slug' => 'herwearabouts',          'url' => 'http://herwearabouts.com/rss'),
    '151' => array('type' => 1,    'name' => 'tsangtastic',         'slug' => 'tsangtastic',          'url' => 'http://tsangtastic.com/rss'),
    '152' => array('type' => 1,    'name' => 'proseccoandplaid',         'slug' => 'proseccoandplaid',          'url' => 'http://proseccoandplaid.com/rss'),
    '153' => array('type' => 1,    'name' => 'aylinkoenig',         'slug' => 'aylinkoenig',          'url' => 'http://aylinkoenig.com/rss'),
    '154' => array('type' => 1,    'name' => 'naadyaal',         'slug' => 'naadyaal',          'url' => 'http://www.naadyaal.com/rss'),
    '155' => array('type' => 1,    'name' => 'MesmerizeFashion',         'slug' => 'mesmerizefashion',          'url' => 'http://www.mesmerizefashion.eu/feeds/posts/default'),
    '156' => array('type' => 0,    'name' => 'MakeLifeEasier',         'slug' => 'makelifeeasier',          'url' => 'http://www.makelifeeasier.pl/rss'),
    '157' => array('type' => 1,    'name' => 'FashionMugging',         'slug' => 'fashionmugging',          'url' => 'http://fashionmugging.com/rss'),
    '158' => array('type' => 1,    'name' => 'The Chriselle Factor',         'slug' => 'thechrisellefactor',          'url' => 'http://thechrisellefactor.com/rss'),
    '159' => array('type' => 1,    'name' => 'Gabifresh',         'slug' => 'gabifresh',          'url' => 'http://gabifresh.com/rss'),
    '160' => array('type' => 1,    'name' => 'Aleali May',         'slug' => 'alealimay',          'url' => 'http://http://www.alealimay.com/___'),
    '161' => array('type' => 1,    'name' => 'Love by Lucy',         'slug' => 'lovelybylucy',          'url' => 'http://lovelybylucy.com/rss'),
    '162' => array('type' => 1,    'name' => 'Song of Style',         'slug' => 'songofstyle',          'url' => 'http://www.songofstyle.com/rss'),
    '163' => array('type' => 1,    'name' => '5 Inch and Up',         'slug' => '5inchandup',          'url' => 'http://5inchandup.com/rss'),
    '164' => array('type' => 1,    'name' => 'Gary Pepper',         'slug' => 'garypeppergirl',          'url' => 'http://garypeppergirl.com/rss'),
    '165' => array('type' => 1,    'name' => 'Style me Grasie',         'slug' => 'grasiemercedes',          'url' => 'http://www.grasiemercedes.com/rss'),
    '166' => array('type' => 1,    'name' => 'The Frugality',         'slug' => 'the-frugality',          'url' => 'http://www.the-frugality.com/feeds/posts/default'),
    '167' => array('type' => 1,    'name' => 'Stella\'s Wardrobe',         'slug' => 'stellaswardrobe',          'url' => 'http://www.stellaswardrobe.com/feeds/posts/default'),
    '168' => array('type' => 0,    'name' => 'Kinga Creations',         'slug' => 'kingacreations',          'url' => 'http://www.kingacreations.pl/feed/'),
    '169' => array('type' => 0,    'name' => 'Kasia Koniakowska',         'slug' => 'kasiakoniakowska',          'url' => 'http://kasiakoniakowska.blogspot.com/feeds/posts/default')
    
);

$cnt = 0;
$time_start = microtime(true);

foreach ($blogs as $key => $blog) {
    $blog['id'] = $key;
    $blog['active'] = 1;
    $blog['created_at'] = date("Y-m-d H:i:s");
    //$blog['type'] = 0; // 0-polski/1-zagraniczny
    //$blog['slug'] = DB::query("select slugify('".$blog['name']."', 'blogosphere')");
    $r = DB::insertUpdate('blogosphere', $blog);    
}

foreach ($blogs as $key => $blog) {
    $feed = new SimplePie();
    $feed->set_feed_url($blog['url']);
    $feed->enable_order_by_date(false);
    $feed->set_cache_location('/home/lrzepecki/php/rss-cache');
    $feed->set_item_limit(20);
    $feed->enable_cache();
    $feed->init();
    $blogTitle = $feed->get_title();
    //print_r($feed->get_items());
    foreach ($feed->get_items() as $item) {
        $rowArr = array();
        $rowArr['blog_id'] = $key;
        $rowArr['image_url'] = image_from_description($item->get_description(), $item->get_content());
        if (!empty($rowArr['image_url'])) {
            $rowArr['description'] = trim(substr(html_entity_decode(strip_tags($item->get_description())), 0, 255));
            $title = trim($item->get_title() ? html_entity_decode(strip_tags($item->get_title())) : $rowArr['description']);
            $rowArr['name'] = (strlen($title) >= 100 ? substr($title, 0, 97).'...' : $title);
            $rowArr['url'] = $item->get_permalink();
            $rowArr['active'] = 1;
            $rowArr['hash_id'] = md5($rowArr['blog_id'].$rowArr['url']);
            $rowArr['created_at'] = $item->get_date('Y-m-d H:i:s');
            if (!empty($rowArr['name']) && !empty($rowArr['image_url']) && !empty($rowArr['url'])) {
                $r = DB::insertIgnore('blogosphere_entries', $rowArr);
                echo $r;
                $cnt++;
            }
        } else {
            //print_r($item->get_content());
            //print_r($item->get_description());
            //exit();
        }
    }
}

function image_from_description($desc, $content) {
    preg_match_all('/src="([^"]*)"([^>]*)>/i', $desc, $matches);
    $image = (!empty($matches[1][0])) ? $matches[1][0] : false;
    if (!$image) {
        preg_match_all('/src="([^"]*)"([^>]*)>/i', $content, $matches);
        $image = (!empty($matches[1][0])) ? $matches[1][0] : false;
    }
    return $image;
}

echo 'exec time: '.(microtime(true)-$time_start);

$msg = "Pobrano $cnt wpisow z blogosfery w czasie ".round(microtime(true)-$time_start)." sek.";

//mail('lukasz@pasujemi.com, kasia@pasujemi.com', 'Import blogosfery', $msg, 'From: System PasujeMi.pl <no-reply@pasujemi.com>');

?>
