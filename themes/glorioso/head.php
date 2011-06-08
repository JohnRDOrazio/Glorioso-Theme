<?php

if(file_exists("themes/glorioso/firstinstall")){ 
  Header("Location: /themes/glorioso/install.php");
  exit;
}

global $_THEME_CFG,$htmlver;
require_once("themes/glorioso/languages/{$_FN['lang']}.php");

/************************************************************
*         START TO BUILD DOCUMENT                           *
************************************************************/

	// start HTML headers
	$xmlns = "xmlns=\"http://www.w3.org/1999/xhtml\"";
  $xmlns_fb = "xmlns:fb=\"http://www.facebook.com/2008/fbml\"";
	$xmlns_wl = "xmlns:wl=\"http://apis.live.net/js/2010\"";
	$htmlver = theme_doctype(_CHARSET);  // will give HTML5 for browsers that support it, otherwise XHTML 1.1. Defined in theme.php.
	$close_tag = $htmlver['closetag'];
  echo $htmlver['doctype']."\n";
	echo "<html $xmlns $xmlns_fb $xmlns_wl lang=\""._FN_LANG."\">\n";
	echo "<head>\n";
	$sitename = $_FN['sitetitle'] ;
	if ( $_FN['vmod'] != "" )
	{
		$tmp = preg_replace("/^[0-9][0-9]_/s","",$_FN['vmod']);
		$title = str_replace("_","&nbsp;",str_replace(".php","",$tmp));
		$titlesun = getLang("sections/{$_FN['vmod']}/lang.xml",$title);
		$_FN['sitetitle'] = "$sitename &raquo;  $titlesun";
	}
	if (file_exists ( "sections/" . $_FN['vmod'] . "/sethead.php" ))
		include ( "sections/" . $_FN['vmod'] . "/sethead.php" );
	echo "\t<title>{$_FN['sitetitle']}</title>\n";
echo "\t".$htmlver['metachromeframe']."\n";
echo "\t".$htmlver['metacharset']."\n";	
echo "\t<meta http-equiv=\"Content-Language\" content=\""._FN_LANG."\" $close_tag>\n";
echo $_THEME_CFG["use_messlive"]==1 ? "<meta name=\"search.app\" content=\"WindowsLive\"/>" : "";
echo "\t<meta name=\"RESOURCE-TYPE\" content=\"DOCUMENT\" $close_tag>\n";
	echo "\t<meta http-equiv=\"EXPIRES\" content=\"0\" $close_tag>\n";
	echo "\t<meta name=\"DISTRIBUTION\" content=\"GLOBAL\" $close_tag>\n";
	echo "\t<meta name=\"AUTHOR\" content=\"{$_FN['sitename']}\" $close_tag>\n";
	echo "\t<meta name=\"COPYRIGHT\" content=\"Copyright (c) 2005 by {$_FN['sitename']}\" $close_tag>\n";
	if ($_FN['keywords'] != "")
		echo "\t<meta name=\"KEYWORDS\" content=\"{$_FN['keywords']}\" $close_tag>\n";
	echo "\t<meta name=\"DESCRIPTION\" content=\"{$_FN['sitename']}\" $close_tag>\n";
	echo "\t<meta name=\"ROBOTS\" content=\"INDEX, FOLLOW\" $close_tag>\n";
	echo "\t<meta name=\"REVISIT-AFTER\" content=\"1 DAYS\" $close_tag>\n";
	echo "\t<meta name=\"RATING\" content=\"GENERAL\" $close_tag>\n";
	// Se il javascript non è abilitato, almeno c'è qui un foglio css di default...
  echo $_THEME_CFG['use_jqueryui'] ? "<link href=\"http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/{$_THEME_CFG['jqueryui_default']}/jquery-ui.css\" rel=\"stylesheet\" type=\"text/css\"/>" : "";
	//GOOGLE WEBMASTER TOOLS:
	echo "\t<meta name=\"google-site-verification\" content=\"{$_THEME_CFG['webmastertoolscode']}\" $close_tag>\n";
	echo "\t<link rel=\"apple-touch-icon\" href=\"apple-touch-icon.png\" $close_tag>\n";
  if (file_exists ( "" . $_FN['datadir'] . "/{$_FN['lang']}/backend.xml" ))
		echo "\t<link rel=\"alternate\" type=\"application/rss+xml\" title=\"{$_FN['sitename']}\" href=\"{$_FN['siteurl']}{$_FN['datadir']}/{$_FN['lang']}/backend.xml\" $close_tag>\n";
	if (file_exists ( "themes/{$_FN['theme']}/header.php" )) //aggiunte personalizzate per l'header
		include ( "themes/{$_FN['theme']}/header.php" );
		
  $_THEME_CFG['googlefonts'] = str_replace("'", '', $_THEME_CFG['googlefonts']);
  $_THEME_CFG['googlefonts'] = str_replace('"', '', $_THEME_CFG['googlefonts']);
  $googlefonts = explode(',',$_THEME_CFG['googlefonts']);

	IncludeCss ( $close_tag );
	
	?>

<script type="text/javascript">
	//<!--
	function check(url)
	{
		if(confirm ("<?php
	echo _SICURO?>"))
			window.location=url;
	}
	// -->
function getCookie(c_name)
{
if (document.cookie.length>0)
  {
  c_start=document.cookie.indexOf(c_name + "=");
  if (c_start!=-1)
    {
    c_start=c_start + c_name.length+1;
    c_end=document.cookie.indexOf(";",c_start);
    if (c_end==-1) c_end=document.cookie.length;
    return unescape(document.cookie.substring(c_start,c_end));
    }
  }
return "";
}</script>

<?php

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
* Google Javascript loader api.															*
* Richiede una chiave che si può richiedere QUI:										*
* http://code.google.com/apis/ajaxsearch/signup.html									*
* Dà accesso anche ad altre informazioni sul client che effettua l'accesso... 			*
* Permette di caricare ed utilizzare facilmente le api di google quali					*
* Maps, Search, Feeds, Language, Data, Earth, Visualization, Friend Connect, Orkut		*
* 																						*
* Conviene chiamare in questo modo le librerie perché può velocizzare il caricamento,	*
* in quanto è possibile che il client abbia l'una o l'altra libreria già nel cache		*
* da un sito che usa questo stesso metodo.												*
* Si veda http://code.google.com/apis/ajax/documentation/ 								*
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * **/

if($_THEME_CFG['use_jsapi'] == 1) {
	echo "<script type=\"text/javascript\" src=\"http://www.google.com/jsapi?key={$_THEME_CFG['jsapi_key']}\"></script>\n".
  "<script type=\"text/javascript\">";
	/* jQuery */
	echo ($_THEME_CFG['use_jquery']==1) ? "google.load(\"jquery\", \"1\");" : "";	
	/* jQuery-UI */
	echo ($_THEME_CFG['use_jqueryui']==1) ? "google.load(\"jqueryui\", \"1\");" : "";	
  /* Google Friend Connect Javascript API */
  echo ($_THEME_CFG['use_gfc']==1) ? "google.load(\"friendconnect\", \"0.8\", {'base_domain':'www.google.com'});" : "";
  /* Google Font API WebFont Loader */
  echo ($_THEME_CFG['use_webfont']==1) ? "google.load(\"webfont\", \"1\");" : "";
	/* Prototype */
	echo ($_THEME_CFG['use_prototype']==1) ? "google.load(\"prototype\", \"1\");" : "";	
	/* script.aculo.us *** N.B. script.aculo.us depends on prototype. Prototype must be called first. */
	echo ($_THEME_CFG['use_scriptaculous']==1) ? "google.load(\"scriptaculous\", \"1\");" : "";	
	/* MooTools */
	echo ($_THEME_CFG['use_mootools']==1) ? "google.load(\"mootools\", \"1\");" : "";	
	/* Dojo */
	echo ($_THEME_CFG['use_dojo']==1) ? "google.load(\"dojo\", \"1\");" : "";	
	/* SWFObject */
	echo ($_THEME_CFG['use_swfobject']==1) ? "google.load(\"swfobject\", \"2\");" : "";	
	/* Yahoo! User Interface Library (YUI) */
	echo ($_THEME_CFG['use_yui']==1) ? "google.load(\"yui\", \"2\");" : "";	
	/* Ext Core */
	echo ($_THEME_CFG['use_extcore']==1) ? "google.load(\"ext-core\", \"3\");" : "";	
	/* Chrome Frame */
	echo ($_THEME_CFG['use_chromeframe']==1) ? "google.load(\"chrome-frame\", \"1\");" : "";

  echo "google.setOnLoadCallback(function() { ";

  echo ($_THEME_CFG['use_webfont']==1) ?  "WebFont.load({ google: { families: ['".implode("','",$googlefonts)."'] }});" : "";      
  echo ($_THEME_CFG['use_gfc']==1) ? "google.friendconnect.container.setParentUrl('/');
                                      google.friendconnect.container.loadOpenSocialApi({
                                          site: '{$_THEME_CFG["gfc_site"]}',
                                          onload: function(securityToken) {
                                               if (!window.timesloaded) {
                                                    window.timesloaded = 1;
                                                  } else {
                                                    window.timesloaded++;
                                                  }
                                               if (window.timesloaded > 1) {
                                                  gfcsession = getCookie('fcauth{$_THEME_CFG["gfc_site"]}');
                                                  if(gfcsession!=null&&gfcsession!=''){ window.top.location.href = 'index.php?mod=login&opmod=profile'; }
                                                  else{ window.top.location.href = 'index.php?mod=login&op=logout'; }
                                                  }
                                              }
                                        });
                                        google.friendconnect.renderSignInButton({ \"id\":\"gfc-button\", \"style\":\"long\", \"text\":\""._GFC_LOGIN_BTN."\" });" : "";
  
  echo "});";
	echo "</script>";
	/* END OF GOOGLE JAVASCRIPT LOADER API */
}

	/********************************************
	* Alternativamente al google jsapi loader,  *
	* che richiede una chiave,                  *	
	* si possono chiamare le librerie 			    *
	* dal repository di google direttamente: 	  *
	********************************************/
else{		
  echo ($_THEME_CFG['use_jquery']==1) ? "<script type=\"text/javascript\" src=\"http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js\"></script>\n" : "";
  echo ($_THEME_CFG['use_jqueryui']==1) ? "<script type=\"text/javascript\" src=\"http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js\"></script>\n" : "";
  echo ($_THEME_CFG['use_webfont']==1) ? "<script type=\"text/javascript\" src=\"http://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js\"></script>\n" : "";
  echo ($_THEME_CFG['use_gfc']==1) ? "<script type=\"text/javascript\" src=\"http://www.google.com/friendconnect/script/friendconnect.js\"></script>\n" : "";
	echo ($_THEME_CFG['use_prototype']==1) ? "<script type=\"text/javascript\" src=\"http://ajax.googleapis.com/ajax/libs/prototype/1/prototype.js\"></script>\n" : "";
	echo ($_THEME_CFG['use_scriptaculous']==1) ? "<script type=\"text/javascript\" src=\"http://ajax.googleapis.com/ajax/libs/scriptaculous/1/scriptaculous.js\"></script>\n" : "";	
	echo ($_THEME_CFG['use_mootools']==1) ? "<script type=\"text/javascript\" src=\"http://ajax.googleapis.com/ajax/libs/mootools/1/mootools-yui-compressed.js\"></script>\n" : "";
	echo ($_THEME_CFG['use_dojo']==1) ? "<script type=\"text/javascript\" src=\"http://ajax.googleapis.com/ajax/libs/dojo/1/dojo/dojo.xd.js\"></script>\n" : "";
	echo ($_THEME_CFG['use_swfobject']==1) ? "<script type=\"text/javascript\" src=\"http://ajax.googleapis.com/ajax/libs/swfobject/2/swfobject.js\"></script>\n" : "";
	echo ($_THEME_CFG['use_yui']==1) ? "<script type=\"text/javascript\" src=\"http://ajax.googleapis.com/ajax/libs/yui/2/build/yuiloader/yuiloader-min.js\"></script>\n" : "";
	echo ($_THEME_CFG['use_extcore']==1) ? "<script type=\"text/javascript\" src=\"http://ajax.googleapis.com/ajax/libs/ext-core/3/ext-core.js\"></script>\n" : "";
	echo ($_THEME_CFG['use_chromeframe']==1) ? "<!--[if IE]>\n<script type=\"text/javascript\" src=\"http://ajax.googleapis.com/ajax/libs/chrome-frame/1/CFInstall.min.js\"></script>\n<style>\n .chromeFrameInstallDefaultStyle { width: 100%; border: 5px solid blue; } \n</style>\n<div id=\"prompt\">\n<!-- if IE without GCF, prompt goes here -->\n</div>\n    <script type=\"text/javascript\">\n window.attachEvent(\"onload\", function() { CFInstall.check({ mode: \"inline\", node: \"prompt\" }); });\n </script>\n<![endif]-->" : "";

  echo "<script type='text/javascript'>";
  echo ($_THEME_CFG['use_webfont']==1) ?  "WebFont.load({ google: { families: ['".implode("','",$googlefonts)."'] }});" : "";      
  echo ($_THEME_CFG['use_gfc']==1) ? "google.friendconnect.container.setParentUrl('/');
                                      google.friendconnect.container.loadOpenSocialApi({
                                          site: '".$_THEME_CFG["gfc_site"]."',
                                          onload: function(securityToken) {
                                               if (!window.timesloaded) {
                                                    window.timesloaded = 1;
                                                  } else {
                                                    window.timesloaded++;
                                                  }
                                               if (window.timesloaded > 1) {
                                                  gfcsession = getCookie('fcauth".$_THEME_CFG["gfc_site"]."');
                                                  if(gfcsession!=null&&gfcsession!=''){ 
                                                    // if google talk gadget...
                                                    window.open(\"https://www.google.com/accounts/ServiceLogin?service\x3dtalk\x26passive\x3dtrue\x26skipvpage\x3dtrue\x26continue\x3dhttps://talkgadget.google.com/talkgadget/auth?verify%3Dtrue%26http%3Dtrue\", \"_blank\", \"scrollbars=1,resizable=1\");
                                                    // end if google talk gadget...
                                                    window.top.location.href = 'index.php?mod=login&opmod=profile'; 
                                                  }
                                                  else{ 
                                                    window.top.location.href = 'index.php?mod=login&op=logout'; 
                                                  }
                                                }
                                          }
                                      });" : "";
  echo "</script>";  

}	

	/* Alcuni plugins per jquery: */
	echo ($_THEME_CFG['use_jquery']==1) ? "<script type=\"text/javascript\" src=\"themes/{$_FN['theme']}/javascripts/jquery-periodicalupdater.js\"></script>\n" : "";
	echo ($_THEME_CFG['use_jquery']==1) ? "<script type=\"text/javascript\" src=\"themes/{$_FN['theme']}/javascripts/jquery-fullcalendar.min.js\"></script>\n" : "";
	echo ($_THEME_CFG['use_jquery']==1) ? "<script type=\"text/javascript\" src=\"themes/{$_FN['theme']}/javascripts/jquery-fullcalendar-gcal.js\"></script>\n" : "";
	echo ($_THEME_CFG['use_jquery']==1) ? "<script type=\"text/javascript\" src=\"themes/{$_FN['theme']}/javascripts/jquery-ui-selectmenu.js\"></script>\n" : "";
	echo ($_THEME_CFG['use_jquery']==1) ? "<script type=\"text/javascript\" src=\"themes/{$_FN['theme']}/javascripts/jquery-tools-min.js\"></script>\n" : "";
	echo ($_THEME_CFG['use_1pixeloutaudioplayer']==1) ? "<script type=\"text/javascript\" src=\"themes/{$_FN['theme']}/javascripts/1pixeloutplayer/audio-player.js\"></script>\n" : "";
	echo ($_THEME_CFG['notuse_webtoolkitMD5']==0) ? "<script type=\"text/javascript\" src=\"themes/{$_FN['theme']}/javascripts/webtoolkit.md5.js\"></script>\n" : "";
  echo ($_THEME_CFG['use_jquery']==1) ? "<script type=\"text/javascript\" src=\"themes/{$_FN['theme']}/javascripts/jquery.address-1.3.2.min.js\"></script>\n" : "";
  echo ($_THEME_CFG['use_jquery']==1) ? "<script type=\"text/javascript\" src=\"themes/{$_FN['theme']}/javascripts/glorioso.js\"></script>" : "";

	/* Messenger Live Connect */
	echo ($_THEME_CFG['use_messlive']==1) ? "<script type=\"text/javascript\" src=\"http://js.live.net/4.1/loader.js\"></script>" : "";

	/* Preferisco usare questa funzione che ho definito in "themes/THISTHEME/theme.php" piuttosto che "IncludeJavascripts()" definita in "include/functions.php" di Flatnux, perché quest'ultima carica i javascripts di "include/javascripts" in ordine casuale mentre la mia li carica in ordine logico-alfabetico. Caricando in ordine logico-alfabetico permette di rispettare eventuali dipendenze tra plugins aggiungendo un numero iniziale, similmente ai blocchi e alle sezioni di Flatnux. */
	MyIncludeJavascripts ();

/* VERIFY POSSIBLE SOCIAL SESSIONS AND MANAGE SOCIAL USER REGISTRATION */
set_include_path(get_include_path() . PATH_SEPARATOR . 'themes/glorioso/include/');
require_once("verify_social_sessions.php");


echo "\n</head>\n";

?>