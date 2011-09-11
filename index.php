<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>CrowdTube</title>
    <link rel="stylesheet" href="css/screen.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="http://code.jquery.com/jquery-latest.js"></script>


</head>

<body id= "main">

    <div class="container">
        
        <div id="header" class="span-25">
            <h1 class="center">CrowdTube</h1>
        </div>        

        <div id="content-wrapper" class="span-25">
            <div id="content" class="span-17">
                <h2 class="message">TXT 4248356688 to request a video or CALL in to vote on the current one!</h3>
                
                <div id="rating" class="span-17">
                    <img class="middle" src="./images/down.png" /><span class="down">Thumbs Down</span>
                    <img class="middle" src="./images/up.png" /><span class="up">Thumbs Up</span>
                </div>
                
                <div id="video-wrapper" style="width:560px;float:left;">
                <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.3/jquery.min.js"></script> 

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script> 
 
<script type="text/javascript">

var ytplayer;
function onytplayerStateChange(newState) {
    console.log(newState);
if (newState == 2 || newState == 0) {
    alert('txting');
  $.ajax({
  url: 'update-pl.php'
});
}
} 
function onYouTubePlayerReady(playerId) {
    ytplayer = document.getElementById(playerId);
  
    ytplayer.addEventListener('onStateChange', 'onytplayerStateChange');
}

$(document).ready( function(){
 $("#next-image-container").load("queue.php");

 $("#rating").load("bbvote.php");
   var refreshId = setInterval(function() {

     $("#next-image-container").load("queue.php");

     $("#rating").load("bbvote.php");
   }, 2000);
   $.ajaxSetup({ cache: false });

var params = {
    allowScriptAccess: "always"
};
 
var atts = {
    id: "ytplayer1"
};
 
swfobject.embedSWF("http://www.youtube.com/p/655D5AA631EBF3B7?version=3&playerapiid=ytplayer1&autohide=1&autoplay=1&enablejsapi=1&iv_load_policy=3", "video-wrapper", "640", "415", "9", null, {}, params, atts);

});

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