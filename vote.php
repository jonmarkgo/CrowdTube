<?php

    $link = mysql_connect('localhost', 'jongottc_jontv', 'ZV.28q%fGFAV');
mysql_select_db('jongottc_jontv');
if (isset($_POST["From"])) {
header('Content-type: text/xml');
echo '<?xml version="1.0" encoding="UTF-8"?>';
$q = mysql_query("SELECT * from votes WHERE number='".$_POST['From']."'");
if (mysql_num_rows($q) > 0) {
$msg = "Sorry, you already placed your vote.";
}
else if (!is_numeric($_POST['Body'])) {
    $msg = "That is not a valid team # to vote for.";
}
else {
mysql_query("INSERT into votes VALUES ('".$_POST['From']."','".$_POST['Body']."')");
$id = mysql_insert_id();
$msg = "You have successfully voted for team # ".$_POST['Body']." - Powered by Twilio http://www.twilio.com/";
}
?>
<Response>
<Sms><?php echo $msg; ?></Sms>
</Response>
<?php }
else {
$q = mysql_query("SELECT COUNT(number) as cnt, vote FROM votes group by vote order by cnt desc");
print'<img src="http://www.twilio.com/packages/company/img/logos_downloadable_powerdby_large.png" alt="Powered by Twilio" /><br><table><tr><th><b>Team #</b></th><th>Votes</th></tr>';
while($r = mysql_fetch_assoc($q)) {
print'<tr><td>'.$r["vote"].'</td><td><i>'.$r["cnt"].'</i></td></tr>';
}
print'</table>';
}
?>