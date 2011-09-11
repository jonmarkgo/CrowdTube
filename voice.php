<?php
header('Content-type: text/xml');
echo '<?xml version="1.0" encoding="UTF-8"?>';
$link = mysql_connect('localhost', 'jongottc_jontv', 'ZV.28q%fGFAV');
mysql_select_db('jongottc_jontv');
$q = mysql_query("SELECT * from queue where played=2");
$r = mysql_fetch_assoc($q);
$q2 = mysql_query("SELECT * from bbvote where queue_id='".$r['id']."'");
if (mysql_num_rows($q2) == 0) {
    ?>
<Response>
<Gather action="voice-vote.php" numDigits="1">
<Say>Welcome to the video voter!</Say>
<Say>If you like the video that is playing, press 1.</Say>
<Say>If you think the video is lame, press 2.</Say>
</Gather>
<!-- If customer doesn't input anything, prompt and try again. -->
<Say>Sorry, I didn't get your response.</Say>
<Redirect>voice.php</Redirect>
</Response>
<?php
}
else {
    ?>
<Response>
<Say>I'm sorry, you have already voted for the current video.</Say>
<Hangup />
</Response>    
<?php
}

?>

