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
    foreach ($playlistVideoFeed as $entry) {
if ($x == 0) {
	continue;
	$x = 1;
}
$videoEntry = $yt->getVideoEntry($entry->getVideoId());
  $videoThumbnails = $videoEntry->getVideoThumbnails();

$thumb = $videoThumbnails[0];
echo'<img class="middle tl tr bl br" src="'.$thumb['url'].'">';

}

?>