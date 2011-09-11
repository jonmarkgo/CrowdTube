<?php error_reporting(E_ALL); ?>
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

</head>

<body id= "main">

    <div class="container">
        
        <div id="header" class="span-25">
            <h1 class="center">HackDay Mashup</h1>
        </div>        
        <?php
$link = mysql_connect('localhost', 'jongottc_jontv', 'ZV.28q%fGFAV');
mysql_select_db('jongottc_jontv');

$q = mysql_query("SELECT * from queue WHERE played = 0 order by id ASC LIMIT 1");
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
if (strlen($r['number']) == 12)
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
           <iframe width="640" height="390" src="http://www.youtube.com/p/655D5AA631EBF3B7?version=3&amp;hl=en_US" frameborder="0" allowfullscreen></iframe>
           <?php
           require_once 'Zend/Loader.php'; // the Zend dir must be in your include_path
Zend_Loader::loadClass('Zend_Gdata_YouTube');
Zend_Loader::loadClass('Zend_Gdata_ClientLogin'); 
$authenticationURL= 'https://www.google.com/accounts/ClientLogin';
$httpClient = 
  Zend_Gdata_ClientLogin::getHttpClient(
              $username = 'jonmarkgo@gmail.com',
              $password = 'zccintwkfsvimeus ',
              $service = 'youtube',
              $client = null,
              $source = 'CrowdTube', // a short string identifying your application
              $loginToken = null,
              $loginCaptcha = null,
              $authenticationURL);
$developerKey = 'AI39si7mhC6ixzlFGDp6udcIVj1mUGiOMh_BhYOLkGcVPDQshJR9KzSttKm9soC7ooO9FHlKGppgJlxcaPlB0rxucAODJvT00Q';
$applicationId = 'CrowdTube v1';
$clientId = 'VHD CrowdTube - v1';

$yt = new Zend_Gdata_YouTube($httpClient, $applicationId, $clientId, $developerKey);
$searchTerms = $_POST['Body'];
  $yt->setMajorProtocolVersion(2);

  $playlistListFeed = $yt->getPlaylistListFeed('jonmarkgo');
$playlistListEntry = $playlistListFeed[0]; //CrowdTube
$playlistVideoFeed =
    $yt->getPlaylistVideoFeed($playlistListEntry->getPlaylistVideoFeedUrl());
    $x = 0;
    $playlistVideoFeed[0]->delete();

           ?>
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