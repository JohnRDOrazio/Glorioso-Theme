<?php


/* Inizializza l'array delle variabili di configurazione */
$_THEME_CFG = Array();

/* Site Appearance */

#[it]Visualizza blocchi a destra {1=SI,0=NO}
#[en]View right blocks {1=YES,0=NO}
$_THEME_CFG['showblocksright'] = 1;
#[it]Visualizza blocchi a sinistra {1=SI,0=NO}
#[en]View left blocks {1=YES,0=NO}
$_THEME_CFG['showblocksleft'] = 1;
#[it]Larghezza colonna sinistra (%)
#[en]Left column width (%)
$_THEME_CFG['leftcolwidth'] = "20";
#[it]Larghezza colonna destra (%)
#[en]Right column width (%)
$_THEME_CFG['rightcolwidth'] = "16";
#[it]Visualizza il menu verticale a sinistra {1=SI,0=NO}
#[en]View vertical menu on the left {1=YES,0=NO}
$_THEME_CFG['showmenuleft'] = 1;
#[it]Visualizza il menu verticale a destra {1=SI,0=NO}
#[en]View vertical menu on the right {1=YES,0=NO}
$_THEME_CFG['showmenuright'] = 0;
#[it]Visualizza le sottosezioni nel menu laterale {1=SI,0=NO}
#[en]View subsections in the side menu {1=YES,0=NO}
$_THEME_CFG['menu_recursive'] = 1;
#[it]Visualizza le sottosezioni nel menu laterale solo nella sezione corrente {1=SI,0=NO}
#[en]View subsections in the side menu only in the current section {1=YES,0=NO}
$_THEME_CFG['menu_recursive_onlyselected'] = 0;
#[it]Visualizza il menu orizzontale in alto {1=SI,0=NO}
#[en]Show top horizontal menu {1=YES,0=NO}
$_THEME_CFG['show_top_horizontal_menu'] = 0;
#[it]Visualizza il menu orizzontale in basso {1=SI,0=NO} 
#[en]Show bottom horizontal menu {1=YES,0=NO}
$_THEME_CFG['show_bottom_horizontal_menu'] = 1;
#[it]Mostra sottomenu nelle sezioni che contengono sottosezioni  {1=SI,0=NO}
#[en]Show submenu in sections that have subsections {1=YES,0=NO}
$_THEME_CFG['show_subsections_in_section'] = 1;
#[it]Mostra le icone delle sezioni {1=SI,0=NO}
#[en]Show section icons {1=YES,0=NO}
$_THEME_CFG['show_icons'] = 1;
#[it]Massima grandezza delle icone (in px,predefinito=32)
#[en]Maximum size of the icons (in px, default=32)
$_THEME_CFG['max_size_icons'] = 32;
#[it]Colore body
#[en]Body color
$_THEME_CFG['bodycolor'] = ""; //{color}
#[it]URL Immagine di sfondo
#[en]URL Background image
$_THEME_CFG['backimage'] = ""; //{image}
#[it]Background image repeat {=,no-repeat=no-repeat, repeat=repeat, repeat-x=repeat-x, repeat-y=repeat-y}
#[en]Background image repeat {=,no-repeat=no-repeat, repeat=repeat, repeat-x=repeat-x, repeat-y=repeat-y}
$_THEME_CFG['backimage_repeat'] = "";
#[it]Background image css attachment {=,fixed=fixed,scroll=scroll}
#[en]Background image css attachment {=,fixed=fixed,scroll=scroll}
$_THEME_CFG['backimage_attachment'] = "";
#[it]Utilizza immagine di sfondo a pagina intera {1=SI,0=NO}
#[en]Use full page background image {1=YES,0=NO}
$_THEME_CFG['full_page_backimage'] = 0;
#[it]Colore colonna centrale
#[en]Center column color
$_THEME_CFG['center_column_color'] = ""; //{color}
#[it]Colore background colonna sinistra
#[en]Left column background color
$_THEME_CFG['left_column_color'] = ""; //{color}
#[it]Colore background colonna destra
#[en]Right column background color
$_THEME_CFG['right_column_color'] = ""; //{color}
#[it]Allinea le news in orizzontale (ancora non implementato) {1=SI,0=NO}
#[en]Align news horizontally (not yet implemented) {1=YES,0=NO}
$_THEME_CFG['align_news_horizontal'] = 0;
#[it]Colore bordo del forum (ancora non implementato)
#[en]Forum border color (not yet implemented)
$_THEME_CFG['forumborder'] = "00ff11"; //{color}
#[it]Colore di sfondo del forum (ancora non implementato)
#[en]Forum background color (not yet implemented)
$_THEME_CFG['forumback'] = "bcdbba"; //{color}
#[it]URL gif animato durante caricamento Ajax 
#[en]URL animated gif during Ajax loading
$_THEME_CFG['ajax_gif'] = "themes/glorioso/images/ajax/ui-anim_basic_16x16.gif"; //{image}
#[it]Titolo nella sezione superiore centrale della pagina
#[en]Title in the upper central section of the page
$_THEME_CFG['top_title'] = "Flatnux Site powered by Glorioso Theme";
#[it]URL immagine logo nella sezione superiore sinistra della pagina
#[en]URL logo image the upper left section of the page
$_THEME_CFG['top_logo'] = "images/pagetop/logo-glorioso.png"; //{image}
#[it]URL immagine nella sezione superiore centrale della pagina
#[en]URL image in the upper central section of the page
$_THEME_CFG['top_pic'] = "images/pagetop/logo-glorioso.png"; //{image}

/* Librerie Javascript e API PHP */

#[it]Voglio utilizzare Google JSApi (richiede una chiave; altrimenti le librerie js selezionate verranno caricate dal repository di Google) {1=SI,0=NO}
#[en]I want to use Google JSApi (requires a key; otherwise the js libraries will be loaded from Google's repository) {1=YES,0=NO}
$_THEME_CFG['use_jsapi'] = 0;
#[it]chiave GOOGLE JSAPI (richiede un account Google, permette di utilizzare poi i vari API di Google) OTTIENI UNA CHIAVE: http://code.google.com/apis/ajaxsearch/signup.html DOCUMENTAZIONE: http://code.google.com/apis/ajax/documentation/
#[en]GOOGLE JSAPI key (requires a Google account, lets you use the different Google API's) OBTAIN A KEY: http://code.google.com/apis/ajaxsearch/signup.html DOCUMENTATION: http://code.google.com/apis/ajax/documentation/
$_THEME_CFG['jsapi_key'] = "";
#[it]Voglio caricare jQuery (predefinito SI'):  {1=SI,0=NO}
#[en]I would like to load jQuery (default YES):  {1=YES,0=NO}
$_THEME_CFG['use_jquery'] = 1;
#[it]Voglio caricare jQuery UI completo (predefinito SI'):  {1=SI,0=NO}
#[en]I would like to load full jQuery UI (default YES):    {1=YES,0=NO}
$_THEME_CFG['use_jqueryui'] = 1;

// this one is not implemented in the theme!
#[it]Voglio caricare jQuery UI locale senza Tabs (predefinito NO):    {1=SI,0=NO}
#[en]I would like to load local jQuery UI without Tabs (default NO): {1=YES,0=NO}
$_THEME_CFG['use_jqueryui_lcl'] = 0;

#[it]Tema jQuery UI predefinito da caricare dal repository google (predefinito 'redmond') {}
#[en]jQuery UI default theme to load from the google repository (default 'redmond') {}
$_THEME_CFG['jqueryui_default'] = "redmond";
#[it]Voglio usare Google Webfont Api   {1=SI,0=NO}
#[en]I would like to use Google Webfont Api  {1=YES,0=NO}
$_THEME_CFG['use_webfont'] = 1;

// this one is not implemented in the theme!
#[it]Voglio caricare jQuery Tools completo (attenzione: jqTools Tabs va in conflitto con jQueryUI Tabs, perciò solo se no jQueryUI; predefinito = NO)     {1=SI,0=NO}
#[en]I would like to load complete jQuery Tools (attention: jqTools Tabs conflicts with jQueryUI Tabs, so only if no jQuery UI; default = NO)          {1=YES,0=NO}
$_THEME_CFG['use_jqtools'] = 0;

#[it]Voglio caricare jQuery Tools locale (jqTools senza Tabs, ok con jQueryUI completo; predefinito = SI')  {1=SI,0=NO}
#[en]I would like to load local jQuery Tools (jqTools without Tabs, goes well with full jQuery UI; default = YES)  {1=YES,0=NO}
$_THEME_CFG['use_jqtools_lcl'] = 1;
#[it]Stringa dei fonts che si vuole caricare attraverso Google Font API (consultare il Google Font Directory http://code.google.com/webfonts) 
#[en]String of the fonts that you want to load from the Google Font API (see the Google Font Directory http://code.google.com/webfonts)    
$_THEME_CFG['googlefonts'] = "";
#[it]Voglio caricare Prototype     {1=SI,0=NO}
#[en]I would like to load Prototype {1=YES,0=NO}
$_THEME_CFG['use_prototype'] = 0;
#[it]Voglio caricare script.aculo.us (richiede prototype)   {1=SI,0=NO}
#[en]I would like to load script.aculo.us (requires prototype)  {1=YES,0=NO}
$_THEME_CFG['use_scriptaculous'] = 0;
#[it]Voglio caricare MooTools  {1=SI,0=NO}
#[en]I would like to load MooTools  {1=YES,0=NO}
$_THEME_CFG['use_mootools'] = 0;
#[it]Voglio caricare Dojo   {1=SI,0=NO}
#[en]I would like to load Dojo  {1=YES,0=NO}
$_THEME_CFG['use_dojo'] = 0;
#[it]Voglio caricare SWFObject   {1=SI,0=NO}
#[en]I would like to load SWFObject  {1=YES,0=NO}
$_THEME_CFG['use_swfobject'] = 1;
#[it]Voglio caricare Yahoo! User Interface Library (YUI)   {1=SI,0=NO}
#[en]I would like to load Yahoo! User Interface Library (YUI) {1=YES,0=NO}
$_THEME_CFG['use_yui'] = 0;
#[it]Voglio caricare Ext Core  {1=SI,0=NO}
#[en]I would like to load Ext Core  {1=YES,0=NO}
$_THEME_CFG['use_extcore'] = 0;
#[it]Voglio caricare Chrome Frame    {1=SI,0=NO}
#[en]I would like to load Chrome Frame   {1=YES,0=NO}
$_THEME_CFG['use_chromeframe'] = 0;
#[it]Voglio utilizzare 1pixelout audio player    {1=SI,0=NO}
#[en]I would like to use the 1pixelout audio player   {1=YES,0=NO}
$_THEME_CFG['use_1pixeloutaudioplayer'] = 1;
#[it]Voglio !!! disabilitare !!! webtoolkit MD5 - attenzione che serve per maggiore sicurezza (predefinito = NO!)  {1=SI,0=NO}
#[en]I would like !!! to disable !!! webtoolkit MD5 - caution it is necessary for greater security (default = NO!))  {1=YES,0=NO}
$_THEME_CFG['notuse_webtoolkitMD5'] = 0;

/* Google Analytics */

#[it]Voglio usare Google Analytics   {1=SI,0=NO}
#[en]I would like to use Google Analytics  {1=YES,0=NO}
$_THEME_CFG['use_gan'] = 0;
#[it]Google Analytics Account
#[en]Google Analytics Account
$_THEME_CFG['gan_account'] = "";

/* Google Calendar */

#[it]Google Calendar Feed ("http://www.google.com/calendar/feeds/GOOGLEUSERNAME%40gmail.com/public/basic")
#[en]Google Calendar Feed ("http://www.google.com/calendar/feeds/GOOGLEUSERNAME%40gmail.com/public/basic")
$_THEME_CFG['gcal_feed'] = "";
#[it]Se vuoi poter scrivere eventi al Calendario Google, inserisci qui username del Google Account
#[en]If you want to be able to write events to your Google Calendar, pur your Google Account username here
$_THEME_CFG['gaccount_user'] = "";
#[it]Se vuoi poter scrivere eventi al Calendario Google, inserisci qui password del Google Account
#[en]If you want to be able to write events to your Google Calendar, pur your Google Account password here
$_THEME_CFG['gaccount_pass'] = "";

/* Funzionalità Google Friend Connect */

#[it]Voglio usare Google Friend Connect   {1=SI,0=NO}
#[en]I would like to use Google Friend Connect  {1=YES,0=NO}
$_THEME_CFG['use_gfc'] = 0;
#[it]Google Friend Connect Site ID
#[en]ID Google Friend Connect Site
$_THEME_CFG['gfc_site'] = "";
#[it]Google Friend Connect Social Gadget ID ("div-###########")
#[en]Google Friend Connect Social Gadget ID ("div-###########")
$_THEME_CFG['gfc_social'] = "";

/* Facebook Connect */

#[it]Voglio usare Facebook Connect   {1=SI,0=NO}
#[en]I would like to use Facebook Connect  {1=YES,0=NO}
$_THEME_CFG['use_fb'] = 0;
#[it]Chiave API di Facebook Connect (Bisogna creare una nuova applicazione qui: http://www.facebook.com/#!/developers/createapp.php)
#[en]Facebook Connect API key (You must create a new application here: http://www.facebook.com/#!/developers/createapp.php)
$_THEME_CFG['fb_api_key'] = "";
#[it]Codice segreto applicazione Facebook
#[en]Facebook Connect application secret code
$_THEME_CFG['fb_secret'] = "";
#[it]ID Applicazione Facebook
#[en]Facebook Application ID
$_THEME_CFG['fb_app_id'] = "";
#[it]Se vuoi collegare le funzionalità di facebook connect sul tuo sito con un tuo profilo facebook o un tuo gruppo di facebook inserisci qui l'ID:
#[en]If you want to link the facebook connect functionality of your site with a facebook profile or a group that you have administrative rights for, insert the ID here:
$_THEME_CFG['fb_gid'] = "";

/* Orkut */

#[it]Voglio usare Orkut Connect   {1=SI,0=NO}
#[en]I would like to use Orkut Connect  {1=YES,0=NO}
$_THEME_CFG['use_orkut'] = 0;
#[it]Chiave API di Orkut
#[en]Orkut API key
$_THEME_CFG['orkut_key'] = "";
#[it]Codice segreto applicazione Orkut
#[en]Orkut application secret code
$_THEME_CFG['orkut_secret'] = "";

/* Hi5 */

#[it]Voglio usare Hi5 Connect   {1=SI,0=NO}
#[en]I would like to use Hi5 Connect  {1=YES,0=NO}
$_THEME_CFG['use_hi5'] = 0;
#[it]Chiave API di Hi5
#[en]Hi5 API key
$_THEME_CFG['hi5_key'] = "";
#[it]Codice segreto applicazione Hi5
#[en]Hi5 application secret code
$_THEME_CFG['hi5_secret'] = "";

/* MySpace */

#[it]Voglio usare MySpace Connect   {1=SI,0=NO}
#[en]I would like to use MySpace Connect  {1=YES,0=NO}
$_THEME_CFG['use_myspace'] = 0;
#[it]Chiave API di MySpace
#[en]MySpace API key
$_THEME_CFG['myspace_key'] = "";
#[it]Codice segreto applicazione MySpace
#[en]MySpace application secret code
$_THEME_CFG['myspace_secret'] = "";

/* Netlog */

#[it]Voglio usare Netlog Connect   {1=SI,0=NO}
#[en]I would like to use Netlog Connect  {1=YES,0=NO}
$_THEME_CFG['use_netlog'] = 0;
#[it]Chiave API di Orkut
#[en]Orkut API key
$_THEME_CFG['netlog_key'] = "";
#[it]Codice segreto applicazione Orkut
#[en]Orkut application secret code
$_THEME_CFG['netlog_secret'] = "";

/* iGoogle / Gmail */

#[it]Voglio usare iGoogle / Gmail Connect (registrare tuo dominio qui:https://www.google.com/accounts/ManageDomains)   {1=SI,0=NO}
#[en]I would like to use iGoogle / Gmail Connect (register your domain here:https://www.google.com/accounts/ManageDomains) {1=YES,0=NO}
$_THEME_CFG['use_google'] = 0;
#[it]Chiave API di iGoogle - Gmail
#[en]iGoogle - Gmail API key
$_THEME_CFG['google_key'] = "";
#[it]Codice segreto applicazione iGoogle - Gmail
#[en]iGoogle - Gmail application secret code
$_THEME_CFG['google_secret'] = "";

/* Partuza */

#[it]Voglio usare Partuza Connect   {1=SI,0=NO}
#[en]I would like to use Partuza Connect  {1=YES,0=NO}
$_THEME_CFG['use_partuza'] = 0;
#[it]Chiave API di Partuza
#[en]Partuza API key
$_THEME_CFG['partuza_key'] = "";
#[it]Codice segreto applicazione Partuza
#[en]Partuza application secret code
$_THEME_CFG['partuza_secret'] = "";

/* Plaxo */

#[it]Voglio usare Plaxo Connect   {1=SI,0=NO}
#[en]I would like to use Plaxo Connect  {1=YES,0=NO}
$_THEME_CFG['use_plaxo'] = 0;
#[it]Chiave API di Plaxo
#[en]Plaxo API key
$_THEME_CFG['plaxo_key'] = "";
#[it]Codice segreto applicazione Plaxo
#[en]Plaxo application secret code
$_THEME_CFG['plaxo_secret'] = "";

?>