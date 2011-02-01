<?php
if (!function_exists('curl_init')) {
  throw new Exception('fLOSt Theme needs the CURL PHP extension for OpenSocial functionality.');
}
if (!function_exists('json_decode')) {
  throw new Exception('fLOSt Theme needs the JSON PHP extension for OpenSocial functionality.');
}
  /**
   * Makes an HTTP request. This method can be overriden by subclasses if
   * developers want to do fancier things or use something other than curl to
   * make the request.
   *
   * @param String $url the URL to make the request to
   * @param Array $params the parameters to use for the POST body
   * @param CurlHandler $ch optional initialized curl handle
   * @return String the response text
   */
function makeOpenSocialRequest($url)
{
$timeout=5;
$max_retries=5;
$useragent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; de; rv:1.8.1.11) Gecko/20071127 Firefox/2.0.0.11";
$curl=curl_init();
curl_setopt ( $curl, CURLOPT_URL,$url);
curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt ( $curl, CURLOPT_CONNECTTIMEOUT, $timeout );
curl_setopt ( $curl, CURLOPT_USERAGENT, $useragent );
$retry=0;
$data="";
while($data=="" AND $retry < $max_retries)
{
$data=curl_exec($curl);
$retry++;
}
curl_close($curl);
 
// response will be in json format, decode it and return
return json_decode($data);
}

/***********************************************************************
*  CHECK SESSION (FLATNUX / FACEBOOK / GOOGLE FRIEND CONNECT / OPENID) *
***********************************************************************/ 
set_include_path(get_include_path() . PATH_SEPARATOR . 'themes/glorioso/include/');
require_once("social_registration_functions.php");
/**********************************************************************
 * Create single providers and sessions according to Theme Settings   *
 * *******************************************************************/ 
if ($_THEME_CFG['use_fb']==1){
  if( !isset( $_SESSION ) ) { session_start(); }
  if( isset( $_SESSION['REMOTE_ADDR'] ) && $_SESSION['REMOTE_ADDR'] != $_SERVER['REMOTE_ADDR'] ) 
  { session_regenerate_id(); $_SESSION['REMOTE_ADDR'] = $_SERVER['REMOTE_ADDR']; }
  if( !isset( $_SESSION['REMOTE_ADDR'] ) ) { $_SESSION['REMOTE_ADDR'] = $_SERVER['REMOTE_ADDR']; }
  define('FACEBOOK_APP_ID', $_THEME_CFG['fb_app_id']);
  define('FACEBOOK_SECRET', $_THEME_CFG['fb_secret']);
  $_SESSION['FB'] = Array();
  $_FB = &$_SESSION['FB'];
  $_FB['provider'] = new Facebook(array(
    'appId'  => FACEBOOK_APP_ID,
    'secret' => FACEBOOK_SECRET,
    'cookie' => true,
  ));
  $facebook = $_FB['provider'];
  // Check for Facebook Session: create our Application instance.
  // We may or may not have this data based on a $_GET or $_COOKIE based session.
  //
  // If we get a session here, it means we found a correctly signed session using
  // the Application Secret only Facebook and the Application know. We dont know
  // if it is still valid until we make an API call using the session. A session
  // can become invalid if it has already expired (should not be getting the
  // session back in this case) or if the user logged out of Facebook.
  $_FB['session'] = $facebook->getSession();
  $_FB['me'] = null;
  // Session based API call.
  if ($_FB['session']) {
    try {
      $_FB['uid'] = $facebook->getUser();
      $_FB['me'] = $facebook->api('/me');
    } catch (FacebookApiException $e) {
      error_log($e);
    }
    define('FACEBOOK_ACCESS_TOKEN', $_FB['session']['access_token']);
  }
  // IF USER REVOKES FACEBOOK CONNECT HE WILL BE REDIRECTED TO THE SITE
  // WITH THESE PARAMETERS
  if(isset($_GET['fb_auth_rev'])&&$_GET['fb_auth_rev']==1){
  	// Chiediamo all'utente se vuole cancellare anche 
    // l'account dal sito, oppure se vuole solo dissociare
    // l'account dal provider sociale
    echo "<script type=\"text/javascript\">opensocialregistration('{stato:\"revoke\",container:\"Facebook\"}');</script>";
  }
  if ($_FB['me']){
    $answer = chk_profile_flds("facebook");
    //$fbme = "Contents of FB_ME: ";
    //foreach($_FB['me'] as $key => $value){
    //  $fbme .= "{$key} => {$value}, ";
    //}
    // GET MORE USER INFO
     try{
          $ch = curl_init();
          $data = array('uids' => $_FB['uid'], 'fields' => 'username,profile_url,pic_square,pic_big' , 'access_token' => $_FB['session']['access_token'], 'format' => 'json');
          curl_setopt($ch, CURLOPT_URL, 'https://api.facebook.com/method/users.getInfo');
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          $_FB['userInfo'] = curl_exec($ch);
          curl_close($ch);
          $_FB['userInfo'] = json_decode($_FB['userInfo']);
          /*
          $ch = curl_init();
          $data = array('access_token' => $_FB['session']['access_token'], 'format' => 'json');
          curl_setopt($ch, CURLOPT_URL, 'https://api.facebook.com/method/friends.getAppUsers');
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          $response2 = curl_exec($ch);
          curl_close($ch);
          $appfriends = explode(",",preg_replace("(^\[|\]$)","", $response2) );
          $listfriends = preg_replace("(^\[|\]$)","", $response2);
          */
      } 
      catch(Exception $o){
          print_r($o);
      }
    if(isset($_GET['spec']) && $_GET['spec'] == 'deleteaccount' ){
      $result = deleteuseraccount("fb ",$_FB['uid']);
      if($result=="deleted"){ ?>
        <script type="text/javascript">opensocialregistration('{stato:"deleted",container:"Facebook"}');</script>
      <?php
      }
    }
    if(isset($_GET['spec']) && $_GET['spec'] == 'existandsameusername'){
      $result = registersocialuser("fb",$_GET['spec'],$_FB['uid'],$_FB['me'],$_FB['userInfo'][0]->username);
      if($result=="updated"){ 
        fn_login($_FB['userInfo'][0]->username); ?>
        <script type="text/javascript">opensocialregistration('{stato:"collegato",container:"Facebook"}');</script>
      <?php
      }
    }
    if(isset($_GET['spec']) && $_GET['spec'] == 'usernamealreadyexists' ){
      $result = registersocialuser("fb",$_POST['alreadyusername'],$_FB['uid'],$_FB['me'],$_POST['username']);
      if($_POST['alreadyusername']=="associatewithold"&&$result=="updated"){ 
        fn_login($_POST['username']); ?>
        <script type="text/javascript">opensocialregistration('{stato:"linkedtoold",container:"Facebook"}');</script>
      <?php
      }
      elseif($_POST['alreadyusername']=="alternativeusername"&&$result=="created"){ 
        fn_login($_POST['username']); ?>
        <script type="text/javascript">opensocialregistration('{stato:"altuser",container:"Facebook"}');</script>
      <?php
      }
    }
    if(isset($_GET['spec']) && $_GET['spec'] == 'linkoldaccount' ){
      if($_POST['choiceusername']=='preferfb'){
        $currentusername = $_FB['userInfo'][0]->username;
      }
      elseif($_POST['choiceusername']=='preferold'){
        $currentusername = $_POST['username'];
      }
      $currentpasswd = $_POST['password'];
      $result = registersocialuser("fb",$_GET['spec'],$_FB['uid'],$_FB['me'],$currentusername,$currentpasswd);
      if($result=="updated"){
        fn_login($currentusername);  ?>
        <script type="text/javascript">opensocialregistration('{stato:"linkedtoold",container:"Facebook"}');</script>
      <?php
      }
    }
    // If no specific action has yet been taken, we don't have any GET parameters...
    if(!isset($_GET['spec'])){  
      // Check if user with this social uid exists
      $result = checkuserexists('fb',$_FB['uid']); 
      // If doesn't exist then this is first time registration as social user
      if(!$result){
        $result = checkusernameexists($_FB['userInfo'][0]->username);
        if(!$result||$result===false) {   // IF USERNAME IS NOT YET TAKEN
          $result = registersocialuser("fb","notyettaken",$_FB['uid'],$_FB['me'],$_FB['userInfo'][0]->username);
          if ($result = "created"){
            fn_login($_FB['userInfo'][0]->username);  ?>
            <script type="text/javascript">opensocialregistration('{container:"Facebook"}');</script>
          <?php
          }
        }
        else{ 
          echo "<script type=\"text/javascript\">opensocialregistration('{stato:\"esistente\",username:\"{$_FB['userInfo'][0]->username}\",container:\"Facebook\"}');</script>";
        }
      } // End first time registration as social user
      // If does exist then user is already registered as social user,
      // login to site if necessary using social uid (not username! site username could vary from social username)
      else{    
        if(!$_FN['user']){       
          $socialusername = getusernamefromsocialuid("fb",$_FB['uid']);
          if($socialusername!=''){ 
            fn_login($socialusername);
          }      
        }
      }     
    } // END IF NOT SET GET "SPEC" (which means some sort of specific action)
  } // END IF FB ME (session)
}
if ($_THEME_CFG['use_gfc']==1){
  if( !isset( $_SESSION ) ) { session_start(); }
  if( isset( $_SESSION['REMOTE_ADDR'] ) && $_SESSION['REMOTE_ADDR'] != $_SERVER['REMOTE_ADDR'] ) 
  { session_regenerate_id(); $_SESSION['REMOTE_ADDR'] = $_SERVER['REMOTE_ADDR']; }
  if( !isset( $_SESSION['REMOTE_ADDR'] ) ) { $_SESSION['REMOTE_ADDR'] = $_SERVER['REMOTE_ADDR']; }
  define('GFC_SITE_ID', $_THEME_CFG['gfc_site']);
  $_SESSION['GFC'] = Array();
  $_GFC = &$_SESSION['GFC'];
  $_GFC['provider'] = new osapiFriendConnectProvider();
  $_GFC['session'] = getSocialSession("gfc",$_THEME_CFG['gfc_site']);
  define('GFC_ACCESS_TOKEN', $_GFC['session']['access_token']);
  if ($_GFC['session']){
    $answer = chk_profile_flds("gfc"); // jsalert($answer);
    $_GFC['userInfo'] =  makeOpenSocialRequest("http://www.google.com/friendconnect/api/people/@me/@self?fcauth=".GFC_ACCESS_TOKEN);
    $_GFC['supportedfields'] =  makeOpenSocialRequest("http://www.google.com/friendconnect/api/people/@supportedFields?fcauth=".GFC_ACCESS_TOKEN);
    $_GFC['connections'] =  makeOpenSocialRequest("http://www.google.com/friendconnect/api/people/@me/@all?fcauth=".GFC_ACCESS_TOKEN);
    $_GFC['friends'] =  makeOpenSocialRequest("http://www.google.com/friendconnect/api/people/@me/@friends?fcauth=".GFC_ACCESS_TOKEN);
    $_GFC['uid'] = $_GFC['userInfo']->entry->id;
    $_GFC['username'] = $_GFC['userInfo']->entry->displayName;
    $_GFC['auth'] = new osapiFCAuth(GFC_ACCESS_TOKEN);
    // Create object instance
    $gfc = new osapi($_GFC['provider'], $_GFC['auth']);
    $_GFC['me'] = $gfc->people->get(array('userId'=>'@me', 'groupId'=>'@friends', 'fields'=>'@all'));
    if(isset($_GET['spec']) && $_GET['spec'] == 'deleteaccount' ){
      $result = deleteuseraccount("gfc ",$_GFC['uid']);
      if($result=="deleted"){
        echo "<script type=\"text/javascript\">opensocialregistration('{stato:\"deleted\",container:\"Google Friend Connect\"}');</script>";
      }
    }
    if(isset($_GET['spec']) && $_GET['spec'] == 'existandsameusername'){
      $result = registersocialuser("gfc",$_GET['spec'],$_GFC['uid'],$_GFC['userInfo']->entry,$_GFC['username']);
      if($result=="updated"){ 
        fn_login($_GFC['username']);
        echo "<script type=\"text/javascript\">opensocialregistration('{stato:\"collegato\",container:\"Google Friend Connect\"}');</script>";
      }
    }
    if(isset($_GET['spec']) && $_GET['spec'] == 'usernamealreadyexists' ){
      $result = registersocialuser("gfc",$_POST['alreadyusername'],$_GFC['uid'],$_GFC['userInfo']->entry,$_POST['username']);
      if($_POST['alreadyusername']=="associatewithold"&&$result=="updated"){ 
        fn_login($_POST['username']);
        echo "<script type=\"text/javascript\">opensocialregistration('{stato:\"linkedtoold\",container:\"Google Friend Connect\"}');</script>";
      }
      elseif($_POST['alreadyusername']=="alternativeusername"&&$result=="created"){ 
        fn_login($_POST['username']);
        echo "<script type=\"text/javascript\">opensocialregistration('{stato:\"altuser\",container:\"Google Friend Connect\"}');</script>";
      }
    }
    if(isset($_GET['spec']) && $_GET['spec'] == 'linkoldaccount' ){
      if($_POST['choiceusername']=='preferfb'){
        $currentusername = $_GFC['username'];
      }
      elseif($_POST['choiceusername']=='preferold'){
        $currentusername = $_POST['username'];
      }
      $currentpasswd = $_POST['password'];
      $result = registersocialuser("gfc",$_GET['spec'],$_GFC['uid'],$_GFC['userInfo']->entry,$currentusername,$currentpasswd);
      if($result=="updated"){
        fn_login($currentusername);
        echo "<script type=\"text/javascript\">opensocialregistration('{stato:\"linkedtoold\",container:\"Google Friend Connect\"}');</script>";
      }
    }
    // If no specific action has yet been taken, we don't have any GET parameters...
    if(!isset($_GET['spec'])){  
      // Check if user with this social uid exists
      $result = checkuserexists('gfc',$_GFC['uid']); 
      // If doesn't exist then this is first time registration as social user
      if(!$result){
        $result = checkusernameexists($_GFC['username']);
        if(!$result||$result===false) {   // IF USERNAME IS NOT YET TAKEN
          $result = registersocialuser("gfc","notyettaken",$_GFC['uid'],$_GFC['userInfo']->entry,$_GFC['username']);
          if ($result = "created"){
            fn_login($_GFC['username']);
            echo "<script type=\"text/javascript\">opensocialregistration('{container:\"Google Friend Connect\"}');</script>";
          }
        }
        else{ 
          echo "<script type=\"text/javascript\">opensocialregistration('{stato:\"esistente\",username:\"{$_FB['userInfo'][0]->username}\",container:\"Google Friend Connect\"}');</script>";
        }
      } // End first time registration as social user
      // If does exist then user is already registered as social user,
      // login to site if necessary using social uid (not username! site username could vary from social username)
      else{    
        if(!$_FN['user']){       
          $socialusername = getusernamefromsocialuid("gfc",$_GFC['uid']);
          if($socialusername!=''){ 
            fn_login($socialusername);
          }      
        }
      }     
    } // END IF NOT SET GET "SPEC" (which means some sort of specific action)
  } // END IF WE HAVE A GOOGLE FRIEND ACCOUNT SESSION
}
if($_THEME_CFG['use_messlive']==1){
  // Get the session running
  if( !isset( $_SESSION ) ) { session_start(); }
  if( isset( $_SESSION['REMOTE_ADDR'] ) && $_SESSION['REMOTE_ADDR'] != $_SERVER['REMOTE_ADDR'] ) 
  { session_regenerate_id(); $_SESSION['REMOTE_ADDR'] = $_SERVER['REMOTE_ADDR']; }
  if( !isset( $_SESSION['REMOTE_ADDR'] ) ) { $_SESSION['REMOTE_ADDR'] = $_SERVER['REMOTE_ADDR']; }
  
  // Application Specific Globals
  define('WRAP_CLIENT_ID', '$_THEME_CFG["messlive_appid"]');
  define('WRAP_CLIENT_SECRET','$_THEME_CFG["messlive_secret"]');
  define('WRAP_CALLBACK', 'http://' . $_SERVER['HTTP_HOST'] . '/themes/include/messengerlive_connect/OAuthWrapCallback.php');
  define('WRAP_CHANNEL_URL', 'http:// ' . $_SERVER['HTTP_HOST'] . '/themes/include/messengerlive_connect/channel.htm');
  
  // Live URLs required for making requests.
  define('WRAP_CONSENT_URL', 'https://consent.live.com/Connect.aspx');
  define('WRAP_ACCESS_URL', 'https://consent.live.com/AccessToken.aspx');
  define('WRAP_REFRESH_URL', 'https://consent.live.com/RefreshToken.aspx');
  
  require_once('OAuthWrapHandler.php');
  $_SESSION['MESSLIVE'] = Array();
  $_MESSLIVE = &$_SESSION['MESSLIVE'];
  $_MESSLIVE['provider'] = new OAuthWrapHandler();
  $_MESSLIVE['provider']->processRequest();


}
/*********************************************************************/
/* Unfortunately none of the following are yet at all simple to use  */
/* I found it too complicated to try to implement any of them yet... */
/* I've begun paving the way but it is too difficult for now...      */
/*********************************************************************/
/*
if ($_THEME_CFG['use_google']==1){
  define('GOOGLE_KEY', $_THEME_CFG['google_key']);
  define('GOOGLE_SECRET', $_THEME_CFG['google_secret']);
  $_GOOGLE = Array();
  $_GOOGLE['provider'] = new osapiGoogleProvider();
  $_GOOGLE['auth'] = new osapiOAuth2Legged(GOOGLE_KEY, GOOGLE_SECRET); // if on behalf of a user, add ", $myspace_userid"
  $google = new osapi($_GOOGLE['provider'], $_GOOGLE['auth']);
  $_GOOGLE['me'] = $google->people->get(array('userId'=>'@me', 'groupId'=>'@self'));
  if ($_GOOGLE['me']){
    $answer = chk_profile_flds("google"); // jsalert($answer);
    if(isset($_GET['spec']) && $_GET['spec'] == 'deleteaccountgoogle' ){
      deleteuseraccount("Google");
    }
    if(!isset($_GET['spec'])){
      $result = checkuserexists('google',$_GOOGLE['me']['userId']);
    }
  }
}
if ($_THEME_CFG['use_hi5']==1){
  define('HI5_KEY', $_THEME_CFG['hi5_key']);
  define('HI5_SECRET', $_THEME_CFG['hi5_secret']);
  $_HI5 = Array();
  $_HI5['provider'] = new osapiHi5Provider();
  $_HI5['auth'] = new osapiOAuth2Legged(HI5_KEY, HI5_SECRET); // if on behalf of a user, add ", $myspace_userid"
  $hi5 = new osapi($_HI5['provider'], $_HI5['auth']);
  $_HI5['me'] = $hi5->people->get(array('userId'=>'@me', 'groupId'=>'@self'));
  if ($_HI5['me']){
    $answer = chk_profile_flds("hi5"); // jsalert($answer);
    if(isset($_GET['spec']) && $_GET['spec'] == 'deleteaccounthi5' ){
      deleteuseraccount("Hi5");
    }
    if(!isset($_GET['spec'])){
      $result = checkuserexists('hi5',$_HI5['me']['userId']);
    }
  }
}
if ($_THEME_CFG['use_myspace']==1){
  define('MYSPACE_KEY', $_THEME_CFG['myspace_key']);
  define('MYSPACE_SECRET', $_THEME_CFG['myspace_secret']);
  $_MYSPACE = Array();
  $_MYSPACE['provider'] = new osapiMySpaceProvider();
  $_MYSPACE['auth'] = new osapiOAuth2Legged(MYSPACE_KEY, MYSPACE_SECRET); // if on behalf of a user, add ", $myspace_userid"
  $myspace = new osapi($_MYSPACE['provider'], $_MYSPACE['auth']);
  $_MYSPACE['me'] = $myspace->people->get(array('userId'=>'@me', 'groupId'=>'@self'));
  if ($_MYSPACE['me']){
    $answer = chk_profile_flds("myspace"); // jsalert($answer);
    if(isset($_GET['spec']) && $_GET['spec'] == 'deleteaccountmyspace' ){
      deleteuseraccount("MySpace");
    }
    if(!isset($_GET['spec'])){
      $result = checkuserexists('myspace',$_MYSPACE['me']['userId']);
    }
  }
}
if ($_THEME_CFG['use_netlog']==1){
  define('NETLOG_KEY', $_THEME_CFG['netlog_key']);
  define('NETLOG_SECRET', $_THEME_CFG['netlog_secret']);
  $_NETLOG = Array();
  $_NETLOG['provider'] = new osapiNetlogProvider();
  $_NETLOG['auth'] = new osapiOAuth2Legged(NETLOG_KEY, NETLOG_SECRET); // if on behalf of a user, add ", $orkut_userid"
  $netlog = new osapi($_NETLOG['provider'], $_NETLOG['auth']);
  $_NETLOG['me'] = $netlog->people->get(array('userId'=>'@me', 'groupId'=>'@self'));
  if ($_NETLOG['me']){
    $answer = chk_profile_flds("netlog"); // jsalert($answer);
    if(isset($_GET['spec']) && $_GET['spec'] == 'deleteaccountnetlog' ){
      deleteuseraccount("Netlog");
    }
    if(!isset($_GET['spec'])){
      $result = checkuserexists('netlog',$_NETLOG['me']['userId']);
    }
  }
}
if ($_THEME_CFG['use_orkut']==1){
  define('ORKUT_KEY', $_THEME_CFG['orkut_key']);
  define('ORKUT_SECRET', $_THEME_CFG['orkut_secret']);
  $_ORKUT = Array();
  $_ORKUT['provider'] = new osapiOrkutProvider();
  $_ORKUT['auth'] = new osapiOAuth2Legged(ORKUT_KEY, ORKUT_SECRET); // if on behalf of a user, add ", $orkut_userid"
  $orkut = new osapi($_ORKUT['provider'], $_ORKUT['auth']);
  $_ORKUT['me'] = $orkut->people->get(array('userId'=>'@me', 'groupId'=>'@self'));
  if ($_ORKUT['me']){
    $answer = chk_profile_flds("orkut"); // jsalert($answer);
    if(isset($_GET['spec']) && $_GET['spec'] == 'deleteaccountorkut' ){
      deleteuseraccount("Orkut");
    }
    if(!isset($_GET['spec'])){
      $result = checkuserexists('orkut',$_ORKUT['me']['userId']);
    }
  }
}
if ($_THEME_CFG['use_partuza']==1){
  define('PARTUZA_KEY', $_THEME_CFG['partuza_key']);
  define('PARTUZA_SECRET', $_THEME_CFG['partuza_secret']);
  $_PARTUZA = Array();
  $_PARTUZA['provider'] = new osapiPartuzaProvider();
  $_PARTUZA['auth'] = new osapiOAuth2Legged(PARTUZA_KEY, PARTUZA_SECRET); // if on behalf of a user, add ", $orkut_userid"
  $partuza = new osapi($_PARTUZA['provider'], $_PARTUZA['auth']);
  $_PARTUZA['me'] = $partuza->people->get(array('userId'=>'@me', 'groupId'=>'@self'));
  if ($_PARTUZA['me']){
    $answer = chk_profile_flds("partuza"); // jsalert($answer);
    if(isset($_GET['spec']) && $_GET['spec'] == 'deleteaccountpartuza' ){
      deleteuseraccount("Partuza");
    }
    if(!isset($_GET['spec'])){
      $result = checkuserexists('partuza',$_PARTUZA['me']['userId']);
    }
  }
}
if ($_THEME_CFG['use_plaxo']==1){
  define('PLAXO_KEY', $_THEME_CFG['plaxo_key']);
  define('PLAXO_SECRET', $_THEME_CFG['plaxo_secret']);
  $_PLAXO = Array();
  $_PLAXO['provider'] = new osapiPlaxoProvider();
  $_PLAXO['auth'] = new osapiOAuth2Legged(PLAXO_KEY, PLAXO_SECRET); // if on behalf of a user, add ", $orkut_userid"
  $plaxo = new osapi($_PLAXO['provider'], $_PLAXO['auth']);
  $_PLAXO['me'] = $plaxo->people->get(array('userId'=>'@me', 'groupId'=>'@self'));
  if ($_PLAXO['me']){
    $answer = chk_profile_flds("plaxo"); // jsalert($answer);
    if(isset($_GET['spec']) && $_GET['spec'] == 'deleteaccountplaxo' ){
      deleteuseraccount("Plaxo");
    }
    if(!isset($_GET['spec'])){
      $result = checkuserexists('plaxo',$_PLAXO['me']['userId']);
    }
  }
}
*/
?>