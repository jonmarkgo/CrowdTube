<?php
$link = mysql_connect('localhost', 'jongottc_jontv', 'ZV.28q%fGFAV');
mysql_select_db('jongottc_jontv');
$q = mysql_query("SELECT * from queue where played=2");
$r = mysql_fetch_assoc($q);
$q2 = mysql_query("SELECT COUNT(number) as cnt from bbvote where vote=1 and queue_id=".$r['id']);
$up = mysql_fetch_assoc($q2);
$q3 = mysql_query("SELECT COUNT(number) as cnt from bbvote where vote=2 and queue_id=".$r['id']);
$down = mysql_fetch_assoc($q3);
?>
<img class="middle" src="./images/down.png" /><span class="down"><?php echo $down['cnt']; ?></span>
                    <img class="middle" src="./images/up.png" /><span class="up"><?php echo $up['cnt']; ?></span>