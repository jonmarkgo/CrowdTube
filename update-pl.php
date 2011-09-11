        <?php
$link = mysql_connect('localhost', 'jongottc_jontv', 'ZV.28q%fGFAV');
mysql_select_db('jongottc_jontv');

$q = mysql_query("SELECT * from queue WHERE played = 0 order by id ASC LIMIT 1");
if (mysql_num_rows($q) > 0) {
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
$client->account->sms_messages->create($from, $r['number'], 'Your video about "'.$r['request'].'" is playing live in Times Square! - CrowdTube Powered by Twilio');

mysql_query("UPDATE queue set played=1 WHERE id=".$r['id']);

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

  $yt->setMajorProtocolVersion(2);

  $playlistListFeed = $yt->getPlaylistListFeed('jonmarkgo');
$playlistListEntry = $playlistListFeed[0]; //CrowdTube
$playlistVideoFeed =
    $yt->getPlaylistVideoFeed($playlistListEntry->getPlaylistVideoFeedUrl());
    $x = 0;
    $playlistVideoFeed[0]->delete();

           ?>