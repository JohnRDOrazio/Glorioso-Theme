<?php
/************************************************************************/
/* FlatNuke - Flat Text Based Content Management System                 */
/* ============================================                         */
/*                                                                      */
/* Copyright (c) 2003-2004 by Simone Vellei                             */
/* http://flatnux.sf.net                                                */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
global $_FN,$_FB,$_THEME_CFG;

/* LOCALE VARIABLES */
switch($_FN['lang']){
  case "en":
    $lcl="en_US";
    define("_GFC_LOGIN_BTN","Sign in with Google");
    define("_GFC_LOGIN","Sign in to {$_FN['sitename']} with Google Friend Connect");
    define("_GFC_LOGOUT","Sign out from {$_FN['sitename']} and from Google Friend Connect");
    define("_FB_LOGIN","Sign in to {$_FN['sitename']} with Facebook Connect");
    define("_FB_LOGOUT","Sign out from {$_FN['sitename']} and from Facebook");
    define("_FN_LOGIN","Sign in to {$_FN['sitename']} (or create a new account)");
    define("_FN_LOGOUT","Sign out from {$_FN['sitename']}");
    define("_FN_REGISTER","Create a new account on {$_FN['sitename']}");
    define("_USERBAR_SEARCH","Search for contents on the site {$_FN['sitename']}");
    define("_USERBAR_THEMECFG","Set configurations for this theme (config.php)");
    define("_USERBAR_LANGS","See the {$_FN['sitename']} website in another language");
    define("_USERBAR_THEMESWITCHER","Choose a different skin for this Theme, it will be applied immediately!");
    define("_USERBAR_BOOKMARK","Bookmark {$_FN['sitename']} on your Facebook Home so that you can come back easily!");
    define("_USERBAR_LIKE","Let your friends know that you like {$_FN['sitename']}!");
    define("_USERBAR_CAL","View the Event Calendar of {$_FN['sitename']}");
    break;
  case "it":
    $lcl="it_IT";
    define("_GFC_LOGIN_BTN","Accedi con Google");
    define("_GFC_LOGIN","Accedi a {$_FN['sitename']} con Google");
    define("_GFC_LOGOUT","Esci da {$_FN['sitename']} e da Google Friend Connect");
    define("_FB_LOGIN","Accedi a {$_FN['sitename']} con Facebook Connect");
    define("_FB_LOGOUT","Esci da {$_FN['sitename']} e da Facebook");
    define("_FN_LOGIN","Entra in questo sito (oppure registra un nuovo account)");
    define("_FN_LOGOUT","Esci da {$_FN['sitename']}");
    define("_FN_REGISTER","Registra un nuovo account su {$_FN['sitename']}");
    define("_USERBAR_SEARCH","Effettua una ricerca sul sito {$_FN['sitename']}");
    define("_USERBAR_THEMECFG","Setta le configurazioni per questo Tema (config.php)");
    define("_USERBAR_LANGS","Visualizza il sito {$_FN['sitename']} in un&#39;altra lingua");
    define("_USERBAR_THEMESWITCHER","Scegli un altra veste grafica per questo Tema, si applicherà immediatamente!");
    define("_USERBAR_BOOKMARK","Aggiungi un segnalibro alla tua pagina iniziale su Facebook per tornare facilmente a {$_FN['sitename']}!");
    define("_USERBAR_LIKE","Fai sapere ai tuoi amici che ti piace {$_FN['sitename']}!");
    define("_USERBAR_CAL","Visualizza il Calendario degli Eventi di {$_FN['sitename']}");
    break;
  case "de":
    $lcl="de_DE";
    define("_GFC_LOGIN_BTN","Melden Sie sich mit Google");
    define("_GFC_LOGIN","Melden Sie sich bei {$_FN['sitename']} mit Google");
    define("_GFC_LOGOUT","Beenden {$_FN['sitename']} und Google Friend Connect");
    define("_FB_LOGIN","Melden Sie sich bei {$_FN['sitename']} mit Facebook Connect");
    define("_FB_LOGOUT","Beenden {$_FN['sitename']} und Facebook");
    define("_FN_LOGIN","Melden Sie sich bei {$_FN['sitename']} (Oder ein neues Konto eröffnen)");
    define("_FN_LOGOUT","Beenden {$_FN['sitename']}");
    define("_FN_REGISTER","Erstellen Sie ein neues Konto auf {$_FN['sitename']}");
    define("_USERBAR_SEARCH","Suche Inhalte auf der Website {$_FN['sitename']}");
    define("_USERBAR_THEMECFG","Passen Sie diese Website Themen (config.php)");
    define("_USERBAR_LANGS","Siehe die Website {$_FN['sitename']} in einer anderen Sprache");
    define("_USERBAR_THEMESWITCHER","Wählen Sie eine andere Grafik-Weste für dieses Thema, wird es sofort angewendet werden!");
    define("_USERBAR_BOOKMARK","Bookmarken Sie {$_FN['sitename']} auf Ihrem Facebook Homepage, so dass Sie leicht zurück kommen!");
    define("_USERBAR_LIKE","Erzählen Sie Ihren Freunden, dass Sie {$_FN['sitename']} gefällt!");
    define("_USERBAR_CAL","Sehen Sie sich die Veranstaltungen Kalender von {$_FN['sitename']}");
    break;
  case "fr":
    $lcl="fr_FR";
    define("_GFC_LOGIN_BTN","Connectez-vous avec Google");
    define("_GFC_LOGIN","Connectez-vous à {$_FN['sitename']} avec Google");
    define("_GFC_LOGOUT","Sortir de {$_FN['sitename']} et de Google Friend Connect");
    define("_FB_LOGIN","Connectez-vous à {$_FN['sitename']} avec Facebook Connect");
    define("_FB_LOGOUT","Sortir de {$_FN['sitename']} et de Facebook");
    define("_FN_LOGIN","Connectez-vous à {$_FN['sitename']} (Ou créer un nouveau compte)");
    define("_FN_LOGOUT","Sortir de {$_FN['sitename']}");
    define("_FN_REGISTER","Créez-vous un nouveau compte sur {$_FN['sitename']}");
    define("_USERBAR_SEARCH","Recherchez-vous des contenus sur le site {$_FN['sitename']}");
    define("_USERBAR_THEMECFG","Configurez-vous ce Thème (config.php)");
    define("_USERBAR_LANGS","Voyez le site {$_FN['sitename']} dans une autre langue");
    define("_USERBAR_THEMESWITCHER","Choisissez une veste graphique différent pour ce Thème, elle sera appliquée immédiatement!");
    define("_USERBAR_BOOKMARK","Ajouter un signet pour {$_FN['sitename']} sur votre page d'accueil Facebook pour que vous puissiez revenir facilement!");
    define("_USERBAR_LIKE","Faites savoir à vos amis que vous aimez {$_FN['sitename']}!");
    define("_USERBAR_CAL","Voir le Calendrier des Événements de {$_FN['sitename']}");
    break;
  case "es":
    $lcl="es_Es";
    define("_GFC_LOGIN_BTN","Ingresa con Google");
    define("_GFC_LOGIN","Ingresa a {$_FN['sitename']} con Google");
    define("_GFC_LOGOUT","Sal de {$_FN['sitename']} y de Google Friend Connect");
    define("_FB_LOGIN","Ingresa a {$_FN['sitename']} con Facebook Connect");
    define("_FB_LOGOUT","Sal de {$_FN['sitename']} y de Facebook");
    define("_FN_LOGIN","Ingresa a {$_FN['sitename']} (O crear una cuenta nueva)");
    define("_FN_LOGOUT","Sal de {$_FN['sitename']}");
    define("_FN_REGISTER","Crea una nueva cuenta en {$_FN['sitename']}");
    define("_USERBAR_SEARCH","Busca contenidos en el sitio web {$_FN['sitename']}");
    define("_USERBAR_THEMECFG","Configura este Tema (config.php)");
    define("_USERBAR_LANGS","Ve {$_FN['sitename']} en otro idioma");
    define("_USERBAR_THEMESWITCHER","Elije un chaleco grafico diferente por este Tema, se aplicará de inmediato!");
    define("_USERBAR_BOOKMARK","Añade un marcador a su página inicial de Facebook, para facilitar el acceso a {$_FN['sitename']}!");
    define("_USERBAR_LIKE","Dile a tus amigos que te gusta {$_FN['sitename']}!");
    define("_USERBAR_CAL","Ve el Calendario de Eventos de {$_FN['sitename']}");
    break;
  case "ru":
    $lcl="ru_RU";
    define("_GFC_LOGIN_BTN","Войти с Google");
    define("_GFC_LOGIN","Войти на {$_FN['sitename']} с Google");
    define("_GFC_LOGOUT","Выйти из {$_FN['sitename']} и от Google Friend Connect");
    define("_FB_LOGIN","Войти на {$_FN['sitename']} с Facebook Connect");
    define("_FB_LOGOUT","Выход из {$_FN['sitename']} и Facebook");
    define("_FN_LOGIN","Войти на {$_FN['sitename']} (или зарегистрировать новую учетную запись)");
    define("_FN_LOGOUT","Выход из {$_FN['sitename']}");
    define("_FN_REGISTER","Создать новую учетную запись на {$_FN['sitename']}");
    define("_USERBAR_SEARCH","Выполнить поиск по сайту {$_FN['sitename']}");
    define("_USERBAR_THEMECFG","Конфигурация сайте Тема (config.php)");
    define("_USERBAR_LANGS","см. веб-сайт {$_FN['sitename']} на другом языке");
    define("_USERBAR_THEMESWITCHER","Выберите различных графических жилет для этой Темы, она будет применяться сразу же!");
    define("_USERBAR_BOOKMARK","Закладка {$_FN['sitename']} на вашем того, домашняя страница, чтобы можно было вернуться легко!");
    define("_USERBAR_LIKE","Расскажите своим друзьям, что вам нравится {$_FN['sitename']}!");
    define("_USERBAR_CAL","Открыть Календарь событий из {$_FN['sitename']}");
    break;
  default:
    $lcl="en_US";
    define("_GFC_LOGIN_BTN","Sign in with Google");
    define("_GFC_LOGIN","Sign in to {$_FN['sitename']} with Google");
    define("_GFC_LOGOUT","Sign out from {$_FN['sitename']} and from Google Friend Connect");
    define("_FB_LOGIN","Sign in to {$_FN['sitename']} with Facebook Connect");
    define("_FB_LOGOUT","Sign out from {$_FN['sitename']} and from Facebook");
    define("_FN_LOGIN","Sign in to {$_FN['sitename']} (or create a new account)");
    define("_FN_LOGOUT","Sign out from {$_FN['sitename']}");
    define("_FN_REGISTER","Create a new account on {$_FN['sitename']}");
    define("_USERBAR_SEARCH","Search for contents on the site {$_FN['sitename']}");
    define("_USERBAR_THEMECFG","Set configurations for this Theme (config.php)");
    define("_USERBAR_LANGS","See the {$_FN['sitename']} website in another language");
    define("_USERBAR_THEMESWITCHER","Choose a different skin for this Theme, it will be applied immediately!");
    define("_USERBAR_BOOKMARK","Bookmark {$_FN['sitename']} on your Facebook Home so that you can come back easily!");
    define("_USERBAR_CAL","View the Event Calendar of {$_FN['sitename']}");
    define("_USERBAR_LIKE","Let your friends know that you like {$_FN['sitename']}!");
}

($_THEME_CFG['right_column_color']!="") ? $_THEME_CFG['right_column_color']="background-color:#{$_THEME_CFG['right_column_color']};" : "";
($_THEME_CFG['center_column_color']!="") ? $_THEME_CFG['center_column_color']="background-color:#{$_THEME_CFG['center_column_color']};" : "";
($_THEME_CFG['left_column_color']!="") ? $_THEME_CFG['left_column_color']="background-color:#{$_THEME_CFG['left_column_color']};" : "";
($_THEME_CFG['bodycolor']!="") ? $_THEME_CFG['bodycolor']="background-color:#{$_THEME_CFG['bodycolor']};" : "";

/*******************************
* CALCULATE STYLES FOR COLUMNS *
*******************************/
$_THEME_CFG['centercolleftmarg'] = $_THEME_CFG['leftcolwidth']+1;
$_THEME_CFG['centercolrightmarg'] = $_THEME_CFG['rightcolwidth']+1;
if($_THEME_CFG['showblocksright'] == 0){
  $_THEME_CFG['rightcolwidth']=0;
  }
if($_THEME_CFG['showblocksleft'] == 0){
  $_THEME_CFG['leftcolwidth']=0;
  }

/***************
* INIZIO BODY  *
***************/
if($_THEME_CFG['full_page_backimage']==1){
	echo "<body style=\"{$_THEME_CFG['bodycolor']}\">";
	echo "<img class=\"bg\" src=\"{$_THEME_CFG['backimage']}\" />";
	//echo "<div id=\"body-content\">";
}
else{
	if($_THEME_CFG['backimage']!=""){ $_THEME_CFG['backimage']="background-image:url({$_THEME_CFG['backimage']});"; }
	if($_THEME_CFG['backimage_repeat']!=""){ $_THEME_CFG['backimage_repeat']="background-repeat:{$_THEME_CFG['backimage_repeat']};"; }
	if($_THEME_CFG['backimage_attachment']!=""){ $_THEME_CFG['backimage_attachment']="background-attachment:{$_THEME_CFG['backimage_attachment']};"; }
	echo "<body style=\"{$_THEME_CFG['bodycolor']}{$_THEME_CFG['backimage']}{$_THEME_CFG['backimage_repeat']}{$_THEME_CFG['backimage_attachment']}\">";
}
if ($_THEME_CFG['use_fb']==1){
  echo "<div id=\"fb-root\"></div>
<script type=\"text/javascript\">
 window.fbAsyncInit = function() {
     FB.init({
       appId  : '{$_THEME_CFG['fb_app_id']}',
       status : true, // check login status
       cookie : true, // enable cookies to allow the server to access the session
       xfbml  : true  // parse XFBML
     });
   };

  (function() {
    var e = document.createElement('script');
    e.src = document.location.protocol + '//connect.facebook.net/{$lcl}/all.js';
    e.async = true;
    document.getElementById('fb-root').appendChild(e);
  }());
</script>";
}

if ($_THEME_CFG['use_messlive']==1){
  echo "<script type=\"text/javascript\">
var dataContext;
var auth;

// Callback for when the Application successfully loads.
function appLoaded(appLoadedEventArgs) {
    auth = Microsoft.Live.App.get_auth();
}

// Callback for when Sign in completes. Check whether it was successful.
function signInCompleted() {
    if (auth.get_state() === Microsoft.Live.AuthState.failed) {
        Sys.Debug.trace('Authentication failed.');
        return;
    }
    else if (auth.get_state() === Microsoft.Live.AuthState.authenticated) {
        Sys.Debug.trace('Authentication succeeded.');
        dataContext = Microsoft.Live.App.get_dataContext();
        location.href = '?mod=login&opmod=profile';
    }
}

function signOutCompleted() {
    // Perform actions upon signing out.
    Sys.Debug.trace('Good-bye.');
    location.href = '?mod=login&op=logout';
}
</script>
";
}

if ($_THEME_CFG['use_gan']==1){   ?>
<!-- Account Google Analytics -->
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '<?php echo $_THEME_CFG['gan_account']?>']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(ga);
  })();
</script>
<?php } ?>
<div id='theme_edit_dialog'></div>
<div id="loading">
  <span>Attendere prego...</span>
  <br />
  <img src="<?php echo $_THEME_CFG['ajax_gif']?>" alt="loading..." />
  <a href="index.php?mod=<?php echo $_FN['vmod']?>" class="ui-state-default ui-priority-primary ui-corner-all">...RICARICA LA PAGINA</a>
</div>
<div id="TIP"></div>
<div id="movie">
	<div id="movieclose"></div>
	<div id="moviecontent"></div>
	<div id="movietoolbar" class="fg-toolbar">
		<div id="movieseekfirst" class="movie-button">
			<span class="ui-icon ui-icon-seek-first"></span>
		</div>
		<div id="movieplaypause" class="movie-button">
			<span class="ui-icon ui-icon-pause"></span>
		</div>
		<div id="moviestop" class="movie-button">
			<span class="ui-icon ui-icon-stop"></span>
		</div>
		<div id="movieseekend" class="movie-button">
			<span class="ui-icon ui-icon-seek-end"></span>
		</div>
		<div id="movievolume" class="movie-button">
			<span class="ui-icon ui-icon-volume-on"></span>
		</div>
		<div id="volumeSetting"></div>
	</div>
	<span id="moviepaused">PAUSE</span>
</div>
<div id="pagetop">
			<?php
			echo local_to_abs("themes/$theme/userbar.php");
      echo local_to_abs("themes/$theme/top.php");
      ?>
</div>

<!-- START PAGEMIDDLE -->
<div id="pagecenter" style="clear:both;padding-left:<?php echo $_THEME_CFG['centercolleftmarg'];?>px;padding-right:<?php echo $_THEME_CFG['centercolrightmarg'];?>px;">

<!-- START COLUMN CENTER --> 
<div id="col3wrapper" style="float:left;position:relative;width:100%;">
<?php if ($_THEME_CFG['show_top_horizontal_menu']==1) { 
	echo "<div id=\"top_horizontal_menu\" class=\"fg-toolbar ui-widget-header ui-corner-all ui-helper-clearfix\"><div class=\"fg-buttonset fg-buttonset-single ui-helper-clearfix fn-menu\">";
	create_h_menu();
	echo "</div></div>";
}
?>
<div id="floptdiv">
<?php
// ATTENZIONE
// NON MODIFICARE!!!!
getflopt();
// FINE
?>
</div>
<?php
if ($_THEME_CFG['show_bottom_horizontal_menu']==1) {
	echo "<div id=\"bottom_horizontal_menu\" class=\"fg-toolbar ui-widget-header ui-corner-all ui-helper-clearfix\"><div class=\"fg-buttonset fg-buttonset-single ui-helper-clearfix fn-menu\">";
	create_h_menu();
	echo "</div></div>";
}
?>
</div>				
<!-- START COLUMN CENTER --> 
<!-- START COLUMN LEFT --> 
<div id="col1wrapper" class="side-column" style="float:left;position:relative;width:<?php echo $_THEME_CFG['leftcolwidth']?>px;margin-left:-100%;right:<?php echo $_THEME_CFG['centercolleftmarg']?>px;">
<?php
	if ($_THEME_CFG['showmenuleft'] != 0)
		create_menu();
	if ($_THEME_CFG['showblocksleft'] != 0)
	{
		create_blocks("sx");
		if ($_THEME_CFG['showblocksright'] == 0)
			create_blocks("dx");
	}
?>
</div>
<!-- END COLUMN LEFT --> 
<!-- START COLUMN RIGHT --> 
<div id="col2wrapper" class="side-column" style="float:left;position:relative;width:<?php echo $_THEME_CFG['rightcolwidth']?>px;margin-right:-100%;">
<?php
	if ($_THEME_CFG['showmenuright'] != 0)
		create_menu();
	if ($_THEME_CFG['showblocksright'] != 0)
	{
		create_blocks("dx");
		if ($_THEME_CFG['showblocksleft'] == 0)
			create_blocks("sx");
	}
?>
</div>
<!-- END COLUMN RIGHT --> 

</div>
<!-- END PAGEMIDDLE -->

<!-- FOOTER  -->
<div id="pagebottom" <?php echo ($_THEME_CFG['use_gfc']==1&&$_THEME_CFG['gfc_social']!="") ? "style=\"padding-bottom:40px;\"" : "";?>>
<?php
include("themes/".$_FN['theme']."/footer.php");
?>
</div>
<!-- END FOOTER -->

<?php
if ($_THEME_CFG['use_gfc']==1){
  echo "
  <div id=\"{$_THEME_CFG['gfc_social']}\"></div>
  <!-- Render the google social gadget -->
  <script type=\"text/javascript\">
  var skin = {};
  skin['BORDER_COLOR'] = '#cccccc';
  skin['ENDCAP_BG_COLOR'] = '#e0ecff';
  skin['ENDCAP_TEXT_COLOR'] = '#333333';
  skin['ENDCAP_LINK_COLOR'] = '#0000cc';
  skin['ALTERNATE_BG_COLOR'] = '#ffffff';
  skin['CONTENT_BG_COLOR'] = '#ffffff';
  skin['CONTENT_LINK_COLOR'] = '#0000cc';
  skin['CONTENT_TEXT_COLOR'] = '#333333';
  skin['CONTENT_SECONDARY_LINK_COLOR'] = '#7777cc';
  skin['CONTENT_SECONDARY_TEXT_COLOR'] = '#666666';
  skin['CONTENT_HEADLINE_COLOR'] = '#333333';
  skin['POSITION'] = 'bottom';
  skin['DEFAULT_COMMENT_TEXT'] = '- aggiungi qui il tuo commento -';
  skin['HEADER_TEXT'] = 'Commenti';
  google.friendconnect.container.renderSocialBar(
   { id: '{$_THEME_CFG["gfc_social"]}',
     site: '{$_THEME_CFG["gfc_site"]}',
     locale: '{$_FN["lang"]}',
     'view-params':{\"scope\":\"SITE\",\"allowAnonymousPost\":\"true\",\"features\":\"video,comment\",\"showWall\":\"true\"} },skin);
  </script>";
}
if($_THEME_CFG['full_page_backimage']==1){ //echo "</div>";
 }
echo "<div id='tooltip'></div>";
echo "</body></html>";
?>