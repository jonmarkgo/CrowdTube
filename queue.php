<?php
$link = mysql_connect('localhost', 'jongottc_jontv', 'ZV.28q%fGFAV');
mysql_select_db('jongottc_jontv');

$q = mysql_query("SELECT * from queue WHERE played = 0 order by id ASC LIMIT 0,5");
if (mysql_num_rows($q) == 0) {
    echo "YOUR VIDEO";
}
else {
require_once 'Zend/Loader.php'; // the Zend dir must be in your include_path
Zend_Loader::loadClass('Zend_Gdata_YouTube');
$yt = new Zend_Gdata_YouTube();

    while ($r = mysql_fetch_assoc($q)) {

$videoEntry = $yt->getVideoEntry($r['vimeo_id']);
  $videoThumbnails = $videoEntry->getVideoThumbnails();

$thumb = $videoThumbnails[0];

   

echo'<img class="middle tl tr bl br" src="'.$thumb['url'].'">';
}
}

?>