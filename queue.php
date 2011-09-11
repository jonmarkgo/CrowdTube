<?php
$link = mysql_connect('localhost', 'jongottc_jontv', 'ZV.28q%fGFAV');
mysql_select_db('jongottc_jontv');

$q = mysql_query("SELECT * from queue WHERE played = 0 order by id ASC LIMIT 0,4");
if (mysql_num_rows($q) == 0) {
    echo "YOUR VIDEO";
}
else {
require'vimeo-php-lib/vimeo.php';

$vimeo = new phpVimeo('7116fd6db1913b488868af9b0ddabe2f','47f7b1ad6cc19d56');

    while ($r = mysql_fetch_assoc($q)) {
    $imgs = $vimeo->call('vimeo.videos.getThumbnailUrls', array('video_id' => $r['vimeo_id']));
echo'<img class="middle tl tr bl br" src="'.$imgs->thumbnails->thumbnail[1]->_content.'">';
}
}

?>