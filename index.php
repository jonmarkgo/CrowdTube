<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Hackday Mashup</title>
    <link rel="stylesheet" href="css/screen.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
<script>
 $(document).ready(function() {
     $("#next-image-container").load("queue.php");

     $("#rating").load("bbvote.php");
   var refreshId = setInterval(function() {

     $("#next-image-container").load("queue.php");

     $("#rating").load("bbvote.php");
   }, 2000);
   $.ajaxSetup({ cache: false });
});
</script>
<script src="froogaloop2.min.js"></script>

</head>

<body id= "main">

    <div class="container">
        
        <div id="header" class="span-25">
            <h1 class="center">HackDay Mashup</h1>
        </div>        
        <?php
$link = mysql_connect('localhost', 'jongottc_jontv', 'ZV.28q%fGFAV');
mysql_select_db('jongottc_jontv');

$q = mysql_query("SELECT * from queue WHERE played = 0 order by id ASC LIMIT 6");
if (mysql_num_rows($q) == 0) die();
$r = mysql_fetch_assoc($q);
// Include the PHP TwilioRest library
require "Services/Twilio.php";
// Set our AccountSid and AuthToken
$AccountSid = "ACf7bb6d402454c1c63335af07f8ec2b89";
$AuthToken = "0da076e5996d2ad7322cfda964345846";
// Instantiate a new Twilio Rest Client
$client = new Services_Twilio($AccountSid, $AuthToken);
/* Your Twilio Number or Outgoing Caller ID */
$from= '4248356688';
// make an associative array of server admins

$client->account->sms_messages->create($from, $r['number'], 'Your video about "'.$r['request'].'" is playing live in Times Square! - @JonMarkGo + Twilio');

mysql_query("UPDATE queue set played=1 WHERE played=2");
mysql_query("UPDATE queue set played=2 WHERE id=".$r['id']);
?>




        
        <div id="content-wrapper" class="span-25">
            <div id="content" class="span-17">
                <h2 class="message">TXT 4248356688 to request a video or CALL in to vote on the current one!</h3>
                
                <div id="rating" class="span-17">
                    <img class="middle" src="./images/down.png" /><span class="down">Thumbs Down</span>
                    <img class="middle" src="./images/up.png" /><span class="up">Thumbs Up</span>
                </div>
                
                <div id="video-wrapper" style="width:560px;float:left;">
                    
<iframe id="player" src="http://player.vimeo.com/video/<?php echo $r['vimeo_id']; ?>?api=1&player_id=player&autoplay=true&width=640" width="400" height="225" frameborder="0"></iframe> 
<script type="text/javascript">

            (function(){

                // Listen for the ready event for any vimeo video players on the page
                var vimeoPlayers = document.querySelectorAll('iframe'),
                    player;

                for (var i = 0, length = vimeoPlayers.length; i < length; i++) {
                    player = vimeoPlayers[i];
                    $f(player).addEvent('ready', ready);
                }

                /**
* Utility function for adding an event. Handles the inconsistencies
* between the W3C method for adding events (addEventListener) and
* IE's (attachEvent).
*/
                function addEvent(element, eventName, callback) {
                    if (element.addEventListener) {
                        element.addEventListener(eventName, callback, false);
                    }
                    else {
                        element.attachEvent(eventName, callback, false);
                    }
                }

                /**
* Called once a vimeo player is loaded and ready to receive
* commands. You can add events and make api calls only after this
* function has been called.
*/
                function ready(player_id) {
                    // Keep a reference to Froogaloop for this player
                    var container = document.getElementById(player_id).parentNode.parentNode,
                        froogaloop = $f(player_id);
 froogaloop.addEvent('finish', function(data) {
                                   window.location.reload();
                                });
}
})();
</script>
                    <h2 class="location center">This video sent by a visitor from <?php echo $r['state']; ?></h2>
                </div>
            </div>
            
            <div id="sidebar" class="span-7 last">
                <div class="span-7">
                    <h2 class="span-3">Powered by</h2>
                    <div class="span-3"><img class="middle" src="./images/twilio.png" style="width:100px;"/></div>
                </div>
                
                <div id="next" class="span-7">
                    <h2 class="">Coming Up Next</h2>    
                </div>
                
                <div id="next-image-container">
                    
                </div>
            </div>
        </div>
    
    <div id="footer" class="span-25">
    </div>  
    </div> <!-- end container -->
    

</body>
</html>