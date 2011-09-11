<?php
header('Content-type: text/xml');
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<Response>';
# @start snippet
$user_pushed = (int) $_REQUEST['Digits'];
# @end snippet

$link = mysql_connect('localhost', 'jongottc_jontv', 'ZV.28q%fGFAV');
mysql_select_db('jongottc_jontv');
$q = mysql_query("SELECT * from queue where played=2");
$r = mysql_fetch_assoc($q);
mysql_query("INSERT INTO bbvote SET number='".$_REQUEST['From']."', queue_id=".$r['id'].", vote=".$user_pushed);
echo"<Say>Thank you for voting!</Say>";
if ($user_pushed = 1) {
echo "<Sms>You have given this video a thumbs up! Thanks for voting. - Powered by Twilio http://www.twilio.com/</Sms>";
}
else {
  echo "<Sms>You have given this video a thumbs down! Thanks for voting. - Powered by Twilio http://www.twilio.com/</Sms>";
 
}
echo '<Hangup /></Response>';
?>