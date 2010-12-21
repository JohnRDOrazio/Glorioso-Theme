<?php
/**************************************************************
 * FUNZIONI PER LA REGISTRAZIONE DI UTENTI CON SOCIAL NETWORK *
 * SU SITO FLATNUX                                            *
 * Created 03/nov/2010                                        *
 * @package Glorioso Theme for Flatnux                        *
 * @author John R. D'Orazio <donjohn.fmmi@gmail.com>          *
 * @copyright Copyright © 2010-2012                           *
 * @license http://opensource.org/licenses/gpl-license.php GNU General Public License
 ************************************************************/   
set_include_path(get_include_path() . PATH_SEPARATOR . 'themes/glorioso/include/');
require_once("facebook_connect/facebook.php");
require_once("opensocial-php-client/osapi/osapi.php");	
//$storage = new osapiFileStorage('/'.$_FN['datadir'].'/osapi');
// Function that Checks for Social Provider Session
// (Basically only for Google Friend Connect)
function getSocialSession($provider,$site_id){
  $social_session = null;
  switch($provider){
    case "gfc":
      if(isset($_COOKIE['fcauth'.$site_id] ) ) {
        $social_session = array();
        $social_session['access_token'] = trim(
                  get_magic_quotes_gpc()
                    ? stripslashes($_COOKIE['fcauth'.$site_id])
                    : $_COOKIE['fcauth'.$site_id] );
      }
      break;
    default:
      $social_session = null;
    }
  return $social_session;
}
/******************************************************************* 
 * Function that checks if profile fields for given provider       *
 * exist and if not adds them to the users table in the fndatabase *
 * John R. D'Orazio                                                *  
 ******************************************************************/
function chk_profile_flds($provider){
  global $_FN;
  include_once("include/xmldb.php");
  $answer = false;
  /*
   * POSSIBLE USAGE WITH NEW XMLDB CLASS, WHEN IT WILL BE COMPLETE
   * $query = "DESCRIBE users";
   * $result = $db->Query($query);
   * echo "<pre>";
   * print_r($result);
   * echo "</pre>";
   */
  switch($provider) {
    case "facebook":   
      $result = getxmltablefield("fndatabase", "users", "fbuid", $_FN['datadir']);
      if(!$result||$result==""){
        $field = array();
        $field['name'] = "fbuid";
        $field['type'] = "varchar";
        $field['frm_it'] = "Identità Utente Facebook";
        $field['frm_en'] = "Facebook User ID";
        $field['frm_es'] = "Identitad del Usuario Facebook";
        $field['frm_de'] = "Facebook Benutzeridentität";
        $field['frm_fr'] = "Identité de l&#39;Utilisateur Facebook";
        $field['showinprofile'] = "1";
        $field['frm_required'] = "0";
        $field['frm_show'] = "0";
        $answer = (addxmltablefield("fndatabase","users",$field,$_FN['datadir']) ) ?  "Fields created." : "Error creating fields.";        
      }
      $result = getxmltablefield("fndatabase", "users", "birthday", $_FN['datadir']);
      if(!$result||$result==""){
        $field = array();
        $field['name'] = "birthday";
        $field['type'] = "date";
        $field['frm_it'] = "Compleanno";
        $field['frm_en'] = "Birthday";
        $field['frm_es'] = "Cumpleaños";
        $field['frm_de'] = "Geburtstag";
        $field['frm_fr'] = "Anniversaire";
        $field['showinprofile'] = "1";
        $field['frm_required'] = "0";
        $field['frm_show'] = "0";
        $answer = (addxmltablefield("fndatabase","users",$field,$_FN['datadir']) ) ?  "Fields created." : "Error creating fields.";
      }
      $answer = ($answer===false) ? "Fields already existed." : $answer;  
      break;
    case "gfc":
      $result = getxmltablefield("fndatabase", "users", "gfcuid", $_FN['datadir']);
      if(!$result||$result==""){
        $field = array();
        $field['name'] = "gfcuid";
        $field['type'] = "varchar";
        $field['frm_it'] = "Identità Utente Google Friend Connect";
        $field['frm_en'] = "Google Friend Connect User ID";
        $field['frm_es'] = "Identitad del Usuario Google Friend Connect";
        $field['frm_de'] = "Google Friend Connect Benutzeridentität";
        $field['frm_fr'] = "Identité de l&#39;Utilisateur Google Friend Connect";
        $field['showinprofile'] = "1";
        $field['frm_required'] = "0";
        $field['frm_show'] = "0";
        $answer = (addxmltablefield("fndatabase","users",$field,$_FN['datadir']) ) ?  "Fields created." : "Error creating fields.";
      }
      $answer = ($answer===false) ? "Fields already existed." : $answer;
      break;
    case "google":   
      $result = getxmltablefield("fndatabase", "users", "googleuid", $_FN['datadir']);
      if(!$result||$result==""){
        $field = array();
        $field['name'] = "googleuid";
        $field['type'] = "varchar";
        $field['frm_it'] = "Identità Utente iGoogle";
        $field['frm_en'] = "iGoogle User ID";
        $field['frm_es'] = "Identitad del Usuario iGoogle";
        $field['frm_de'] = "iGoogle Benutzeridentität";
        $field['frm_fr'] = "Identité de l&#39;Utilisateur iGoogle";
        $field['showinprofile'] = "1";
        $field['frm_required'] = "0";
        $field['frm_show'] = "0";
        $answer = (addxmltablefield("fndatabase","users",$field,$_FN['datadir']) ) ?  "Fields created." : "Error creating fields.";        
      }
      $answer = ($answer===false) ? "Fields already existed." : $answer;
    case "hi5":   
      $result = getxmltablefield("fndatabase", "users", "hi5uid", $_FN['datadir']);
      if(!$result||$result==""){
        $field = array();
        $field['name'] = "hi5uid";
        $field['type'] = "varchar";
        $field['frm_it'] = "Identità Utente Hi5";
        $field['frm_en'] = "Hi5 User ID";
        $field['frm_es'] = "Identitad del Usuario Hi5";
        $field['frm_de'] = "Hi5 Benutzeridentität";
        $field['frm_fr'] = "Identité de l&#39;Utilisateur Hi5";
        $field['showinprofile'] = "1";
        $field['frm_required'] = "0";
        $field['frm_show'] = "0";
        $answer = (addxmltablefield("fndatabase","users",$field,$_FN['datadir']) ) ?  "Fields created." : "Error creating fields.";        
      }
      $answer = ($answer===false) ? "Fields already existed." : $answer;
    case "myspace":   
      $result = getxmltablefield("fndatabase", "users", "myspaceuid", $_FN['datadir']);
      if(!$result||$result==""){
        $field = array();
        $field['name'] = "myspaceuid";
        $field['type'] = "varchar";
        $field['frm_it'] = "Identità Utente MySpace";
        $field['frm_en'] = "MySpace User ID";
        $field['frm_es'] = "Identitad del Usuario MySpace";
        $field['frm_de'] = "MySpace Benutzeridentität";
        $field['frm_fr'] = "Identité de l&#39;Utilisateur MySpace";
        $field['showinprofile'] = "1";
        $field['frm_required'] = "0";
        $field['frm_show'] = "0";
        $answer = (addxmltablefield("fndatabase","users",$field,$_FN['datadir']) ) ?  "Fields created." : "Error creating fields.";        
      }
      $answer = ($answer===false) ? "Fields already existed." : $answer;
    case "netlog":   
      $result = getxmltablefield("fndatabase", "users", "netloguid", $_FN['datadir']);
      if(!$result||$result==""){
        $field = array();
        $field['name'] = "netloguid";
        $field['type'] = "varchar";
        $field['frm_it'] = "Identità Utente Netlog";
        $field['frm_en'] = "Netlog User ID";
        $field['frm_es'] = "Identitad del Usuario Netlog";
        $field['frm_de'] = "Netlog Benutzeridentität";
        $field['frm_fr'] = "Identité de l&#39;Utilisateur Netlog";
        $field['showinprofile'] = "1";
        $field['frm_required'] = "0";
        $field['frm_show'] = "0";
        $answer = (addxmltablefield("fndatabase","users",$field,$_FN['datadir']) ) ?  "Fields created." : "Error creating fields.";        
      }
      $answer = ($answer===false) ? "Fields already existed." : $answer;
    case "plaxo":   
      $result = getxmltablefield("fndatabase", "users", "plaxouid", $_FN['datadir']);
      if(!$result||$result==""){
        $field = array();
        $field['name'] = "plaxouid";
        $field['type'] = "varchar";
        $field['frm_it'] = "Identità Utente Plaxo";
        $field['frm_en'] = "Plaxo User ID";
        $field['frm_es'] = "Identitad del Usuario Plaxo";
        $field['frm_de'] = "Plaxo Benutzeridentität";
        $field['frm_fr'] = "Identité de l&#39;Utilisateur Plaxo";
        $field['showinprofile'] = "1";
        $field['frm_required'] = "0";
        $field['frm_show'] = "0";
        $answer = (addxmltablefield("fndatabase","users",$field,$_FN['datadir']) ) ?  "Fields created." : "Error creating fields.";        
      }
      $answer = ($answer===false) ? "Fields already existed." : $answer;
    case "partuza":   
      $result = getxmltablefield("fndatabase", "users", "partuzauid", $_FN['datadir']);
      if(!$result||$result==""){
        $field = array();
        $field['name'] = "partuzauid";
        $field['type'] = "varchar";
        $field['frm_it'] = "Identità Utente Partuza";
        $field['frm_en'] = "Partuza User ID";
        $field['frm_es'] = "Identitad del Usuario Partuza";
        $field['frm_de'] = "Partuza Benutzeridentität";
        $field['frm_fr'] = "Identité de l&#39;Utilisateur Partuza";
        $field['showinprofile'] = "1";
        $field['frm_required'] = "0";
        $field['frm_show'] = "0";
        $answer = (addxmltablefield("fndatabase","users",$field,$_FN['datadir']) ) ?  "Fields created." : "Error creating fields.";        
      }
      $answer = ($answer===false) ? "Fields already existed." : $answer;
    case "orkut":   
      $result = getxmltablefield("fndatabase", "users", "orkutuid", $_FN['datadir']);
      if(!$result||$result==""){
        $field = array();
        $field['name'] = "orkutuid";
        $field['type'] = "varchar";
        $field['frm_it'] = "Identità Utente Orkut";
        $field['frm_en'] = "Orkut User ID";
        $field['frm_es'] = "Identitad del Usuario Orkut";
        $field['frm_de'] = "Orkut Benutzeridentität";
        $field['frm_fr'] = "Identité de l&#39;Utilisateur Orkut";
        $field['showinprofile'] = "1";
        $field['frm_required'] = "0";
        $field['frm_show'] = "0";
        $answer = (addxmltablefield("fndatabase","users",$field,$_FN['datadir']) ) ?  "Fields created." : "Error creating fields.";        
      }
      $answer = ($answer===false) ? "Fields already existed." : $answer;
    default:
      $answer = "Provider unknown, please use another.";  
  }
  return $answer;  
}
/** 
 * The letter l (lowercase L) and the number 1 
 * have been removed, as they can be mistaken 
 * for each other. 
 */ 
function createRndPass() { 
    $chars = "abcdefghijkmnopqrstuvwxyz023456789"; 
    srand((double)microtime()*1000000); 
    $i = 0; 
    $pass = '' ; 
    while ($i <= 7) { 
        $num = rand() % 33; 
        $tmp = substr($chars, $num, 1); 
        $pass = $pass . $tmp; 
        $i++; 
    } 
    return $pass; 
} 
// USER THAT REVOKED SOCIAL ACCOUNT CONNECT HAS ALSO DECIDED TO DELETE SITE USER ACCOUNT:
function deleteuseraccount($provider,$username){
  if($provider=="fb"){ $providername = "Facebook"; }
  elseif($provider=="gfc"){ $providername = "Google Friend"; }
  elseif($provider=="google"){ $providername = "iGoogle - Gmail"; }
  else { $providername = ucwords($provider); }
  require_once("include/xmldb.php");
  $db = new XMLDatabase("fndatabase","misc");
  $query = "SELECT email,name FROM users WHERE username = '{$username}'";
  $result = $db->Query($query);
  if(fn_delete_user($_POST['username'])){
    @ mail("{$result[0]['name']} <{$result[0]['email']}>","Eliminazione account {$_FN['sitename']}","Ciao {$result[0]['name']}, hai deciso di rinunciare a $providername Connect e di eliminare il tuo account su {$_FN['sitename']}. \nNon potrai più effettuare il login sul sito fino a nuova registrazione.\n Chiediamo scusa se c&apos;è stato qualche inconveniente o disservizio. \nSemmai puoi comunicarci eventuali disagi onde migliorare il nostro servizio.\n{$_FN['admin']}, Amministratore di {$_FN['sitename']}","From: {$_FN['sitename']} <{$_FN['site_email_address']}>\r\n" . "Reply-To: {$_FN['site_email_address']}\r\n" . "X-Mailer: PHP/" . phpversion());
    return "deleted";
  }
  return "notdeleted";
}
// CHECK IF USER ALREADY EXISTS IN FLATNUX DATABASE
function checkuserexists($provider,$uid){
  require_once("include/xmldb.php");
  $db = new XMLDatabase("fndatabase","misc");
  $query = "SELECT username FROM users WHERE {$provider}uid = '".$uid."'";
  $result = $db->Query($query);
  $result2 = $result[0]['username'];
  return $result2;
}
// USER DOES NOT EXIST IN FLATNUX DATABASE, BUT CHECK IF USERNAME EXISTS
function checkusernameexists($username){
  require_once("include/xmldb.php");
  $db = new XMLDatabase("fndatabase","misc");
  $query = "SELECT username FROM users WHERE username = '{$username}'";
  $result = $db->Query($query);
  $result2 = $result[0]['username'];
  if ($result2!=""){ return $result2; }
  return false;
}
/***********************************************************************************
* LA SEGUENTE FUNZIONE GESTISCE I VARI CASI DI REGISTRAZIONE AL SITO CON SOCIAL CONNECT*
* ALCUNI CASI POSSIBILI (TENENDO CONTO CHE IN FLATNUX                              *
*                        USERNAME E' CHIAVE PRIMARIA SUL FLATDATABASE):            *
* 1 - UTENTE HA GIA' UN ACCOUNT SUL SITO CON LO STESSO USERNAME CHE HA SUL SOCIAL NETWORK *
* 2 - UTENTE HA GIA' UN ACCOUNT SUL SITO MA CON USERNAME DIVERSO,                  *
*     POTRA' SCEGLIERE SE:                                                         *
*     a - PREFERIRE USERNAME DEL SOCIAL NETWORK                                    * 
*         AGGIORNANDO DI CONSEGUENZA IL PROPRIO ACCOUNT SUL SITO                   *
*     b - PREFERIRE USERNAME CHE GIA' AVEVA SUL SITO, POSSIBILE PERCHE'            *
*         SOCIAL LOGIN AVVIENE IN BASE A SOCIAL UID E NON USERNAME                 *
* 3 - UTENTE NON HA ANCORA UN ACCOUNT SUL SITO MA IL SUO USERNAME SOCIAL E' GIA'   *
*     PRESO SUL SITO DA UN ALTRO UTENTE, DOVRA' SCEGLIERE UN USERNAME ALTERNATIVO  *
*     (POSSIBILE PERCHE' SOCIAL LOGIN AVVIENE IN BASE A UID E NON USERNAME)        *
* 4 - UTENTE NON HA ANCORA UN ACCOUNT SUL SITO, VERRA' REGISTRATO AUTOMATICAMENTE  *
*     CON USERNAME DEL SOCIAL NETWORK E PASSWORD RANDOMIZZATO (INUTILE PER         *
*     SOCIAL CONNECT LOGIN MA UTILE NEL CASO VOLESSE ACCEDERE AL SITO SENZA        *
*     SOCIAL CONNECT (E ANCHE PER EVITARE ERRORI NEL SISTEMA DI REGISTRAZIONE      *
*     DI FLATNUX); PUO' SEMPRE CAMBIARE PASSWORD IN SEGUITO)                       *
***********************************************************************************/ 
function registersocialuser($provider,$whichcase,$username,$passwd,$uid,$profileinfo){
  global $_FN;
  require_once("include/xmldb.php");
  $newvalues = array();
  if($provider=="fb"){ 
    $providername = "Facebook";
   	$newvalues['birthday'] = $profileinfo['birthday'];
  	$newvalues['email'] = $profileinfo['email'];
  	$newvalues['name'] = $profileinfo['name'];
    }
  elseif($provider=="gfc"){ $providername = "Google Friend"; }
  elseif($provider=="google"){ $providername = "iGoogle - Gmail"; }
  else { $providername = ucwords($provider); }
  $provideruid = $provider."uid";
	$newvalues['rnd'] = rand();
	$newvalues['active'] = 1;
	$newvalues['ip'] = $_SERVER["REMOTE_ADDR"];
	$newvalues['group'] = "users";
	$newvalues['level'] = 0;
 	$newvalues['username'] = $username;
 	$newvalues[$provideruid] = $uid;
        $newvalues['passwd'] = ( ($passwd!="") ? $passwd : createRndPass() ); 
  switch($whichcase){
    case "notyettaken": // simplest, first registration
      $newvalues['passwd'] = createRndPass();	
      if(fn_add_user($username, $newvalues)){
        @ mail($profileinfo['name']." <".$profileinfo['email'].">","Benvenuto a {$_FN['sitename']}","Ciao {$profileinfo['name']} e benvenuto a {$_FN['sitename']}! Ti sei appena registrato al nostro sito attraverso {$providername} Connect. Puoi ora accedere facilmente al sito con il tuo account {$providername} utilizzando il pulsante {$providername} LOGIN; altrimenti puoi accedere con il pulsante login del sito con queste credenziali: \n \nUSERNAME: {$username} \n \nPASSWORD: {$newvalues['passwd']} \n \nSperiamo di rivederti spesso! \n{$_FN['admin']}, Amministratore di {$_FN['sitename']}","From: {$_FN['sitename']} <{$_FN['site_email_address']}>\r\n" . "Reply-To: {$_FN['site_email_address']}\r\n" . "X-Mailer: PHP/" . phpversion());
        return "created";
      }
      return "error creating";
      break;
    case "existandsameusername": // USER HAS CONNECTED TO EXISTING ACCOUNT (SAME USERNAME)
      if (fn_update_user($username, $newvalues)){
        @ mail("{$profileinfo['name']} <{$profileinfo['email']}>","$providername Connect su {$_FN['sitename']}","Ciao {$profileinfo['name']} e ti diciamo congratulazioni per aver collegato il tuo account su {$_FN['sitename']} con il tuo account di {$providername}! Puoi ora accedere facilmente al sito con il pulsante {$providername} LOGIN; altrimenti puoi continuare ad accedere con il pulsante login del sito con le stesse tue credenziali di prima: \n \nUSERNAME: {$username} \n \nPASSWORD: (tuo password di prima) \n \nSperiamo di rivederti spesso! \n{$_FN['admin']}, Amministratore di {$_FN['sitename']}","From: {$_FN['sitename']} <{$_FN['site_email_address']}>\r\n" . "Reply-To: {$_FN['site_email_address']}\r\n" . "X-Mailer: PHP/" . phpversion());
        return "updated";
      }
      return "error updating";
      break;
    case "associatewithold": // USER EXISTS BUT WITH DIFFERENT USERNAME
      if (fn_update_user($username, $newvalues)){
        @ mail("{$profileinfo['name']} <{$profileinfo['email']}>","$providername Connect su {$_FN['sitename']}","Ciao {$profileinfo['name']} e ti diciamo congratulazioni per aver collegato il tuo account su {$_FN['sitename']} con il tuo account di {$providername}! Puoi ora accedere facilmente al sito con il pulsante {$providername} LOGIN; altrimenti puoi continuare ad accedere con il pulsante login del sito con le stesse tue credenziali di prima: \n \nUSERNAME: {$username} \n \nPASSWORD: (tuo password di prima) \n \nSperiamo di rivederti spesso! \n{$_FN['admin']}, Amministratore di {$_FN['sitename']}","From: {$_FN['sitename']} <{$_FN['site_email_address']}>\r\n" . "Reply-To: {$_FN['site_email_address']}\r\n" . "X-Mailer: PHP/" . phpversion());
        return "updated";
      }
      return "error updating";
      break;
    case "alternativeusername": // USER DOES NOT YET EXIST BUT MUST USE OTHER USERNAME
      if(fn_add_user($username, $newvalues)){
        @ mail("{$profileinfo['name']} <{$profileinfo['email']}>","Benvenuto a {$_FN['sitename']}","Ciao {$profileinfo['name']} e benvenuto a {$_FN['sitename']}! Ti sei appena registrato al nostro sito attraverso {$providername} Connect. Puoi ora accedere facilmente al sito con il tuo account {$providername} utilizzando il pulsante {$providername} LOGIN; altrimenti puoi accedere con il pulsante login del sito con queste credenziali: \n \nUSERNAME: {$username} \n \nPASSWORD: {$newvalues['passwd']} \n \nSperiamo di rivederti spesso! \n{$_FN['admin']}, Amministratore di {$_FN['sitename']}","From: {$_FN['sitename']} <{$_FN['site_email_address']}>\r\n" . "Reply-To: {$_FN['site_email_address']}\r\n" . "X-Mailer: PHP/" . phpversion());
        return "created";
      }
      return "error creating";
      break;
    case "linkoldaccount":
      if(fn_update_user($username,$newvalues)){
        @ mail("{$profileinfo['name']} <{$profileinfo['email']}>","{$providername} Connect su {$_FN['sitename']}","Ciao {$profileinfo['name']}! Ti diciamo congratulazioni per avere collegato con successo l&apos;account che avevi su {$_FN['sitename']} con il tuo account {$providername}. \nPuoi ora accedere facilmente al sito con il tuo account {$providername} utilizzando il pulsante {$providername} LOGIN; \noppure puoi continuare ad accedere con il pulsante login del sito con le tue credenziali: \n \nUSERNAME: {$currentusername} \n \nPASSWORD: (tuo password di prima) \n \nSperiamo di rivederti spesso! \n \n{$_FN['admin']}, Amministratore di {$_FN['sitename']}","From: {$_FN['sitename']} <{$_FN['site_email_address']}>\r\n" . "Reply-To: {$_FN['site_email_address']}\r\n" . "X-Mailer: PHP/" . phpversion());
        return "updated";
      }
      return "error updating";
      break;
  }
	return "notcreated";
}
function getusernamefromsocialuid($provider,$uid){
  require_once("include/xmldb.php");
  $db = new XMLDatabase("fndatabase","misc");
  $provideruid = $provider."uid";
  $query = "SELECT username FROM users WHERE {$provideruid} = '".$uid."'";
  $result = $db->Query($query);
  $socialusername = $result[0]['username'];
  return $socialusername;
}  
?>