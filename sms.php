<?php
header('Content-type: text/xml');
echo '<?xml version="1.0" encoding="UTF-8"?>';
$link = mysql_connect('localhost', 'jongottc_jontv', 'ZV.28q%fGFAV');
mysql_select_db('jongottc_jontv');
$q = mysql_query("SELECT * from queue WHERE number='".$_POST['From']."'");
if (mysql_num_rows($q) > 0) {
$msg = "Sorry, you already submitted a video request. Let someone else have a go!";
}
else {
require'vimeo-php-lib/vimeo.php';

$vimeo = new phpVimeo('7116fd6db1913b488868af9b0ddabe2f','47f7b1ad6cc19d56');
$videos = $vimeo->call('vimeo.videos.search', array('query' => 'cat','sort'=>'most_liked','per_page'=>10));
$vid = array_rand($videos->videos->video);
$vid = $videos->videos->video[$vid];
mysql_query("INSERT into queue VALUES (NULL,'".$_POST['From']."','".$_POST['Body']."',NULL,0,".$vid->id.",'".$_POST['FromState']."')");
$id = mysql_insert_id();
$msg = "Hi you are in line #".$id;
}
?>
<Response>
<Sms><?php echo $msg; ?></Sms>
</Response>