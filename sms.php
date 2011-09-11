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
  $query = $yt->newVideoQuery();
  $query->setOrderBy('viewCount');
  $query->setSafeSearch('none');
  $query->setVideoQuery($searchTerms);

  // Note that we need to pass the version number to the query URL function
  // to ensure backward compatibility with version 1 of the API.
  $videoFeed = $yt->getVideoFeed($query->getQueryUrl(2));
  $vid = $videoFeed[0];
  $vidid = $vid->getVideoId();

mysql_query("INSERT into queue VALUES (NULL,'".$_POST['From']."','".$_POST['Body']."',NULL,0,'".$vidid."','".$_POST['FromState']."')");
$id = mysql_insert_id();

  $playlistListFeed = $yt->getPlaylistListFeed('jonmarkgo');
$playlistToAddTo = $playlistListFeed[0]; //CrowdTube
$postUrl = $playlistToAddTo->getPlaylistVideoFeedUrl();
// video entry to be added
$videoEntryToAdd = $vid;

// create a new Zend_Gdata_PlaylistListEntry, passing in the underling DOMElement of the VideoEntry
$newPlaylistListEntry = $yt->newPlaylistListEntry($videoEntryToAdd->getDOM());

  $yt->insertEntry($newPlaylistListEntry, $postUrl);

$msg = "Hi you are in line #".$id;
}
?>
<Response>
<Sms><?php echo $msg; ?></Sms>
</Response>