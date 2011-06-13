<?php 

global $_FN,$_THEME_CFG;

$path = preg_replace("/themes\/glorioso/","",dirname(__FILE__));
set_include_path(get_include_path() . PATH_SEPARATOR . $path );

require_once 'include/flatnux.php';
if(!isadmin()){
  header("Location: ../../index.php");
  exit();
}
if(!file_exists("themes/glorioso/firstinstall")){ die("Theme already installed!"); }
if(!file_exists("themes/glorioso/tracksave.php")){
  $fd = fopen("themes/glorioso/tracksave.php",'w') or die('Cannot create file');
  $data = "<"."?php ";
  $data .= "if(!isset($"."saved)||!is_array($"."saved)){ $"."saved = Array(); } \n";
  $data .= "$"."saved['step1'] = false; \n";
  $data .= "$"."saved['step2'] = false; \n";
  $data .= "$"."saved['step3'] = false; \n";
  $data .= "$"."saved['step4'] = false; \n";
  $data .= "$"."saved['step5'] = false; \n";
  $data .= "$"."saved['step6'] = false; \n";
  $data.="?".">";
  fwrite($fd,$data);
  fclose($fd);
  require_once "themes/glorioso/tracksave.php";
}
else{ require_once "themes/glorioso/tracksave.php"; }

require_once "themes/glorioso/config.php";
$default = $_THEME_CFG;

$files = glob("themes/glorioso/config.php*.bak*");
if(count($files) > 0 && $files[0]!=""){
  if(count($files)>1){ 
    natsort($files);
    $files = array_reverse($files);
  }
  $bakfile = $files[0]; 
} 
// requiring the bakfile will overwrite all theme_cfg values
if(isset($bakfile)){ 
  require_once $bakfile ; 
}  

// for each step, use the most recent saved values up to the previous step, and not the backed up values
// In fact after a save, the corresponding keys in the "default" array no longer represent the default values but the newly saved values...
if(!isset($_GET["step"])||isset($_GET["step"])&&$_GET["step"]>=1&&$saved["step1"]){    //for every step after step 1, load the 5 values from step 1  
  $_THEME_CFG["invertpagetop"] = $default["invertpagetop"];
  $_THEME_CFG["rightcolwidth"] = $default["rightcolwidth"];
  $_THEME_CFG["leftcolwidth"] = $default["leftcolwidth"];
  $_THEME_CFG["showblocksright"] = $default["showblocksright"];
  $_THEME_CFG["showblocksleft"] = $default["showblocksleft"];
}
if(isset($_GET["step"])&&$_GET["step"]>=2&&$saved["step2"]){    //for every step after step 2, load the 7 values from step 2
  $_THEME_CFG["showmenuleft"] = $default["showmenuleft"];
  $_THEME_CFG["showmenuright"] = $default["showmenuright"];
  $_THEME_CFG["show_top_horizontal_menu"] = $default["show_top_horizontal_menu"];
  $_THEME_CFG["show_bottom_horizontal_menu"] = $default["show_bottom_horizontal_menu"];
  $_THEME_CFG["show_subsections_in_section"] = $default["show_subsections_in_section"];
  $_THEME_CFG["show_icons"] = $default["show_icons"];
  $_THEME_CFG["max_size_icons"] = $default["max_size_icons"];
}
if(isset($_GET["step"])&&$_GET["step"]>=3&&$saved["step3"]){    //for every step after step 3, load the 8 values from step 3
  $_THEME_CFG["bodycolor"] = $default["bodycolor"];
  $_THEME_CFG["center_column_color"] = $default["center_column_color"];
  $_THEME_CFG["right_column_color"] = $default["right_column_color"];
  $_THEME_CFG["left_column_color"] = $default["left_column_color"];
  $_THEME_CFG["full_page_backimage"] = $default["full_page_backimage"];
  //$temp = $_THEME_CFG["backimage"]; // delete this after testing!
  $_THEME_CFG["backimage"] = $default["backimage"];
  $_THEME_CFG["backimage_repeat"] = $default["backimage_repeat"];
  $_THEME_CFG["backimage_attachment"] = $default["backimage_attachment"];
}
if(isset($_GET["step"])&&$_GET["step"]>=4&&$saved["step4"]){    //for every step after step 4, load the 16 values from step 4
  $_THEME_CFG["use_jsapi"] = $default["use_jsapi"];
  $_THEME_CFG["jsapi_key"] = $default["jsapi_key"];
  $_THEME_CFG["use_jquery"] = $default["use_jquery"];
  $_THEME_CFG["use_jqueryui"] = $default["use_jqueryui"];
  $_THEME_CFG["jqueryui_default"] = $default["jqueryui_default"];
  $_THEME_CFG["use_jqtools_lcl"] = $default["use_jqtools_lcl"];
  $_THEME_CFG["use_prototype"] = $default["use_prototype"];
  $_THEME_CFG["use_scriptaculous"] = $default["use_scriptaculous"];
  $_THEME_CFG["use_mootools"] = $default["use_mootools"];
  $_THEME_CFG["use_dojo"] = $default["use_dojo"];
  $_THEME_CFG["use_swfobject"] = $default["use_swfobject"];
  $_THEME_CFG["use_yui"] = $default["use_yui"];
  $_THEME_CFG["use_extcore"] = $default["use_extcore"];
  $_THEME_CFG["use_chromeframe"] = $default["use_chromeframe"];
  $_THEME_CFG["use_1pixeloutaudioplayer"] = $default["use_1pixeloutaudioplayer"];
  $_THEME_CFG["notuse_webtoolkitMD5"] = $default["notuse_webtoolkitMD5"];
}
if(isset($_GET["step"])&&$_GET["step"]>=5&&$saved["step5"]){    //7
  $_THEME_CFG["use_webfont"] = $default["use_webfont"];
  $_THEME_CFG["googlefonts"] = $default["googlefonts"];
  $_THEME_CFG["use_gan"] = $default["use_gan"];
  $_THEME_CFG["gan_account"] = $default["gan_account"];
  $_THEME_CFG["gcal_feed"] = $default["gcal_feed"];
  $_THEME_CFG["gaccount_user"] = $default["gaccount_user"];
  $_THEME_CFG["gaccount_pass"] = $default["gaccount_pass"];
}
if(isset($_GET["step"])&&$_GET["step"]>=6&&$saved["step6"]){    //20
  $_THEME_CFG["use_gfc"] = $default["use_gfc"];
  $_THEME_CFG["gfc_site"] = $default["gfc_site"];
  $_THEME_CFG["gfc_social"] = $default["gfc_social"];
  $_THEME_CFG["use_fb"] = $default["use_fb"];
  $_THEME_CFG["fb_api_key"] = $default["fb_api_key"];
  $_THEME_CFG["fb_secret"] = $default["fb_secret"];
  $_THEME_CFG["fb_app_id"] = $default["fb_app_id"];
  $_THEME_CFG["fb_gid"] = $default["fb_gid"];
  $_THEME_CFG["use_messlive"] = $default["use_messlive"];
  $_THEME_CFG["messlive_app_id"] = $default["messlive_app_id"];
  $_THEME_CFG["messlive_secret"] = $default["messlive_secret"];
  $_THEME_CFG["use_google"] = $default["use_google"];
  $_THEME_CFG["google_key"] = $default["google_key"];
  $_THEME_CFG["google_secret"] = $default["google_secret"];
  $_THEME_CFG["use_orkut"] = $default["use_orkut"];
  $_THEME_CFG["use_hi5"] = $default["use_hi5"];
  $_THEME_CFG["use_myspace"] = $default["use_myspace"];
  $_THEME_CFG["use_netlog"] = $default["use_netlog"];
  $_THEME_CFG["use_partuza"] = $default["use_partuza"];
  $_THEME_CFG["use_plaxo"] = $default["use_plaxo"];
}
// create background highlight for settings that are different than the default values (mostly because there are previously saved personalized settings)
// the highlighting indicates that the settings need to be saved in order to be kept, otherwise they will revert to the new default settings!
$hlite = "background-color:#FF99FF;";
  $invertpagetopstyle = ($_THEME_CFG["invertpagetop"] != $default["invertpagetop"]) ? $hlite : "";
  $rightcolwidthstyle = ($_THEME_CFG["rightcolwidth"] != $default["rightcolwidth"]) ? $hlite : "";
  $leftcolwidthstyle = ($_THEME_CFG["leftcolwidth"] != $default["leftcolwidth"]) ? $hlite : "";
  $showblocksrightstyle = ($_THEME_CFG["showblocksright"] != $default["showblocksright"]) ? $hlite : "";
  $showblocksleftstyle = ($_THEME_CFG["showblocksleft"] != $default["showblocksleft"]) ? $hlite : "";
  $showmenuleftstyle = ($_THEME_CFG["showmenuleft"] != $default["showmenuleft"]) ? $hlite : "";
  $showmenurightstyle = ($_THEME_CFG["showmenuright"] != $default["showmenuright"]) ? $hlite : "";
  $showtophorizontalmenustyle = ($_THEME_CFG["show_top_horizontal_menu"] != $default["show_top_horizontal_menu"]) ? $hlite : "";
  $showbottomhorizontalmenustyle = ($_THEME_CFG["show_bottom_horizontal_menu"] != $default["show_bottom_horizontal_menu"]) ? $hlite : "";
  $showsubsectionsinsectionstyle = ($_THEME_CFG["show_subsections_in_section"] != $default["show_subsections_in_section"]) ? $hlite : "";
  $showiconsstyle = ($_THEME_CFG["show_icons"] != $default["show_icons"]) ? $hlite : "";
  $maxsizeicons = ($_THEME_CFG["max_size_icons"] != $default["max_size_icons"]) ? $hlite : "";
  $bodycolorstyle = ($_THEME_CFG["bodycolor"] != $default["bodycolor"]) ? $hlite : "";
  $centercolumncolorstyle = ($_THEME_CFG["center_column_color"] != $default["center_column_color"]) ? $hlite : "";
  $rightcolumncolorstyle = ($_THEME_CFG["right_column_color"] != $default["right_column_color"]) ? $hlite : "";
  $leftcolumncolorstyle = ($_THEME_CFG["left_column_color"] != $default["left_column_color"]) ? $hlite : "";
  $fullpagebackimagestyle = ($_THEME_CFG["full_page_backimage"] != $default["full_page_backimage"]) ? $hlite : "";
  $backimagestyle = ($_THEME_CFG["backimage"] != $default["backimage"]) ? $hlite : "";
  $backimagerepeatstyle = ($_THEME_CFG["backimage_repeat"] != $default["backimage_repeat"]) ? $hlite : "";
  $backimageattachmentstyle = ($_THEME_CFG["backimage_attachment"] != $default["backimage_attachment"]) ? $hlite : "";
  $usejsapistyle = ($_THEME_CFG["use_jsapi"] != $default["use_jsapi"]) ? $hlite : "";
  $jsapikeystyle = ($_THEME_CFG["jsapi_key"] != $default["jsapi_key"]) ? $hlite : "";
  $usejquerystyle = ($_THEME_CFG["use_jquery"] != $default["use_jquery"]) ? $hlite : "";
  $usejqueryuistyle = ($_THEME_CFG["use_jqueryui"] != $default["use_jqueryui"]) ? $hlite : "";
  $jqueryuidefaultstyle = ($_THEME_CFG["jqueryui_default"] != $default["jqueryui_default"]) ? $hlite : "";
  $usejqtoolslclstyle = ($_THEME_CFG["use_jqtools_lcl"] != $default["use_jqtools_lcl"]) ? $hlite : "";
  $useprototypestyle = ($_THEME_CFG["use_prototype"] != $default["use_prototype"]) ? $hlite : "";
  $usescriptaculousstyle = ($_THEME_CFG["use_scriptaculous"] != $default["use_scriptaculous"]) ? $hlite : "";
  $usemootoolsstyle = ($_THEME_CFG["use_mootools"] != $default["use_mootools"]) ? $hlite : "";
  $usedojostyle = ($_THEME_CFG["use_dojo"] != $default["use_dojo"]) ? $hlite : "";
  $useswfobjectstyle = ($_THEME_CFG["use_swfobject"] != $default["use_swfobject"]) ? $hlite : "";
  $useyuistyle = ($_THEME_CFG["use_yui"] != $default["use_yui"]) ? $hlite : "";
  $useextcorestyle = ($_THEME_CFG["use_extcore"] != $default["use_extcore"]) ? $hlite : "";
  $usechromeframestyle = ($_THEME_CFG["use_chromeframe"] != $default["use_chromeframe"]) ? $hlite : "";
  $use1pixeloutaudioplayerstyle = ($_THEME_CFG["use_1pixeloutaudioplayer"] != $default["use_1pixeloutaudioplayer"]) ? $hlite : "";
  $notusewebtoolkitmd5style = ($_THEME_CFG["notuse_webtoolkitMD5"] != $default["notuse_webtoolkitMD5"]) ? $hlite : "";
  $usewebfontstyle = ($_THEME_CFG["use_webfont"] != $default["use_webfont"]) ? $hlite : "";
  $googlefontsstyle = ($_THEME_CFG["googlefonts"] != $default["googlefonts"]) ? $hlite : "";
  $useganstyle = ($_THEME_CFG["use_gan"] != $default["use_gan"]) ? $hlite : "";
  $ganaccountstyle = ($_THEME_CFG["gan_account"] != $default["gan_account"]) ? $hlite : "";
  $gcalfeedstyle = ($_THEME_CFG["gcal_feed"] != $default["gcal_feed"]) ? $hlite : "";
  $gaccountuserstyle = ($_THEME_CFG["gaccount_user"] != $default["gaccount_user"]) ? $hlite : "";
  $gaccountpassstyle = ($_THEME_CFG["gaccount_pass"] != $default["gaccount_pass"]) ? $hlite : "";
  $usegfcstyle = ($_THEME_CFG["use_gfc"] != $default["use_gfc"]) ? $hlite : "";
  $gfcsitestyle = ($_THEME_CFG["gfc_site"] != $default["gfc_site"]) ? $hlite : "";
  $gfcsocialstyle = ($_THEME_CFG["gfc_social"] != $default["gfc_social"]) ? $hlite : "";
  $usefbstyle = ($_THEME_CFG["use_fb"] != $default["use_fb"]) ? $hlite : "";
  $fbapikeystyle = ($_THEME_CFG["fb_api_key"] != $default["fb_api_key"]) ? $hlite : "";
  $fbsecretstyle = ($_THEME_CFG["fb_secret"] != $default["fb_secret"]) ? $hlite : "";
  $fbappidstyle = ($_THEME_CFG["fb_app_id"] != $default["fb_app_id"]) ? $hlite : "";
  $fbgidstyle = ($_THEME_CFG["fb_gid"] != $default["fb_gid"]) ? $hlite : "";
  $usemesslivestyle = ($_THEME_CFG["use_messlive"] != $default["use_messlive"]) ? $hlite : "";
  $messliveappidstyle = ($_THEME_CFG["messlive_app_id"] != $default["messlive_app_id"]) ? $hlite : "";
  $messlivesecretstyle = ($_THEME_CFG["messlive_secret"] != $default["messlive_secret"]) ? $hlite : "";
  $usegooglestyle = ($_THEME_CFG["use_google"] != $default["use_google"]) ? $hlite : "";
  $googlekeystyle = ($_THEME_CFG["google_key"] != $default["google_key"]) ? $hlite : "";
  $googlesecretstyle = ($_THEME_CFG["google_secret"] != $default["google_secret"]) ? $hlite : "";
  $useorkutstyle = ($_THEME_CFG["use_orkut"] != $default["use_orkut"]) ? $hlite : "";
  $usehi5style = ($_THEME_CFG["use_hi5"] != $default["use_hi5"]) ? $hlite : "";
  $usemyspacestyle = ($_THEME_CFG["use_myspace"] != $default["use_myspace"]) ? $hlite : "";
  $usenetlogstyle = ($_THEME_CFG["use_netlog"] != $default["use_netlog"]) ? $hlite : "";
  $usepartuzastyle = ($_THEME_CFG["use_partuza"] != $default["use_partuza"]) ? $hlite : "";
  $useplaxostyle = ($_THEME_CFG["use_plaxo"] != $default["use_plaxo"]) ? $hlite : "";

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Glorioso Theme Installation Wizard</title>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
<?php echo (isset($_GET["step"])&&$_GET["step"]==5) ? "<link id='googlefont' rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Aclonica'></link>" : ""; ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js"></script>
<script src="javascripts/jquery-tools-min.js"></script>
<!--[if IE]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<style>
  article, aside, figure, footer, header, hgroup, 
  menu, nav, section { display: block; }
  /* body { overflow: hidden; } */
  html { overflow: hidden; }
  #preview {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0px;
    left: 0px;
  }  
  #preview div {
    position: relative;
    border: solid 1px #000;
    text-align: center;
  }

  #pagetop{
    height: 20%;
  }
  #pagetop div {
    border: dotted 1px #060;
  }
  #userbar {
    width: 100%;
    height: 35%;
  }
<?php if(isset($_GET["step"])&&$_GET["step"]>1){ ?>
  #userbar img {
    position: absolute;
    top: 0px;
    left: 0px;
    width: 100%;
    height: 115%;
  }
  #userbar div {
    text-align: center;
    width: 200px;
    position: relative;
    top: 5px;
    left: 50%;
    margin-left: -100px;
    border: none;
  }
<?php } else { ?>
  #userbar img { display: none;  }
  #userbar div { text-align: center; border: none; }
<?php } ?>
  #top {
    width: 100%;
    height: 65%;
  }

  #themebody {
    padding-left: 202px;
    padding-right: 152px;
    height: 74%;
  }
  #themebody div {
    border: dotted 1px #060;
    text-align: center;
    float: left;
    position: relative;
    height: 100%;
  }
  #center {
    width: 100%;
  }
<?php if(isset($_GET["step"])&&$_GET["step"]>1){  ?>
  #center div {
    text-align: center;
    width: 100px;
    position: relative;
    top: 5px;
    left: 50%;
    margin-left: -50px;
    border: none;
  }
  #center img#topmenu {
    position: absolute;
    top: 0px;
    left: 0px;
    width: 100%;
<?php if($_THEME_CFG['show_top_horizontal_menu']==0){ ?>
    display: none;
<?php } ?>
  }
  #center img#bottommenu {
    position: absolute;
    bottom: 1px;
    left: 0px;
    width: 100%;
<?php if($_THEME_CFG['show_bottom_horizontal_menu']==0){ ?>
    display: none;
<?php } ?>
  }
  #center img#submenu {
    position: absolute;
    bottom: 70px;
    left: 0px;
    width: 100%;
<?php if($_THEME_CFG['show_subsections_in_section']==0){ ?>
    display: none;
<?php } ?>
  }
<?php  } ?>
  #left {
    width: 200px;
    margin-left:-100%;
    right: 204px;
    position: relative;
  }
<?php if(isset($_GET["step"])&&$_GET["step"]>1){ ?>
  #left img {
    position: absolute;
    top: 0px;
    left: 0px;
    width: 100%;
<?php if($_THEME_CFG['showmenuleft']==0) { ?>
    display: none;
<?php } ?>
  }
  #left div {
    text-align: center;
    width: 100px;
    position: relative;
    top: 5px;
    left: 50%;
    margin-left: -50px;
    border: none;
  }
<?php } ?>
  #right {
    width: 150px;
    margin-right:-100%;
    position: relative;
  }
<?php if(isset($_GET["step"])&&$_GET["step"]>1){ ?>
  #right img {
    position: absolute;
    top: 0px;
    left: 0px;
    width: 100%;
<?php if($_THEME_CFG['showmenuright']==0) { ?>
    display: none;
<?php } ?>
  }
  #right div {
    text-align: center;
    width: 100px;
    position: relative;
    top: 5px;
    left: 50%;
    margin-left: -50px;
    border: none;
  }
<?php } ?>
  #footer {
    height: 5%;
    border: solid 1px #000;
  }

  #install {
    text-align: center;
  }
  #contents {
    font-size: 0.8em;
  }
  tr.newsection td {
    border-top: 2px groove #f2e0cb;
    padding-top: 10px;
  }
  td {
    text-align: left;
    padding: 2px 10px;
    vertical-align: top;
    background-color: transparent;
  }
  td img {
    vertical-align: middle;
  }
  input[type=number] {
    width: 3.7em;
  }
  /* #themeswitcher.step3 { float: right; } */

  .jqtooltip {
  	background-color:#000;
  	border:1px solid #fff;
  	padding:10px 15px;
  	width:200px;
  	display:none;
  	color:#fff;
  	text-align:left;
  	font-size:12px;
    z-index:9999;	
  	/* outline radius for mozilla/firefox only */
  	-moz-box-shadow:0 0 10px #000;
  	-webkit-box-shadow:0 0 10px #000;
  }

  /***************************
  * CSS FOR BACKGROUND IMAGE *
  ***************************/
  img.bg {
  	/* Set rules to fill background */
  	min-height: 100%;
  	min-width: 1024px;
  
  	/* Set up proportionate scaling */
  	width: 100%;
  	height: auto;
  
  	/* Set up positioning */
  	position: fixed;
  	top: 0;
  	left: 0;
  	z-index: -1;
  }
  
  @media screen and (max-width: 1024px){
  	img.bg {
  		left: 50%;
  		margin-left: -512px; }
  }
</style>
<script type="text/javascript">

var injectcss = function(src){
  $("head").append("<link rel='stylesheet' type='text/css' href='"+src+"'></link>");
},
cleancsl = function(input){
  var splitted = input.split(',');
  var collector = {};
  for (i = 0; i < splitted.length; i++) {
     key = splitted[i].replace(/^\s*/, "").replace(/\s*$/, "");
     collector[key] = true;
  }
  var out = [];
  for (var key in collector) {
     out.push(key);
  }
  var output = out.join(',');
  return output;
}



/* STEP 1 FUNCTIONS ATTACHED TO EVENT BINDING */
function updatepreview(el){
  thisval = parseInt(el.value);
  val4 = thisval+4;
  val2 = thisval+2;
  if(el.id=="leftcolwidth"){
    $("#left").css({"width":thisval+"px","right":val4+"px"});
    $("#themebody").css({"padding-left":val2+"px"});
  }
  if(el.id=="rightcolwidth"){
    $("#right").css({"width":thisval+"px"});
    $("#themebody").css({"padding-right":val2+"px"});  
  }
}

function blocks(el){
  if(el.name=="conf_value1"){
    if(el.value==0){
      $("#left").css({"width":"0px","right":"0px"}).text("");
      $("#left").css({"border-top-width":"0px","border-right-width":"0px","border-bottom-width":"0px","border-left-width":"0px"});
      $("#themebody").css({"padding-left":"0px"});
      $("#leftcolwidth").attr("DISABLED","TRUE");
    }
    else{
      thisval = parseInt($("#leftcolwidth").val());
      val4 = thisval+4;
      val2 = thisval+2;
      $("#left").css({"width":thisval+"px","right":val4+"px"}).text("LEFT-COL");
      $("#left").css({"border-top-width":"1px","border-right-width":"1px","border-bottom-width":"1px","border-left-width":"1px"});
      $("#themebody").css({"padding-left":val2+"px"});
      $("#leftcolwidth").removeAttr("DISABLED");
    }
  }
  if(el.name=="conf_value3"){
    if(el.value==0){
      $("#right").css({"width":"0px"}).text("");
      $("#themebody").css({"padding-right":"0px"});
      $("#rightcolwidth").attr("DISABLED","TRUE");
    }
    else{
      thisval = parseInt($("#rightcolwidth").val());
      val4 = thisval+4;
      val2 = thisval+2;
      $("#right").css({"width":thisval+"px"}).text("RIGHT-COL");
      $("#themebody").css({"padding-right":val2+"px"});  
      $("#rightcolwidth").removeAttr("DISABLED");
    }
  }
}

function invert(el){
  if(el.value=="1"){
    $("#userbar").remove().insertAfter("#top");
  }
  if(el.value=="0"){
    $("#userbar").remove().insertBefore("#top");
  }
}
/* END OF STEP 1 FUNCTIONS ATTACHED TO EVENT BINDING */

/* STEP 2 FUNCTIONS ATTACHED TO EVENT BINDING */
function togglemenu(el){
  sw = el.value==1 ? true : false;
  myval = $(el).parents("tr").find("input:hidden[name^='conf_field']").val();
  if( myval=="$_THEME_CFG['showmenuleft']" ){ $("#left img").toggle(sw); }
  if( myval=="$_THEME_CFG['showmenuright']" ){ $("#right img").toggle(sw); }
  if( myval=="$_THEME_CFG['show_top_horizontal_menu']" ){ $("#center img#topmenu").toggle(sw); }
  if( myval=="$_THEME_CFG['show_bottom_horizontal_menu']" ){ $("#center img#bottommenu").toggle(sw); }
  if( myval=="$_THEME_CFG['show_subsections_in_section']" ){ $("#center img#submenu").toggle(sw); }
  if( myval=="$_THEME_CFG['show_icons']" ){ 
    if(el.value==0){
      $("#left img").add("#right img").attr("src","/themes/glorioso/images/install/verticalmenu2.png");
      $("#center img#topmenu").add("#center img#bottommenu").attr("src","/themes/glorioso/images/install/horizmenu2.png");
      $("input#maxwidthicons").attr("DISABLED","TRUE");      
    }  
    else{
      $("#left img").add("#right img").attr("src","/themes/glorioso/images/install/verticalmenu.png");
      $("#center img#topmenu").add("#center img#bottommenu").attr("src","/themes/glorioso/images/install/horizmenu.png");
      $("input#maxwidthicons").removeAttr("DISABLED"); 
    }
  }
  if( myval=="$_THEME_CFG['full_page_backimage']" ){ 
    if(el.value==0){
      $("body").css({"background-color":$("#bodycolor").val(),"background-image":"url("+$("#backimage").val()+")","background-repeat":$("#backimage-repeat").val(),"background-attachment":$("#backimage-attach").val()});
      if($("img.bg").length!=0){ $("img.bg").remove(); }
      if($("#backimage").val()!=""){ $("#backimage-repeat").add("#backimage-attach").attr("DISABLED",false); }
    }  
    else{
      $("body").css({"background-color":"#<?php echo $_THEME_CFG['bodycolor'] ?>","background-image":"","background-repeat":"","background-attachment":""});
      if($("img.bg").length==0){ $("<img class='bg' src='"+$("#backimage").val()+"'>").prependTo("body"); }
      $("#backimage-repeat").add("#backimage-attach").attr("DISABLED",true);
    }
  }
}

/* END OF STEP 2 FUNCTIONS ATTACHED TO EVENT BINDING */

/* STEP 3 FUNCTIONS ATTACHED TO EVENT BINDING */

/* END OF STEP 3 FUNCTIONS ATTACHED TO EVENT BINDING */

/* STEP 4 FUNCTIONS ATTACHED TO EVENT BINDING */

/* END OF STEP 4 FUNCTIONS ATTACHED TO EVENT BINDING */

  $(document).ready(function(){
    winheight = $(window).height()-75;
    $("#install").dialog({modal:true,width:"60%",maxHeight:winheight,autoOpen:false,open:function(){
      if( $(this).height() > winheight){ $(this).height(winheight); }
    } });
    $("#install").dialog("open");

    $("button:submit").click(function(){
      data = $(this).parents("form").serialize();
      href = $(this).parents("form").attr("action");
      //console.log("DATA: "+data);
      //console.log("HREF: "+href);
      $.post("/themes/glorioso/ajax/modconf.php",data,function(){
        step = parseInt(href.substring(href.length-1))-1;
        $.post("/themes/glorioso/ajax/tracksave.php","step="+step,function(response){
          //console.log("RESPONSE: "+response);
          location.href = href;
        });
      });
      return false;
    });
    
    if($("#themeswitcher").length!=0){ 
      if (typeof $.cookie == 'undefined' ){ 
        $.getScript("/themes/glorioso/javascripts/cookie.js");
      }
      timenow = new Date();
      timenow = timenow.getTime();
      if (typeof $.fn.themeswitcher == 'undefined' ){ 
        $.getScript("/themes/glorioso/javascripts/themeswitcher.js",function(){
          $('.step3').length!=0 ? $('.step3').themeswitcher() : "";          
          $('.step4').length!=0 ? $('.step4').themeswitcher({
              loadTheme: '<?php echo ucwords(str_replace("-"," ",$_THEME_CFG["jqueryui_default"])) ?>',
              cookieName: 'default_theme'+timenow,
              onSelect: function(nametheme){
                nametheme = nametheme.replace(" ","-").toLowerCase();
                $("#jqueryui_default").attr("value",nametheme);
              } 
            }) : "";                    
        });
      }
      else{
          $('.step3').length!=0 ? $(".step3").themeswitcher() : "";
          $('.step4').length!=0 ? $(".step4").themeswitcher({
            loadTheme: '<?php echo ucwords(str_replace("-"," ",$_THEME_CFG["jqueryui_default"])) ?>',
            cookieName: 'default_theme'+timenow,
            onSelect: function(nametheme){
              nametheme = nametheme.replace(" ","-").toLowerCase();
              $("#jqueryui_default").attr("value",nametheme);
            }
          }) : "";
      }
    }

    if($("#font-family").length!=0){
      $("#font-family").change(function(){
        src = $(this).val().replace(" ","+");
        txt = $(this).find("option:selected").text();
        if( $("link#googlefont").length==0 ){
          $("head").append("<link id='googlefont' rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family="+src+"'></link>");
        }
        else{ $("link#googlefont").attr("href","http://fonts.googleapis.com/css?family="+src); }        
        $("#googlefontpreview").css({"font-family":"'"+txt+"'"});        
      });
      $("#font-size").bind("input",function(){
        myval = $(this).val()+"px";
        pdn = 37 + ( 37 - $(this).val() );
        $("#googlefontpreview").css({"font-size":myval,"padding-top":pdn});
        
      });
    }

    $(".tooltip").tooltip({
        effect: 'fade',
        offset: [-2, 10],
        tipClass: 'jqtooltip',
        position: 'center right',
        opacity: 0.8
    }).dynamic();


/* TEST FOR BROWSER UI SUPPORT */
	var inputs = ['url', 'email', 'datetime', 'date', 'month', 'week', 'time', 'datetime-local', 'number', 'color', 'range'],
		input = document.createElement('input')
	    len = inputs.length,
	    uiSupport = {},
		i = 0,
		widgets = {
			date : function(elem) {
				elem.datepicker({
					beforeShow : function(input, inst) {
				    	inst.dpDiv.css({
							fontSize : '14px',
							marginLeft : 215,
							marginTop : -22
						});
				    }
				});
			},
			range : function(elem) {
				elem
					.after('<div></div><span class="slider-val">1500</span>')
					.next()
					.slider({
						value : 1500,
						min : 500,
						max : 4000,
						step : 500,
						slide: function(event, ui) {
							$(this).next().text(ui.value);
						}
					})
					.end()
					.remove();
			},
			altrange : function(elem) {
				elem
					.addClass('ui-slider')
					.after('<span class="slider-val">1500</span>')
					.change(function() {
						$(this).next().text($(this).val());
					});
			},
      color : function(elem) {
        elem.filter('#bodycolor').jPicker({images:{clientPath:"/themes/glorioso/images/jPicker/"}},function(){},function(color,context){
          var hex = color.val('hex');
          $('body').css({ backgroundColor: hex && '#' + hex || 'transparent' }); // prevent IE from throwing exception if hex is empty
        });
        elem.filter('#centercolor').jPicker({images:{clientPath:"/themes/glorioso/images/jPicker/"}},function(){},function(color,context){
          var hex = color.val('hex');
          $('#center').css({ backgroundColor: hex && '#' + hex || 'transparent' }); // prevent IE from throwing exception if hex is empty
        });
        elem.filter('#leftcolor').jPicker({images:{clientPath:"/themes/glorioso/images/jPicker/"}},function(){},function(color,context){
          var hex = color.val('hex');
          $('#left').css({ backgroundColor: hex && '#' + hex || 'transparent' }); // prevent IE from throwing exception if hex is empty
        });
        elem.filter('#rightcolor').jPicker({images:{clientPath:"/themes/glorioso/images/jPicker/"}},function(){},function(color,context){
          var hex = color.val('hex');
          $('#right').css({ backgroundColor: hex && '#' + hex || 'transparent' }); // prevent IE from throwing exception if hex is empty
        });
      }
		};

	for (; i < len; i++) {
		input.setAttribute('type', inputs[i]);

		if (input.type === 'text') {
			uiSupport[inputs[i]] = false;
		} else {
			input.value = 'testing';
			(input.value === 'testing') ? uiSupport[inputs[i]] = false : uiSupport[inputs[i]] = true;
		}
	}

	for (prop in uiSupport) {
    if (prop === 'range') {
			widgets[(uiSupport[prop] ? 'alt' : '') + prop]($('input[type=' + prop + ']', 'form'));
		}
		if (prop === 'date' && !uiSupport[prop]) {
			widgets[prop]($('input[type=' + prop + ']', 'form'));
		}
    if (prop === 'color') {
      curprop = prop;
      if(!uiSupport[curprop]){
        if ($.jPicker === undefined){
          injectcss("/themes/glorioso/css/jPicker.css");
          injectcss("/themes/glorioso/css/jPicker.min.css");
          $.getScript("/themes/glorioso/javascripts/jpicker.min.js",function(){
            widgets[curprop]($('input[type=' + curprop + ']', 'form'));            
          });
        }
      }
      else{
        $('input[type=' + curprop + ']', 'form').bind("input",function(){
          if( $(this).attr('id')=="bodycolor" ){ liveEl = $('body'); }
          if( $(this).attr('id')=="centercolor" ){ liveEl = $('#center'); }
          if( $(this).attr('id')=="leftcolor" ){ liveEl = $('#left'); }
          if( $(this).attr('id')=="rightcolor" ){ liveEl = $('#right'); }
          liveEl.css({backgroundColor: $(this).prop("value") || 'transparent' });
        });
      }
    }
	}

/* END TEST FOR BROWSER UI SUPPORT*/

  $("input:checkbox").click(function(){
    $(this).next("input:hidden").val($(this).prop("checked")===true ? 1 : 0);
  });
    
  });
</script>

</head>
<?php
  if(isset($_GET["step"])&&$_GET["step"]>2){
    $bodycolor = ($_THEME_CFG['bodycolor']!="") ? "background-color: #".$_THEME_CFG['bodycolor'].";" : "";
    $centercolor = ($_THEME_CFG['center_column_color']!="") ? "background-color: #".$_THEME_CFG['center_column_color'].";" : "";
    $leftcolor = ($_THEME_CFG['left_column_color']!="") ? "background-color: #".$_THEME_CFG['left_column_color'].";" : "";
    $rightcolor = ($_THEME_CFG['right_column_color']!="") ? "background-color: #".$_THEME_CFG['right_column_color'].";" : "";
    $backimage = $_THEME_CFG['backimage']!="" ? "background-image: url(".$_THEME_CFG['backimage'].");" : "";
    $backimagerepeat = $_THEME_CFG['backimage_repeat']!="" ? "background-repeat: ".$_THEME_CFG['backimage_repeat'].";" : "";
    $backimageattach = $_THEME_CFG['backimage_attachment']!="" ? "background-attachment: ".$_THEME_CFG['backimage_attachment'].";" : "";
    echo ($_THEME_CFG['full_page_backimage']==1) ? "<body style=\"{$bodycolor}\" ><img class=\"bg\" src=\"{$_THEME_CFG['backimage']}\" />" : "<body style=\"".$bodycolor.$backimage.$backimagerepeat.$backimageattach."\">";
  }
  else{
    echo "<body>";
  }
?>

  <div id="preview">
    <div id="pagetop">
      <?php
        echo $_THEME_CFG['invertpagetop']==0 ? "<div id=\"userbar\"><img src=\"images/install/userbar.png\"><div>USERBAR</div></div>\n<div id=\"top\">PAGETOP</div>\n" : "<div id=\"top\">PAGETOP</div>\n<div id=\"userbar\"><img src=\"images/install/userbar.png\"><div>USERBAR</div></div>\n";
      ?>      
    </div>
    <div id="themebody">
      <div id="center" style="<?php echo $centercolor ?>">
        <?php 
          $src = $_THEME_CFG['show_icons']==1 ? "images/install/horizmenu.png" : "images/install/horizmenu2.png";
          echo (isset($_GET['step'])&&$_GET['step']>1) ? "<img src=\"$src\" id=\"topmenu\"><img src=\"images/install/submenu.png\" id=\"submenu\"><img src=\"$src\" id=\"bottommenu\"><div>CENTER-COL</div>" : "CENTER-COL"; 
        ?>
      </div>
      <div id="left" style="<?php echo $leftcolor ?>">
        <?php 
          $src = $_THEME_CFG['show_icons']==1 ? "images/install/verticalmenu.png" : "images/install/verticalmenu2.png";
          echo (isset($_GET['step'])&&$_GET['step']>1) ? "<img src=\"$src\"><div>LEFT-COL</div>" : "LEFT-COL"; 
        ?>
      </div>
      <div id="right" style="<?php echo $rightcolor ?>">
        <?php 
          $src = $_THEME_CFG['show_icons']==1 ? "images/install/verticalmenu.png" : "images/install/verticalmenu2.png";
          echo (isset($_GET['step'])&&$_GET['step']>1) ? "<img src=\"$src\"><div>RIGHT-COL</div>" : "RIGHT-COL"; 
        ?>
      </div>
    </div>
    <div id="footer" style="clear:both;">FOOTER</div>
    <?php 
      $src = "images/install/gfcbar.jpg";
      $vis = $_THEME_CFG["gfc_social"]=="" ? "display:none;" : "";
      echo (isset($_GET['step'])&&$_GET['step']>5) ? "<img id=\"gfcsocial\" style=\"position:absolute;bottom:0px;left:0px;width:100%;$vis\" src=\"$src\">" : ""; 
    ?>
  </div>




<?php
if( !isset($_GET["step"]) || ((isset($_GET["step"])&&$_GET["step"]==1)) ){ 
?>
  <div id="install" title="Glorioso Theme Installation => Step 1: Please choose your layout">
    <div id="contents">
      <?php //echo $res; ?>
      <span>Welcome to the Glorioso Theme installation wizard. This installation process will walk you step by step through the configuration and customization of your theme.</span><hr>
      <form method="POST" action="/themes/glorioso/install.php?step=2">
        <input type="hidden" name="conf_file"	value="themes/glorioso/config.php">
        <table>
          <tr style="<?php echo $invertpagetopstyle ?>">
            <td><span>Invertire TOP &lt;-&gt; USERBAR: </span><input type="hidden" name="conf_field0" value="$_THEME_CFG['invertpagetop']"><input type="hidden" name="conf_value_old0" value=<?php echo $default['invertpagetop'] ?>></td>
            <td><label for="invertireyes">YES</label><input type="radio" id="invertireyes" name="conf_value0" value=1 <?php echo ($_THEME_CFG['invertpagetop']==1) ? "CHECKED" : "" ?> onclick="invert(this);">
                <label for="invertireno">NO</label><input type="radio" id="invertireno" name="conf_value0" value=0 <?php echo ($_THEME_CFG['invertpagetop']==0) ? "CHECKED" : "" ?> onclick="invert(this);"></td>
          </tr>
          <tr style="<?php echo $showblocksleftstyle ?>">
            <td><span>Visualizza i blocchi a sinistra: </span><input type="hidden" name="conf_field1" value="$_THEME_CFG['showblocksleft']"><input type="hidden" name="conf_value_old1" value=<?php echo $default['showblocksleft'] ?>></td>
            <td><label for="showblocksleftyes">YES</label><input type="radio" id="showblocksleftyes" name="conf_value1" value=1 <?php echo ($_THEME_CFG['showblocksleft']==1) ? "CHECKED" : "" ?> onclick="blocks(this);">
                <label for="showblocksleftno">NO</label><input type="radio" id="showblocksleftno" name="conf_value1" value=0 <?php echo ($_THEME_CFG['showblocksleft']==0) ? "CHECKED" : "" ?> onclick="blocks(this);"></td>
          </tr>
          <tr style="<?php echo $leftcolwidthstyle ?>">
            <td><label for="leftcolwidth">Larghezza colonna sinistra: </label><input type="hidden" name="conf_field2" value="$_THEME_CFG['leftcolwidth']"><input type="hidden" name="conf_value_old2" value=<?php echo $default['leftcolwidth'] ?>></td>
            <td><input type="number" id="leftcolwidth" name="conf_value2" min=0 value=<?php echo $_THEME_CFG['leftcolwidth'] ?> oninput="updatepreview(this);"> (in px)</td>
          </tr>
          <tr style="<?php echo $showblocksrightstyle ?>">
            <td><span>Visualizza i blocchi a destra: </span><input type="hidden" name="conf_field3" value="$_THEME_CFG['showblocksright']"><input type="hidden" name="conf_value_old3" value=<?php echo $default['showblocksright'] ?>></td>
            <td><label for="showblocksrightyes">YES</label><input type="radio" id="showblocksrightyes" name="conf_value3" value=1 <?php echo ($_THEME_CFG['showblocksright']==1) ? "CHECKED" : "" ?> onclick="blocks(this);">
                <label for="showblocksrightno">NO</label><input type="radio" id="showblocksrightno" name="conf_value3" value=0 <?php echo ($_THEME_CFG['showblocksright']==0) ? "CHECKED" : "" ?> onclick="blocks(this);"></td>
          </tr>
          <tr style="<?php echo $rightcolwidthstyle ?>">
            <td><label for="rightcolwidth">Larghezza colonna destra: </label><input type="hidden" name="conf_field4" value="$_THEME_CFG['rightcolwidth']"><input type="hidden" name="conf_value_old4" value=<?php echo $default['rightcolwidth'] ?>></td>
            <td><input type="number" id="rightcolwidth" name="conf_value4" min=0 value=<?php echo $_THEME_CFG['rightcolwidth'] ?> oninput="updatepreview(this);"> (in px)</td>
          </tr>
        </table>
        <input type="hidden" name="conf_num" value=5>
        <button type="submit">SAVE AND CONTINUE &#062;&#062;</button><button type="button" onclick="location.href='/themes/glorioso/install.php?step=2'">CONTINUE WITHOUT SAVING &#062;&#062;</button><button type="button" onclick="location.href='/index.php'">-QUIT-</button>
      </form>
    </div>
  </div>
<?php
}
else{
  switch($_GET["step"]){


    case 2: 
    ?>
      <div id="install" title="Glorioso Theme Installation => Step 2: Please choose your content disposition">
        <div id="contents">
          <span>Please choose the disposition of common page contents: </span><hr>
          <form method="POST" action="/themes/glorioso/install.php?step=3">
            <input type="hidden" name="conf_file"	value="themes/glorioso/config.php">
            <table>
              <tr style="<?php echo $showmenuleftstyle ?>">
                <td><span>Show vertical menu in left column: </span><input type="hidden" name="conf_field0" value="$_THEME_CFG['showmenuleft']"><input type="hidden" name="conf_value_old0" value=<?php echo $default['showmenuleft'] ?>></td>
                <td><label for="showmenuleftyes">YES</label><input type="radio" id="showmenuleftyes" name="conf_value0" value=1 <?php echo ($_THEME_CFG['showmenuleft']==1) ? "CHECKED" : "" ?> onclick="togglemenu(this);">
                    <label for="showmenuleftno">NO</label><input type="radio" id="showmenuleftno" name="conf_value0" value=0 <?php echo ($_THEME_CFG['showmenuleft']==0) ? "CHECKED" : "" ?> onclick="togglemenu(this);"></td>
              </tr>
              <tr style="<?php echo $showmenurightstyle ?>">
                <td><span>Show vertical menu in right column: </span><input type="hidden" name="conf_field1" value="$_THEME_CFG['showmenuright']"><input type="hidden" name="conf_value_old1" value=<?php echo $default['showblocksleft'] ?>></td>
                <td><label for="showmenurightyes">YES</label><input type="radio" id="showmenurightyes" name="conf_value1" value=1 <?php echo ($_THEME_CFG['showmenuright']==1) ? "CHECKED" : "" ?> onclick="togglemenu(this);">
                    <label for="showmenurightno">NO</label><input type="radio" id="showmenurightno" name="conf_value1" value=0 <?php echo ($_THEME_CFG['showmenuright']==0) ? "CHECKED" : "" ?> onclick="togglemenu(this);"></td>
              </tr>
              <tr style="<?php echo $showtophorizontalmenustyle ?>">
                <td><span>Show horizontal menu above sections: </span><input type="hidden" name="conf_field2" value="$_THEME_CFG['show_top_horizontal_menu']"><input type="hidden" name="conf_value_old2" value=<?php echo $default['show_top_horizontal_menu'] ?>></td>
                <td><label for="showmenutopyes">YES</label><input type="radio" id="showmenutopyes" name="conf_value2" value=1 <?php echo ($_THEME_CFG['show_top_horizontal_menu']==1) ? "CHECKED" : "" ?> onclick="togglemenu(this);">
                    <label for="showmenutopno">NO</label><input type="radio" id="showmenutopno" name="conf_value2" value=0 <?php echo ($_THEME_CFG['show_top_horizontal_menu']==0) ? "CHECKED" : "" ?> onclick="togglemenu(this);"></td>
              </tr>
              <tr style="<?php echo $showbottomhorizontalmenustyle ?>">
                <td><span>Show horizontal menu below sections: </span><input type="hidden" name="conf_field3" value="$_THEME_CFG['show_bottom_horizontal_menu']"><input type="hidden" name="conf_value_old3" value=<?php echo $default['show_bottom_horizontal_menu'] ?>></td>
                <td><label for="showmenubottomyes">YES</label><input type="radio" id="showmenubottomyes" name="conf_value3" value=1 <?php echo ($_THEME_CFG['show_bottom_horizontal_menu']==1) ? "CHECKED" : "" ?> onclick="togglemenu(this);">
                    <label for="showmenubottomno">NO</label><input type="radio" id="showmenubottomno" name="conf_value3" value=0 <?php echo ($_THEME_CFG['show_bottom_horizontal_menu']==0) ? "CHECKED" : "" ?> onclick="togglemenu(this);"></td>
              </tr>
              <tr style="<?php echo $showsubsectionsinsectionstyle ?>">
                <td><span>Show subsections in section: </span><input type="hidden" name="conf_field4" value="$_THEME_CFG['show_subsections_in_section']"><input type="hidden" name="conf_value_old4" value=<?php echo $default['show_subsections_in_section'] ?>></td>
                <td><label for="showsubsectionsyes">YES</label><input type="radio" id="showsubsectionsyes" name="conf_value4" value=1 <?php echo ($_THEME_CFG['show_subsections_in_section']==1) ? "CHECKED" : "" ?> onclick="togglemenu(this);">
                    <label for="showsubsectionsno">NO</label><input type="radio" id="showsubsectionsno" name="conf_value4" value=0 <?php echo ($_THEME_CFG['show_subsections_in_section']==0) ? "CHECKED" : "" ?> onclick="togglemenu(this);"></td>
              </tr>
              <tr style="<?php echo $showsectioniconsstyle ?>">
                <td><span>Show personalized section icons: </span><input type="hidden" name="conf_field5" value="$_THEME_CFG['show_icons']"><input type="hidden" name="conf_value_old5" value=<?php echo $default['show_icons'] ?>></td>
                <td><label for="showsectioniconsyes">YES</label><input type="radio" id="showsectioniconsyes" name="conf_value5" value=1 <?php echo ($_THEME_CFG['show_icons']==1) ? "CHECKED" : "" ?> onclick="togglemenu(this);">
                    <label for="showsectioniconsno">NO</label><input type="radio" id="showsectioniconsno" name="conf_value5" value=0 <?php echo ($_THEME_CFG['show_icons']==0) ? "CHECKED" : "" ?> onclick="togglemenu(this);"></td>
              </tr>
              <tr style="<?php echo $maxwidthiconsstyle ?>">
                <td><label for="maxwidthicons">Maximum icon display width: </label><input type="hidden" name="conf_field6" value="$_THEME_CFG['max_size_icons']"><input type="hidden" name="conf_value_old6" value=<?php echo $default['max_size_icons'] ?>></td>
                <td><input type="number" id="maxwidthicons" name="conf_value6" min=8 max=128 value=<?php echo $_THEME_CFG['max_size_icons'] ?> > (in px)</td>
              </tr>
            </table>
            <input type="hidden" name="conf_num" value=7>
            <button type="button" onclick="location.href='/themes/glorioso/install.php?step='+<?php echo $_GET['step']-1 ?>">&#060;&#060; GO BACK</button><button type="submit">SAVE AND CONTINUE &#062;&#062;</button><button type="button" onclick="location.href='/themes/glorioso/install.php?step='+<?php echo $_GET['step']+1 ?>">CONTINUE WITHOUT SAVING &#062;&#062;</button><button type="button" onclick="location.href='/index.php'">-QUIT-</button>
          </form>
        </div>
      </div>
<?php   break;    



    case 3: 
    ?>
      <div id="install" title="Glorioso Theme Installation => Step 3: Personalize background colors / images">
        <div id="contents">
          <span>The Glorioso Theme uses the jQuery-UI interface. This means that the Glorioso Theme offers a number of skins that the single user can choose from on the fly, thanks to the Themeswitcher Widget. Try it!</span><div id="themeswitcher" class="step3"></div><span>If however you would like to personalize some of the background colors or images on your site, you may do so here.</span><hr>
          <form method="POST" action="/themes/glorioso/install.php?step=4">
            <input type="hidden" name="conf_file"	value="themes/glorioso/config.php">
            <table>
              <tr style="<?php echo $bodycolorstyle ?>">
                <td><label for="bodycolor">Color of document body: </label><input type="hidden" name="conf_field0" value="$_THEME_CFG['bodycolor']"><input type="hidden" name="conf_value_old0" value=<?php echo $default['bodycolor'] ?>></td>
                <td><input type="color" id="bodycolor" name="conf_value0" value="<?php echo ($_THEME_CFG['bodycolor']!="" ? $_THEME_CFG['bodycolor'] : "") ?>"></td>
              </tr>
              <tr style="<?php echo $centercolumncolorstyle ?>">
                <td><label for="centercolor">Color of center column: </label><input type="hidden" name="conf_field5" value="$_THEME_CFG['center_column_color']"><input type="hidden" name="conf_value_old5" value=<?php echo $default['center_column_color'] ?>></td>
                <td><input type="color" id="centercolor" name="conf_value5" value="<?php echo ($_THEME_CFG['center_column_color']!="" ? $_THEME_CFG['center_column_color'] : "") ?>"></td>
              </tr>
              <tr style="<?php echo $leftcolumncolorstyle ?>">
                <td><label for="leftcolor">Color of left column: </label><input type="hidden" name="conf_field6" value="$_THEME_CFG['left_column_color']"><input type="hidden" name="conf_value_old6" value=<?php echo $default['left_column_color'] ?>></td>
                <td><input type="color" id="leftcolor" name="conf_value6" value="<?php echo ($_THEME_CFG['left_column_color']!="" ? $_THEME_CFG['left_column_color'] : "") ?>"></td>
              </tr>
              <tr style="<?php echo $rightcolumncolorstyle ?>">
                <td><label for="rightcolor">Color of right column: </label><input type="hidden" name="conf_field7" value="$_THEME_CFG['right_column_color']"><input type="hidden" name="conf_value_old7" value=<?php echo $default['right_column_color'] ?>></td>
                <td><input type="color" id="rightcolor" name="conf_value7" value="<?php echo ($_THEME_CFG['right_column_color']!="" ? $_THEME_CFG['right_column_color'] : "") ?>"></td>
              </tr>
              <tr class="newsection" style="<?php echo $backimagestyle ?>">
                <td><label for="backimage">Background image: </label><input type="hidden" name="conf_field1" value="$_THEME_CFG['backimage']"><input type="hidden" name="conf_value_old1" value=<?php echo $default['backimage'] ?>></td>
                <td><input type="text" name="conf_value1" id="backimage" value="<?php echo $_THEME_CFG['backimage'] ?>" placeholder="none" oninput="if($(this).val()!=''&&$('input[name=conf_value2]:checked').val()==0){$('select#backimage-repeat').add('select#backimage-attach').attr('DISABLED',false);$(this).next('img').attr('src',$(this).val());$('body').css({'background-image':'url('+$(this).val()+')'}) }else if($(this).val()!=''&&$('input[name=conf_value2]:checked').val()==1){$('select#backimage-repeat').add('select#backimage-attach').attr('DISABLED',true);$('img.bg').attr('src',$(this).val());$(this).next('img').attr('src',$(this).val());}else if($(this).val()==''&&$('input[name=conf_value2]:checked').val()==0){$('body').css({'background-image':''});$(this).next('img').attr('src','');$('select#backimage-repeat').add('select#backimage-attach').attr('DISABLED',true);}else if($(this).val()==''&&$('input[name=conf_value2]:checked').val()==1){$('img.bg').attr('src','');$(this).next('img').attr('src','');$('select#backimage-repeat').add('select#backimage-attach').attr('DISABLED',true);}" ><img src="<?php echo $_THEME_CFG['backimage'] ?>" alt="image" style="height:32px;border:1px solid #FFFFFF;">
                    <button type='button' onclick="window.open('/glorioso_filemanager.php?opener=backimage&filemanager_editor=yup&onchange=1&dir=themes/glorioso/images/&changeEl=bodybgimage','filemanager','toolbar=1,location=1,directories=0,status=0 ,menubar=0,scrollbars=1,resizable=1,width=640,height=480');">Scegli altro file</button></td>
              </tr>
              <tr style="<?php echo $fullpagebackimagestyle ?>">
                <td><span>Fullpage background image: </span><input type="hidden" name="conf_field2" value="$_THEME_CFG['full_page_backimage']"><input type="hidden" name="conf_value_old2" value=<?php echo $default['full_page_backimage'] ?>></td>
                <td><label for="fullpagebackimgyes">YES</label><input type="radio" id="fullpagebackimgyes" name="conf_value2" value=1 <?php echo ($_THEME_CFG['full_page_backimage']==1) ? "CHECKED" : "" ?> onclick="togglemenu(this);">
                    <label for="fullpagebackimgno">NO</label><input type="radio" id="fullpagebackimgno" name="conf_value2" value=0 <?php echo ($_THEME_CFG['full_page_backimage']==0) ? "CHECKED" : "" ?> onclick="togglemenu(this);"></td>
              </tr>
              <tr style="<?php echo $backimagerepeatstyle ?>">
                <td><label for="backimage-repeat">Background image repeat: </label><input type="hidden" name="conf_field3" value="$_THEME_CFG['backimage_repeat']"><input type="hidden" name="conf_value_old3" value=<?php echo $default['backimage_repeat'] ?>></td>
                <td><select id="backimage-repeat" name="conf_value3" <?php echo $_THEME_CFG['backimage']=="" ? "DISABLED" : "" ?> onchange="$('body').css({'background-repeat':$(this).val()});">
                      <option value="repeat" <?php echo $_THEME_CFG['backimage_repeat'] == "repeat" ? "SELECTED" : "" ?>>repeat</option>
                      <option value="no-repeat" <?php echo $_THEME_CFG['backimage_repeat'] == "no-repeat" ? "SELECTED" : "" ?>>no-repeat</option>
                      <option value="repeat-x" <?php echo $_THEME_CFG['backimage_repeat'] == "repeat-x" ? "SELECTED" : "" ?>>repeat-x</option>
                      <option value="repeat-y" <?php echo $_THEME_CFG['backimage_repeat'] == "repeat-y" ? "SELECTED" : "" ?>>repeat-y</option>
                    </select></td>
              </tr>
              <tr style="<?php echo $backimageattachmentstyle ?>">
                <td><label for="backimage-attach">Background image attachment: </label><input type="hidden" name="conf_field4" value="$_THEME_CFG['backimage_attachment']"><input type="hidden" name="conf_value_old4" value=<?php echo $default['backimage_attachment'] ?>></td>
                <td><select id="backimage-attach" name="conf_value4" <?php echo $_THEME_CFG['backimage']=="" ? "DISABLED" : "" ?> onchange="$('body').css({'background-attachment':$(this).val()})">
                      <option value="scroll" <?php echo $_THEME_CFG['backimage_attachment'] == "scroll" ? "SELECTED" : "" ?>>scroll</option>
                      <option value="fixed" <?php echo $_THEME_CFG['backimage_attachment'] == "fixed" ? "SELECTED" : "" ?>>fixed</option>
                    </select></td>
              </tr>
            </table>
            <input type="hidden" name="conf_num" value=8>
            <button type="button" onclick="location.href='/themes/glorioso/install.php?step='+<?php echo $_GET['step']-1 ?>">&#060;&#060; GO BACK</button><button type="submit">SAVE AND CONTINUE &#062;&#062;</button><button type="button" onclick="location.href='/themes/glorioso/install.php?step='+<?php echo $_GET['step']+1 ?>">CONTINUE WITHOUT SAVING &#062;&#062;</button><button type="button" onclick="location.href='/index.php'">-QUIT-</button>
          </form>
        </div>
      </div>
<?php   break;



    case 4: 
    ?>
      <div id="install" title="Glorioso Theme Installation => Step 4: Javascript / PHP libraries and API's">
        <div id="contents">
          <form method="POST" action="/themes/glorioso/install.php?step=5">
            <input type="hidden" name="conf_file"	value="themes/glorioso/config.php">
            <table>
              <tr style="<?php echo $usejsapistyle ?>">
                <td><span style="font-weight:bold;">Use Google jsAPI to load libraries: </span><br />
                    <span style="color:Green;font-style:italic;">More info: </span><a href="http://code.google.com/apis/loader/">http://code.google.com/apis/loader/</a><input type="hidden" name="conf_field0" value="$_THEME_CFG['use_jsapi']"><input type="hidden" name="conf_value_old0" value=<?php echo $default['use_jsapi'] ?>></td>
                <td><label for="usejsapiyes">YES</label><input type="radio" id="usejsapiyes" name="conf_value0" value=1 <?php echo ($_THEME_CFG['use_jsapi']==1) ? "CHECKED" : "" ?>>
                    <label for="usejsapino">NO</label><input type="radio" id="usejsapino" name="conf_value0" value=0 <?php echo ($_THEME_CFG['use_jsapi']==0) ? "CHECKED" : "" ?>>
                    <img class="tooltip" title="It is recommended to use the google javascript loader to load the required libraries (jquery, jquery-UI). This will require obtaining a key. The jsAPI loader gives great flexibility in loading different libraries and scripts, and opens the possibility for using further google services such as SEARCH, MAPS, etc." alt="?" src="images/question_mark.png">
                </td>
              </tr>
              <tr style="<?php echo $jsapikeystyle ?>">
                <td><label for="jsapikey" style="font-weight:bold;">Google jsAPI consumer key: </label><br />
                    <span style="color:Green;font-style:italic;">Obtain a key: </span><a href="http://code.google.com/apis/loader/signup.html">http://code.google.com/apis/loader/signup.html</a>
                    <input type="hidden" name="conf_field1" value="$_THEME_CFG['jsapi_key']"><input type="hidden" name="conf_value_old1" value=<?php echo $default['jsapi_key'] ?>></td>
                <td><textarea name="conf_value1" id="jsapikey" placeholder="jsapi key" cols="50" rows="3" style="font-family: Palatino Linotype;font-size: 0.8em;"><?php echo $_THEME_CFG['jsapi_key'] ?></textarea></td>
              </tr>
              <tr class="newsection" style="<?php echo $usejquerystyle ?>">
                <td><span>Load jQuery: </span><input type="hidden" name="conf_field2" value="$_THEME_CFG['use_jquery']"><input type="hidden" name="conf_value_old2" value=<?php echo $default['use_jquery'] ?>><a href="http://docs.jquery.com/Main_Page">Documentation</a></td>
                <td><label for="usejqueryyes">YES</label><input type="radio" id="usejsapiyes" name="conf_value2" value=1 READONLY <?php echo ($_THEME_CFG['use_jquery']==1) ? "CHECKED" : "" ?>>
                    <label for="usejqueryno">NO</label><input type="radio" id="usejsapino" name="conf_value2" value=0 READONLY <?php echo ($_THEME_CFG['use_jquery']==0) ? "CHECKED" : "" ?>>
                    <img class="tooltip" title="This theme is built completely on jquery for the time being. It would break if you turn off jquery." alt="?" src="images/question_mark.png">
                </td>
              </tr>
              <tr style="<?php echo $usejqueryuistyle ?>">
                <td><span>Load jQuery-UI: </span><input type="hidden" name="conf_field3" value="$_THEME_CFG['use_jqueryui']"><input type="hidden" name="conf_value_old3" value=<?php echo $default['use_jqueryui'] ?>><a href="http://jqueryui.com/demos/">Documentation</a></td>
                <td><label for="usejqueryuiyes">YES</label><input type="radio" id="usejqueryuiyes" name="conf_value3" value=1 READONLY <?php echo ($_THEME_CFG['use_jqueryui']==1) ? "CHECKED" : "" ?>>
                    <label for="usejqueryuino">NO</label><input type="radio" id="usejqueryuino" name="conf_value3" value=0 READONLY <?php echo ($_THEME_CFG['use_jqueryui']==0) ? "CHECKED" : "" ?>>
                    <img class="tooltip" title="This theme is built completely on jquery User Interface for the time being. It would break if you turn off jquery User Interface." alt="?" src="images/question_mark.png">
                </td>
              </tr>
              <tr style="<?php echo $jqueryuidefault ?>">
                <td><label for="jqueryui_default">Default jQuery-UI Theme: </label><input type="hidden" name="conf_field4" value="$_THEME_CFG['jqueryui_default']"><input type="hidden" name="conf_value_old4" value=<?php echo $default['jqueryui_default'] ?>></td>
                <td><div id="themeswitcher" class="step4"></div><input type="hidden" id="jqueryui_default" name="conf_value4" value="<?php echo $_THEME_CFG['jqueryui_default'] ?>"></td>
              </tr>
              <tr style="<?php echo $usejqtoolslclstyle ?>">
                <td><span>Load jQuery Tools (partial version from local): </span><input type="hidden" name="conf_field5" value="$_THEME_CFG['use_jqtools_lcl']"><input type="hidden" name="conf_value_old5" value=<?php echo $default['use_jqtools_lcl'] ?>></td>
                <td><label for="usejqtoolsyes">YES</label><input type="radio" id="usejqtoolsyes" name="conf_value5" value=1 <?php echo ($_THEME_CFG['use_jqtools_lcl']==1) ? "CHECKED" : "" ?>>
                    <label for="usejqtoolsno">NO</label><input type="radio" id="usejqtoolsno" name="conf_value5" value=0 <?php echo ($_THEME_CFG['use_jqtools_lcl']==0) ? "CHECKED" : "" ?>>
                    <img class="tooltip" title="The theme uses jquery Tools tooltips (you are reading from one right now, isn't it nice?). But this can be turned off if you prefer. It does not load the full jquery Tools library because the jquery Tools Tabs conflict with jquery-UI Tabs. You would have to load a partial version of jquery-UI in order to load the full jquery Tools library." alt="?" src="images/question_mark.png">
                </td>
              </tr>
              <tr class="newsection" style="<?php echo $useswfobjectstyle ?>">
                <td><label for="useswfobject">Load swfobject </label><input type="hidden" name="conf_field10" value="$_THEME_CFG['use_swfobject']"><input type="hidden" name="conf_value_old10" value=<?php echo $default['use_swfobject'] ?>><a href="http://code.google.com/p/swfobject/wiki/documentation">Documentation</a></td>
                <td><input type="checkbox" id="useswfobject" <?php echo ($_THEME_CFG['use_swfobject']==1) ? "CHECKED" : "" ?>><input type="hidden" name="conf_value10" value=<?php echo $_THEME_CFG['use_swfobject'] ?>><img class="tooltip" title="Easily embed flash content into your website using swfobject!" alt="?" src="images/question_mark.png"></td>
              </tr>
              <tr style="<?php echo $use1pixeloutaudioplayerstyle ?>">
                <td><label for="use1pixeloutaudioplayer">Load 1pixeloutaudioplayer </label><input type="hidden" name="conf_field14" value="$_THEME_CFG['use_1pixeloutaudioplayer']"><input type="hidden" name="conf_value_old14" value=<?php echo $default['use_1pixeloutaudioplayer'] ?>><a href="http://www.1pixelout.net/category/audio-player/">Crediti</a></td>
                <td><input type="checkbox" id="use1pixeloutaudioplayer" <?php echo ($_THEME_CFG['use_1pixeloutaudioplayer']==1) ? "CHECKED" : "" ?>><input type="hidden" name="conf_value14" value=<?php echo $_THEME_CFG['use_1pixeloutaudioplayer'] ?>><img class="tooltip" title="Easily embed audio content into your website using this dandy audio player!" alt="?" src="images/question_mark.png"></td>
              </tr>
              <tr style="<?php echo $usechromeframestyle ?>">
                <td><label for="usechromeframe">Load ChromeFrame </label><input type="hidden" name="conf_field13" value="$_THEME_CFG['use_chromeframe']"><input type="hidden" name="conf_value_old13" value=<?php echo $default['use_chromeframe'] ?>></td>
                <td><input type="checkbox" id="usechromeframe" <?php echo ($_THEME_CFG['use_chromeframe']==1) ? "CHECKED" : "" ?>><input type="hidden" name="conf_value13" value=<?php echo $_THEME_CFG['use_chromeframe'] ?>><img class="tooltip" title="Is your website not working correctly in Internet Explorer? Try turning on Google Chrome Frame! It will prompt your users to download the chromeframe component for internet explorer so that they will see your website as they would in the Google Chrome Browser!" alt="?" src="images/question_mark.png"></td>
              </tr>
              <tr class="newsection" style="<?php echo $useprototypestyle ?>">
                <td><label for="useprototype">Load Prototype </label><input type="hidden" name="conf_field6" value="$_THEME_CFG['use_prototype']"><input type="hidden" name="conf_value_old6" value=<?php echo $default['use_prototype'] ?>></td>
                <td><input type="checkbox" id="useprototype" <?php echo ($_THEME_CFG['use_prototype']==1) ? "CHECKED" : "" ?>><input type="hidden" name="conf_value6" value=<?php echo $_THEME_CFG['use_prototype'] ?>></td>
              </tr>
              <tr style="<?php echo $usescriptaculousstyle ?>">
                <td><label for="usescriptaculous">Load Scriptaculous </label><input type="hidden" name="conf_field7" value="$_THEME_CFG['use_scriptaculous']"><input type="hidden" name="conf_value_old7" value=<?php echo $default['use_scriptaculous'] ?>></td>
                <td><input type="checkbox" id="usescriptaculous" <?php echo ($_THEME_CFG['use_scriptaculous']==1) ? "CHECKED" : "" ?>><input type="hidden" name="conf_value7" value=<?php echo $_THEME_CFG['use_scriptaculous'] ?>></td>
              </tr>
              <tr style="<?php echo $usemootoolsstyle ?>">
                <td><label for="usemootools">Load Mootools </label><input type="hidden" name="conf_field8" value="$_THEME_CFG['use_mootools']"><input type="hidden" name="conf_value_old8" value=<?php echo $default['use_jsapi'] ?>></td>
                <td><input type="checkbox" id="usemootools" <?php echo ($_THEME_CFG['use_mootools']==1) ? "CHECKED" : "" ?>><input type="hidden" name="conf_value8" value=<?php echo $_THEME_CFG['use_prototype'] ?>></td>
              </tr>
              <tr style="<?php echo $usedojostyle ?>">
                <td><label for="usedojo">Load Dojo </label><input type="hidden" name="conf_field9" value="$_THEME_CFG['use_dojo']"><input type="hidden" name="conf_value_old9" value=<?php echo $default['use_dojo'] ?>></td>
                <td><input type="checkbox" id="usedojo" <?php echo ($_THEME_CFG['use_dojo']==1) ? "CHECKED" : "" ?>><input type="hidden" name="conf_value9" value=<?php echo $_THEME_CFG['use_dojo'] ?>></td>
              </tr>
              <tr style="<?php echo $useyuistyle ?>">
                <td><label for="useyui">Load YUI </label><input type="hidden" name="conf_field11" value="$_THEME_CFG['use_yui']"><input type="hidden" name="conf_value_old11" value=<?php echo $default['use_yui'] ?>></td>
                <td><input type="checkbox" id="useyui" <?php echo ($_THEME_CFG['use_yui']==1) ? "CHECKED" : "" ?>><input type="hidden" name="conf_value11" value=<?php echo $_THEME_CFG['use_yui'] ?>></td>
              </tr>
              <tr style="<?php echo $useextcorestyle ?>">
                <td><label for="useextcore">Load extcore </label><input type="hidden" name="conf_field12" value="$_THEME_CFG['use_extcore']"><input type="hidden" name="conf_value_old12" value=<?php echo $default['use_extcore'] ?>></td>
                <td><input type="checkbox" id="useextcore" <?php echo ($_THEME_CFG['use_extcore']==1) ? "CHECKED" : "" ?>><input type="hidden" name="conf_value12" value=<?php echo $_THEME_CFG['use_extcore'] ?>></td>
              </tr>
              <tr class="newsection" style="<?php echo $notusewebtoolkitmd5style ?>">
                <td><label for="notusewebtoolkitMD5" style="color:Red;">Disable webtoolkitMD5 (NOT RECOMMENDED!)</label><input type="hidden" name="conf_field15" value="$_THEME_CFG['notuse_webtoolkitMD5']"><input type="hidden" name="conf_value_old15" value=<?php echo $default['notuse_webtoolkitMD5'] ?>></td>
                <td><input type="checkbox" id="notusewebtoolkitMD5" <?php echo ($_THEME_CFG['notuse_webtoolkitMD5']==1) ? "CHECKED" : "" ?>><input type="hidden" name="conf_value15" value=<?php echo $_THEME_CFG['notuse_webtoolkitMD5'] ?>><img class="tooltip" title="It is not recommended to disable webtoolkit MD5. It permits you to encrypt any sensible data that you may need to transfer with javascript. The Glorioso Theme uses this component when using ajax requests to check if the current user has news administration permissions for adding events to the event calendar." alt="?" src="images/question_mark.png"></td>
              </tr>
            </table>
            <input type="hidden" name="conf_num" value=16>
            <button type="button" onclick="location.href='/themes/glorioso/install.php?step='+<?php echo $_GET['step']-1 ?>">&#060;&#060; GO BACK</button><button type="submit">SAVE AND CONTINUE &#062;&#062;</button><button type="button" onclick="location.href='/themes/glorioso/install.php?step='+<?php echo $_GET['step']+1 ?>">CONTINUE WITHOUT SAVING &#062;&#062;</button><button type="button" onclick="location.href='/index.php'">-QUIT-</button>
          </form>
        </div>
      </div>
<?php   break;


    case 5:
    ?> 
      <div id="install" title="Glorioso Theme Installation => Step 5: Google Services">
        <div id="contents">
          <form method="POST" action="/themes/glorioso/install.php?step=6">
            <input type="hidden" name="conf_file"	value="themes/glorioso/config.php">
            <table>
              <tr style="<?php echo $useganstyle ?>">
                <td><span style="font-weight:bold;">Use Google Analytics: </span><br />
                    <span style="color:Green;font-style:italic;">More info: </span><a href="http://www.google.com/intl/it/analytics/">http://www.google.com/intl/it/analytics/</a><input type="hidden" name="conf_field0" value="$default['use_gan']"><input type="hidden" name="conf_value_old0" value=<?php echo $_THEME_CFG['use_gan'] ?>></td>
                <td><label for="useganyes">YES</label><input type="radio" id="useganyes" name="conf_value0" value=1 <?php echo ($_THEME_CFG['use_gan']==1) ? "CHECKED" : "" ?>>
                    <label for="useganno">NO</label><input type="radio" id="useganno" name="conf_value0" value=0 <?php echo ($_THEME_CFG['use_gan']==0) ? "CHECKED" : "" ?>>
                    <img class="tooltip" title="It can be useful to activate google analytics from theme configuration, so that you can be sure that it will not be overwritten by Flatnux CMS updates or by theme updates." alt="?" src="images/question_mark.png">
                </td>
              </tr>
              <tr style="<?php echo $ganaccountstyle ?>">
                <td><label for="gan_account" style="font-weight:bold;">Google Analytics code associated with this domain: </label><br />
                    <span style="color:Green;font-style:italic;">Obtain a key: </span><a href="https://www.google.com/analytics/settings/add_profile">https://www.google.com/analytics/settings/add_profile</a>
                    <input type="hidden" name="conf_field1" value="$_THEME_CFG['gan_account']"><input type="hidden" name="conf_value_old1" value=<?php echo $default['gan_account'] ?>></td>
                <td><input type="text" name="conf_value1" id="gan_account" placeholder="UA-xxxxxxx-x" style="font-family: Palatino Linotype;font-size: 0.8em;" value="<?php echo $_THEME_CFG['gan_account'] ?>"></td>
              </tr>
              <tr class="newsection" style="<?php echo $gcalfeedstyle ?>">
                <td><label for="gcal_feed" style="font-weight:bold;">Use Google Calendar (semicolon separated list of Calendar feeds): </label>
                    <img class="tooltip" title="You can add Google Calendar feeds to the event calendar included on the theme userbar (arshaw's jquery fullcalendar)." alt="?" src="images/question_mark.png">
                    <br />
                    <span style="color:Green;font-style:italic;">More info: </span><a href="https://www.google.com/calendar/">https://www.google.com/calendar/</a>
                    <input type="hidden" name="conf_field2" value="$_THEME_CFG['gcal_feed']"><input type="hidden" name="conf_value_old2" value=<?php echo $default['gcal_feed'] ?>></td>
                <td><textarea name="conf_value2" id="gcal_feed" placeholder="e.g. http://www.google.com/calendar/feeds/GOOGLEUSERNAME%40gmail.com/public/basic" cols="50" rows="3" style="font-family: Palatino Linotype;font-size: 0.8em;"><?php echo $_THEME_CFG['gcal_feed'] ?></textarea></td>
              </tr>
              <tr style="<?php echo $gaccountuserstyle ?>">
                <td><label for="gaccount_user">Google Account Username: </label><input type="hidden" name="conf_field3" value="$_THEME_CFG['gaccount_user']"><input type="hidden" name="conf_value_old3" value=<?php echo $default['gaccount_user'] ?>></td>
                <td><input type="text" name="conf_value3" id="gaccount_user" value="<?php echo $_THEME_CFG['gaccount_user'] ?>" placeholder="username"><img class="tooltip" title="Q. Why does theme configuration ask for google username and password? &lt;br&gt; A. If you want to be able to write events to the google calendar that you want to associate to your application, the glorioso theme needs to have the credentials to do so. It will keep your information safe and will not use your google credentials on your behalf without your direct knowledge or intervention." alt="?" src="images/question_mark.png">
              </tr>
              <tr style="<?php echo $gaccountpassstyle ?>">
                <td><label for="gaccount_pass">Google Account Password: </label><input type="hidden" name="conf_field4" value="$_THEME_CFG['gaccount_pass']"><input type="hidden" name="conf_value_old4" value=<?php echo $default['gaccount_pass'] ?>></td>
                <td><input type="password" name="conf_value4" id="gaccount_pass" value="<?php echo $_THEME_CFG['gaccount_pass'] ?>" placeholder="password"><img class="tooltip" title="Q. Why does theme configuration ask for google username and password? &lt;br&gt; A. If you want to be able to write events to the google calendar that you want to associate to your application, the glorioso theme needs to have the credentials to do so. It will keep your information safe and will not use your google credentials on your behalf without your direct knowledge or intervention." alt="?" src="images/question_mark.png">
              </tr>
              <tr class="newsection" style="<?php echo $usewebfontstyle ?>">
                <td><span style="font-weight:bold;">Use Google Webfonts: </span><br />
                    <span style="color:Green;font-style:italic;">More info: </span><a href="http://www.google.com/webfonts">http://www.google.com/webfonts</a><input type="hidden" name="conf_field5" value="$_THEME_CFG['use_webfont']"><input type="hidden" name="conf_value_old5" value=<?php echo $default['use_webfont'] ?>></td>
                <td><label for="usewebfontsyes">YES</label><input type="radio" id="usewebfontsyes" name="conf_value5" value=1 <?php echo ($_THEME_CFG['use_webfont']==1) ? "CHECKED" : "" ?>>
                    <label for="usewebfontsno">NO</label><input type="radio" id="usewebfontsno" name="conf_value5" value=0 <?php echo ($_THEME_CFG['use_webfont']==0) ? "CHECKED" : "" ?>>
                    <img class="tooltip" title="Q. Ok so once I&#39;ve added open fonts to my theme configuration, how do I use them? &lt;br&gt; A. Easy. In your css, whether inline or from a stylesheet, you can apply the font to page elements using the &#39;font-family&#39; rule&#44; just as you would any other font&#58;&lt;br&gt;&#60;span style&#61;&#39;font&#45;family&#58;Aclonica&#59;&#39;&#62; &#46;test&#123;font&#45;family&#58;&#39;Aclonica&#39;&#125;" alt="?" src="images/question_mark.png">
                </td>
              </tr>
              <tr style="<?php echo $googlefontsstyle ?>">
                <td><label for="googlefonts">Comma separated string of fonts to load:</label><input type="hidden" name="conf_field6" value="$_THEME_CFG['googlefonts']"><input type="hidden" name="conf_value_old6" value="<?php echo $default['googlefonts'] ?>"></td>
                <td><textarea name="conf_value6" id="googlefonts" placeholder="e.g. IM Fell DW Pica SC,Reenie Beanie,Cabin Sketch:bold" cols="50" rows="3" style="font-family: Palatino Linotype;font-size: 0.8em;"><?php echo $_THEME_CFG['googlefonts'] ?></textarea></td>
              </tr>
              <tr>
                <td colspan=2 align="left" style="border:1px groove LightGreen;background-color:LightGreen;">
                  <div style="text-align:center;padding:10px;border-bottom:1px groove LightYellow;">
                    <div style="text-align:center;font-size:18px;font-weight:bold;">WEBFONTS PREVIEWER</div>
                    <span>FONT SIZE:</span><input id="font-size" type="number" value=24><span>px</span>
                    &nbsp; | &nbsp;
                    <button type="button" onclick=" 
                      if($('#googlefonts').val()==''){ $('#googlefonts').text( $('#font-family').val() ); }
                      else{ $('#googlefonts').text( $('#googlefonts').val() + ',' + $('#font-family').val() ); $('#googlefonts').text( cleancsl($('#googlefonts').val()) ); }
                      return false;">ADD &#8657;</button>
                  </div>
                  <div style="float:left;width:210px;">
                    <select id="font-family" size=25>
                      <option selected>Aclonica</option> 
                      <option value="Allan:bold">Allan</option> 
                      <option>Allerta</option> 
                      <option>Allerta Stencil</option> 
                      <option>Amaranth</option> 
                      <!-- <option value="Angkor&subset=khmer">Angkor</option> --> 
                      <option>Annie Use Your Telescope</option> 
                      <option>Anonymous Pro</option> 
                      <option>Anton</option> 
                      <option>Architects Daughter</option> 
                      <option>Arimo</option> 
                      <option>Artifika</option> 
                      <option>Arvo</option> 
                      <option>Astloch</option> 
                      <option>Bangers</option> 
                      <!-- <option value="Battambang&subset=khmer">Battambang</option> --> 
                      <!-- <option value="Bayon&subset=khmer">Bayon</option> --> 
                      <option>Bentham</option> 
                      <option>Bevan</option> 
                      <option>Bigshot One</option> 
                      <!-- <option value="Bokor&subset=khmer">Bokor</option> --> 
                      <option>Brawler</option> 
                      <option value="Buda:light">Buda</option> 
                      <option>Cabin</option> 
                      <option value="Cabin+Sketch:bold">Cabin Sketch</option> 
                      <option>Calligraffitti</option> 
                      <option>Candal</option> 
                      <option>Cantarell</option> 
                      <option>Cardo</option> 
                      <option>Carter One</option> 
                      <option>Caudex</option> 
                      <!-- <option value="Chenla&subset=khmer">Chenla</option> --> 
                      <option>Cherry Cream Soda</option> 
                      <option>Chewy</option>
                      <option value="Coda:800">Coda</option>
                      <option value="Coda+Caption:800">Coda Caption</option>
                      <option>Coming Soon</option>
                      <!-- <option value="Content&subset=khmer">Content</option> -->
                      <option>Copse</option>
                      <option value="Corben:bold">Corben</option>
                      <option>Cousine</option>
                      <option>Covered By Your Grace</option>
                      <option>Crafty Girls</option>
                      <option>Crimson Text</option>
                      <option>Crushed</option>
                      <option>Cuprum</option>
                      <option>Damion</option>
                      <option>Dancing Script</option>
                      <!-- <option value="Dangrek&subset=khmer">Dangrek</option> -->
                      <option>Dawning of a New Day</option>
                      <option>Didact Gothic</option>
                      <option>Droid Sans</option>
                      <option>Droid Sans Mono</option>
                      <option>Droid Serif</option>
                      <option>EB Garamond</option>
                      <option>Expletus Sans</option>
                      <option>Fontdiner Swanky</option>
                      <option>Francois One</option>
                      <!-- <option value="Freehand&subset=khmer">Freehand</option> -->
                      <!-- <option>GFS Didot</option> -->
                      <!-- <option>GFS Neohellenic</option> -->
                      <option>Geo</option>
                      <option>Goudy Bookletter 1911</option>
                      <option>Gruppo</option>
                      <!-- <option value="Hanuham&subset=khmer">Hanuman</option> -->
                      <option>Holtwood One SC</option>
                      <option>Homemade Apple</option>
                      <option>IM Fell DW Pica</option>
                      <option>IM Fell DW Pica SC</option>
                      <option>IM Fell Double Pica</option>
                      <option>IM Fell Double Pica SC</option>
                      <option>IM Fell English</option>
                      <option>IM Fell English SC</option>
                      <option>IM Fell French Canon</option>
                      <option>IM Fell French Canon SC</option>
                      <option>IM Fell Great Primer</option>
                      <option>IM Fell Great Primer SC</option>
                      <option>Inconsolata</option>
                      <option>Indie Flower</option>
                      <option>Irish Grover</option>
                      <option>Josefin Sans</option>
                      <option>Josefin Slab</option>
                      <option>Judson</option>
                      <option>Jura</option>
                      <option>Just Another Hand</option>
                      <option>Just Me Again Down Here</option>
                      <option>Kenia</option>
                      <!-- <option value="Khmer&subset=khmer">Khmer</option> -->
                      <!-- <option value="Koulen&subset=khmer">Koulen</option> -->
                      <option>Kranky</option>
                      <option>Kreon</option>
                      <option>Kristi</option>
                      <option>Lato</option>
                      <option>League Script</option>
                      <option>Lekton</option>
                      <option>Limelight</option>
                      <option>Lobster</option>
                      <option>Lora</option>
                      <option>Luckiest Guy</option>
                      <option>Maiden Orange</option>
                      <option>Mako</option>
                      <option>Maven Pro</option>
                      <option>Meddon</option>
                      <option>MedievalSharp</option>
                      <option>Megrim</option>
                      <option>Merriweather</option>
                      <!-- <option value="Metal&#38;subset&#61;khmer">Metal</option> -->
                      <option>Metrophobic</option>
                      <option>Michroma</option>
                      <option>Miltonian</option>
                      <option>Miltonian Tattoo</option>
                      <option>Molengo</option>
                      <option>Monofett</option>
                      <!-- <option value="Moul&subset=khmer">Moul</option> -->
                      <!-- <option value="Moulpali&subset=khmer">Moulpali</option> -->
                      <option>Mountains of Christmas</option>
                      <option>Muli</option>
                      <option>Neucha</option>
                      <option>Neuton</option>
                      <option>News Cycle</option>
                      <option>Nobile</option>
                      <option>Nova Cut</option>
                      <option>Nova Flat</option>
                      <option>Nova Mono</option>
                      <option>Nova Oval</option>
                      <option>Nova Round</option>
                      <option>Nova Script</option>
                      <option>Nova Slim</option>
                      <option>Nova Square</option>
                      <option>Nunito</option>
                      <option>OFL Sorts Mill Goudy TT</option>
                      <!-- <option value="Odor+Mean+Chey&subset=khmer">Odor Mean Chey</option> -->
                      <option>Old Standard TT</option>
                      <option>Open Sans</option>
                      <option value="Open+Sans+Condensed:light%2Clightitalic">Open Sans Condensed</option>
                      <option>Orbitron</option>
                      <option>Oswald</option>
                      <option>Over the Rainbow</option>
                      <option>PT Sans</option>
                      <option>PT Sans Caption</option>
                      <option>PT Sans Narrow</option>
                      <option>PT Serif</option>
                      <option>PT Serif Caption</option>
                      <option>Pacifico</option>
                      <option>Paytone One</option>
                      <option>Permanent Marker</option>
                      <option>Philosopher</option>
                      <option>Play</option>
                      <option>Playfair Display</option>
                      <option>Podkova</option>
                      <!-- <option value="Preahvihear&subset=khmer">Preahvihear</option> -->
                      <option>Puritan</option>
                      <option>Quattrocento</option>
                      <option>Quattrocento Sans</option>
                      <option>Radley</option>
                      <option value="Raleway:100">Raleway</option>
                      <option>Reenie Beanie</option>
                      <option>Rock Salt</option>
                      <option>Rokkitt</option>
                      <option>Ruslan Display</option>
                      <option>Schoolbell</option>
                      <option>Shanti</option>
                      <!-- <option value="Siemreap&subset=khmer">Siemreap</option> -->
                      <option>Sigmar One</option>
                      <option>Six Caps</option>
                      <option>Slackey</option>
                      <option>Smythe</option>
                      <option value="Sniglet:800">Sniglet</option>
                      <option>Special Elite</option>
                      <option>Sue Ellen Francisco</option>
                      <option>Sunshiney</option>
                      <!-- <option value="Suwannaphum&subset=khmer">Suwannaphum</option> -->
                      <option>Swanky and Moo Moo</option>
                      <option>Syncopate</option>
                      <option>Tangerine</option>
                      <!-- <option value="Taprom&subset=khmer">Taprom</option> -->
                      <option>Tenor Sans</option>
                      <option>Terminal Dosis Light</option>
                      <option>The Girl Next Door</option>
                      <option>Tinos</option>
                      <option>Ubuntu</option>
                      <option>Ultra</option>
                      <option value="UnifrakturCook:bold">UnifrakturCook</option>
                      <option>UnifrakturMaguntia</option>
                      <option>Unkempt</option>
                      <option>VT323</option>
                      <option>Vibur</option>
                      <option>Vollkorn</option>
                      <option>Waiting for the Sunrise</option>
                      <option>Wallpoet</option>
                      <option>Walter Turncoat</option>
                      <option>Wire One</option>
                      <option>Yanone Kaffeesatz</option>
                    </select>
                  </div>
                  <div id="googlefontpreview" ContentEditable style="float:left;width:414px;height:350px;text-align:center;padding: 50px 10px 10px 100px;font-family:Aclonica;font-size:24px;background-image:url(images/notebookpaper1-danaconditt.jpg);background-size:100%;background-origin:content;border:3px inset LightGray;">
                    The quick brown fox jumps over the lazy dog
                    <br><br>
                    Questo è un testo di esempio, per vedere l'anteprima dei fonts da scaricare sul tuo sito
                    <br><br>
                    Puoi scrivere qui! - You can write here!
                  </div>
                </td>
              </tr>
            </table>
            <input type="hidden" name="conf_num" value=7>
            <button type="button" onclick="location.href='/themes/glorioso/install.php?step='+<?php echo $_GET['step']-1 ?>">&#060;&#060; GO BACK</button><button type="submit">SAVE AND CONTINUE &#062;&#062;</button><button type="button" onclick="location.href='/themes/glorioso/install.php?step='+<?php echo $_GET['step']+1 ?>">CONTINUE WITHOUT SAVING &#062;&#062;</button><button type="button" onclick="location.href='/index.php'">-QUIT-</button>
          </form>
        </div>
      </div>
<?php    break;    



    case 6: 
    ?>
      <div id="install" title="Glorioso Theme Installation => Step 6: Open Social Environment">
        <div id="contents">
          <span>The Glorioso Theme opens the path of Flatnux towards opensocial environments. As a first step, it integrates single sign-on, so that a user can sign in to your website with his/her credentials from any social container such as facebook, twitter, yahoo, google friend connect... </span><br>
          <span>Unfortunately, Flatnux does not have any native social context, which makes it more difficult to integrate a full social experience from external social containers.</span><br>
          <hr>
          <form method="POST" action="/themes/glorioso/install.php?step=7">
            <input type="hidden" name="conf_file"	value="themes/glorioso/config.php">
            <table>
              <tr style="<?php echo $usegfcstyle ?>">
                <td><span style="font-weight:bold;">Use Google Friend Connect: </span><br />
                    <span style="color:Green;font-style:italic;">More info: </span><a href="http://www.google.com/friendconnect/">http://www.google.com/friendconnect/</a><input type="hidden" name="conf_field0" value="$_THEME_CFG['use_gfc']"><input type="hidden" name="conf_value_old0" value=<?php echo $default['use_gfc'] ?>></td>
                <td><label for="usegfcyes">YES</label><input type="radio" id="usegfcyes" name="conf_value0" value=1 <?php echo ($_THEME_CFG['use_gfc']==1) ? "CHECKED" : "" ?>>
                    <label for="usegfcno">NO</label><input type="radio" id="usegfcno" name="conf_value0" value=0 <?php echo ($_THEME_CFG['use_gfc']==0) ? "CHECKED" : "" ?>>
                    <img class="tooltip" title="This will load the javascript API (recommended)" alt="?" src="images/question_mark.png">
                </td>
              </tr>
              <tr style="<?php echo $gfcsitestyle ?>">
                <td><label for="gfcsite" style="font-weight:bold;">Google Friend Connect Site ID: </label><br />
                    <span style="color:Green;font-style:italic;">Obtain a key: </span><a href="http://www.google.com/friendconnect/admin/site/setup">http://www.google.com/friendconnect/admin/site/setup</a>
                    <input type="hidden" name="conf_field1" value="$_THEME_CFG['gfc_site']"><input type="hidden" name="conf_value_old1" value=<?php echo $default['gfc_site'] ?>></td>
                <td><input type="text" name="conf_value1" id="gfcsite" placeholder="xxxxxxxxxxxxxxxxxxxx" style="font-family: Palatino Linotype;font-size: 0.8em;" size=30 value="<?php echo $_THEME_CFG['gfc_site'] ?>"></td>
              </tr>
              <tr style="<?php echo $gfcsocialstyle ?>">
                <td><label for="gfcsocial" style="font-weight:bold;">Unique ID for Social Bar (empty for none): </label><br />
                    <input type="hidden" name="conf_field2" value="$_THEME_CFG['gfc_social']"><input type="hidden" name="conf_value_old2" value=<?php echo $default['gfc_social'] ?>></td>
                <td><input type="text" name="conf_value2" id="gfcsocial" placeholder="div-xxxxxxxxxxxxxxxxxxx" style="font-family: Palatino Linotype;font-size: 0.8em;" size=30 value="<?php echo $_THEME_CFG['gfc_social'] ?>" onchange="$(this).val()=='' ? $('#gfcsocial').hide() : $('#gfcsocial').show();"></td>
              </tr>
              <tr class="newsection" style="<?php echo $usefbstyle ?>">
                <td><span style="font-weight:bold;">Use Facebook Connect: </span><input type="hidden" name="conf_field3" value="$_THEME_CFG['use_fb']"><input type="hidden" name="conf_value_old3" value=<?php echo $default['use_fb'] ?>><a href="https://developers.facebook.com/docs/guides/web/">Documentation</a></td>
                <td><label for="usefbyes">YES</label><input type="radio" id="usefbyes" name="conf_value3" value=1 <?php echo ($_THEME_CFG['use_fb']==1) ? "CHECKED" : "" ?>>
                    <label for="usefbno">NO</label><input type="radio" id="usefbno" name="conf_value3" value=0 <?php echo ($_THEME_CFG['use_fb']==0) ? "CHECKED" : "" ?>>
                    <img class="tooltip" title="Facebook Connect will give even more social opportunity to your website, you will be able to create a feed wall on your website, let your users interact with your website with comments and likes, and let them interact with each other." alt="?" src="images/question_mark.png">
                </td>
              </tr>
              <tr style="<?php echo $fbappidstyle ?>">
                <td><label for="fbappid" style="font-weight:bold;">Facebook Application ID: </label><br />
                    <span style="color:Green;font-style:italic;">Create an application: </span><a href="https://www.facebook.com/developers/">https://www.facebook.com/developers/</a>
                    <input type="hidden" name="conf_field6" value="$_THEME_CFG['fb_app_id']"><input type="hidden" name="conf_value_old6" value=<?php echo $default['fb_app_id'] ?>></td>
                <td><input type="text" name="conf_value6" id="fbappid" placeholder="xxxxxxxxxxxxxxxxxxxx" style="font-family: Palatino Linotype;font-size: 0.8em;" size=20 value="<?php echo $_THEME_CFG['fb_app_id'] ?>"></td>
              </tr>
              <tr style="<?php echo $fbapikeystyle ?>">
                <td><label for="fbapikey" style="font-weight:bold;">Facebook Connect Consumer Key: </label><br />
                    <input type="hidden" name="conf_field4" value="$_THEME_CFG['fb_api_key']"><input type="hidden" name="conf_value_old4" value=<?php echo $default['fb_api_key'] ?>></td>
                <td><input type="text" name="conf_value4" id="fbapikey" placeholder="xxxxxxxxxxxxxxxxxxxx" style="font-family: Palatino Linotype;font-size: 0.8em;" size=40 value="<?php echo $_THEME_CFG['fb_api_key'] ?>"></td>
              </tr>
              <tr style="<?php echo $fbsecretstyle ?>">
                <td><label for="fbsecret" style="font-weight:bold;">Facebook Connect Consumer Secret: </label><br />
                    <input type="hidden" name="conf_field5" value="$_THEME_CFG['fb_secret']"><input type="hidden" name="conf_value_old5" value=<?php echo $default['fb_secret'] ?>></td>
                <td><input type="text" name="conf_value5" id="fbsecret" placeholder="xxxxxxxxxxxxxxxxxxxx" style="font-family: Palatino Linotype;font-size: 0.8em;" size=40 value="<?php echo $_THEME_CFG['fb_secret'] ?>"></td>
              </tr>
              <tr style="<?php echo $fbgidstyle ?>">
                <td><label for="fbgid" style="font-weight:bold;">Connect Site Wall to a Facebook Group Wall (indicate group ID): </label><br />
                    <input type="hidden" name="conf_field7" value="$_THEME_CFG['fb_gid']"><input type="hidden" name="conf_value_old7" value=<?php echo $default['fb_gid'] ?>></td>
                <td><input type="text" name="conf_value7" id="fbgid" placeholder="xxxxxxxxxxxxxxxxxxxx" style="font-family: Palatino Linotype;font-size: 0.8em;" size=20 value="<?php echo $_THEME_CFG['fb_gid'] ?>"></td>
              </tr>
              <tr class="newsection">
                <td colspan=2 style="text-align:center;font-style:italic;">Contenitori sociali ancora da implementare:</td>
              </tr>
              <tr class="newsection" style="<?php echo $usemesslivestyle ?>">
                <td>
                  <span style="font-weight:bold;">Use Messenger Live Connect: </span><input type="hidden" name="conf_field8" value="$_THEME_CFG['use_messlive']"><input type="hidden" name="conf_value_old8" value=<?php echo $default['use_messlive'] ?>><a href="http://msdn.microsoft.com/en-us/library/ff749458.aspx">Documentation</a>
                </td>
                <td><label for="usemessliveyes">YES</label><input type="radio" id="usemessliveyes" name="conf_value8" value=1 READONLY <?php echo ($_THEME_CFG['use_messlive']==1) ? "CHECKED" : "" ?>>
                    <label for="usemessliveno">NO</label><input type="radio" id="usemessliveno" name="conf_value8" value=0 READONLY <?php echo ($_THEME_CFG['use_messlive']==0) ? "CHECKED" : "" ?>>
                    <img class="tooltip" title="Messenger Live Connect will give even more social opportunity to your website, you will be able to create a feed wall on your website, let your users interact with your website with comments and likes, and let them interact with each other." alt="?" src="images/question_mark.png">
                </td>
              </tr>
              <tr style="<?php echo $messliveappidstyle ?>">
                <td><label for="messliveappid" style="font-weight:bold;">Messenger Live Application ID: </label><br />
                    <span style="color:Green;font-style:italic;">Obtain app ID: </span><a href="http://msdn.microsoft.com/en-us/library/ff751474.aspx">http://msdn.microsoft.com/en-us/library/ff751474.aspx</a>
                    <input type="hidden" name="conf_field9" value="$_THEME_CFG['messlive_app_id']"><input type="hidden" name="conf_value_old9" value=<?php echo $default['messlive_app_id'] ?>></td>
                <td><input type="text" name="conf_value9" id="messliveappid" placeholder="xxxxxxxxxxxxxxxxxxxx" style="font-family: Palatino Linotype;font-size: 0.8em;" size=20 value="<?php echo $_THEME_CFG['messlive_app_id'] ?>"></td>
              </tr>
              <tr style="<?php echo $messlivesecretstyle ?>">
                <td><label for="messlivesecret" style="font-weight:bold;">Messenger Live Consumer Secret: </label><br />
                    <span style="color:Green;font-style:italic;">Obtain consumer secret: </span><a href="http://msdn.microsoft.com/en-us/library/ff751474.aspx">http://msdn.microsoft.com/en-us/library/ff751474.aspx</a>
                    <input type="hidden" name="conf_field10" value="$_THEME_CFG['messlive_secret']"><input type="hidden" name="conf_value_old10" value=<?php echo $default['messlive_secret'] ?>></td>
                <td><input type="text" name="conf_value10" id="messlivesecret" placeholder="xxxxxxxxxxxxxxxxxxxx" style="font-family: Palatino Linotype;font-size: 0.8em;" size=40 value="<?php echo $_THEME_CFG['messlive_secret'] ?>"></td>
              </tr>
              <tr class="newsection" style="<?php echo $usegooglestyle ?>">
                <td><span style="font-weight:bold;">Use Google OpenID: </span><input type="hidden" name="conf_field11" value="$_THEME_CFG['use_google']"><input type="hidden" name="conf_value_old11" value=<?php echo $default['use_google'] ?>><a href="http://code.google.com/apis/accounts/docs/RegistrationForWebAppsAuto.html">Documentation</a>
                    <br>
                    <span style="color:Green;font-style:italic;">Register your Domain with Google: </span><a href="https://www.google.com/accounts/ManageDomains">https://www.google.com/accounts/ManageDomains</a>
                </td>
                <td><label for="usegoogleyes">YES</label><input type="radio" id="usegoogleyes" name="conf_value11" value=1 READONLY <?php echo ($_THEME_CFG['use_google']==1) ? "CHECKED" : "" ?>>
                    <label for="usegoogleno">NO</label><input type="radio" id="usegoogleno" name="conf_value11" value=0 READONLY <?php echo ($_THEME_CFG['use_google']==0) ? "CHECKED" : "" ?>>
                    <img class="tooltip" title="You can let your users use their google accounts to login to / register with your site. This doesn't have social aspects to it but will let your users use different google services on your website." alt="?" src="images/question_mark.png">
                </td>
              </tr>
              <tr style="<?php echo $googlekeystyle ?>">
                <td><label for="googlekey" style="font-weight:bold;">Domain registered with Google: </label><br />
                    <input type="hidden" name="conf_field12" value="$_THEME_CFG['google_key']"><input type="hidden" name="conf_value_old12" value=<?php echo $default['google_key'] ?>></td>
                <td><input type="text" name="conf_value12" id="googlekey" placeholder="<?php echo $_FN['siteurl'] ?>" style="font-family: Palatino Linotype;font-size: 0.8em;" size=30 value="<?php echo $_THEME_CFG['google_key'] ?>"></td>
              </tr>
              <tr style="<?php echo $googlesecretstyle ?>">
                <td><label for="googlesecret" style="font-weight:bold;">Google Consumer Secret for your Domain: </label><br />
                    <input type="hidden" name="conf_field13" value="$_THEME_CFG['google_secret']"><input type="hidden" name="conf_value_old13" value=<?php echo $default['google_secret'] ?>></td>
                <td><input type="text" name="conf_value13" id="googlesecret" placeholder="xxxxxxxxxxxxxxxxxxxx" style="font-family: Palatino Linotype;font-size: 0.8em;" size=30 value="<?php echo $_THEME_CFG['google_secret'] ?>"></td>
              </tr>
              <tr class="newsection" style="<?php echo $useorkutstyle ?>">
                <td><span style="font-weight:bold;">Use Orkut Connect: </span><input type="hidden" name="conf_field14" value="$_THEME_CFG['use_orkut']"><input type="hidden" name="conf_value_old15" value=<?php echo $default['use_orkut'] ?>><a href="http://www.orkut.com/html/en-US/developer.terms.html">Orkut Developer Terms of Service</a></td>
                <td><label for="useorkutyes">YES</label><input type="radio" id="usemessliveyes" name="conf_value14" value=1 READONLY <?php echo ($_THEME_CFG['use_orkut']==1) ? "CHECKED" : "" ?>>
                    <label for="useorkutno">NO</label><input type="radio" id="usemessliveno" name="conf_value14" value=0 READONLY <?php echo ($_THEME_CFG['use_orkut']==0) ? "CHECKED" : "" ?>>
                    <img class="tooltip" title="Orkut Connect will give even more social opportunity to your website, you will be able to let your users interact with your website with comments and likes, and let them interact with each other." alt="?" src="images/question_mark.png">
                </td>
              </tr>
              <tr class="newsection" style="<?php echo $usehi5style ?>">
                <td><span style="font-weight:bold;">Use hi5 Connect: </span><input type="hidden" name="conf_field15" value="$_THEME_CFG['use_hi5']"><input type="hidden" name="conf_value_old15" value=<?php echo $default['use_hi5'] ?>><a href="http://www.hi5networks.com/developer/getstarted.html">hi5 Developer</a></td>
                <td><label for="usehi5yes">YES</label><input type="radio" id="usehi5yes" name="conf_value15" value=1 READONLY <?php echo ($_THEME_CFG['use_hi5']==1) ? "CHECKED" : "" ?>>
                    <label for="usehi5no">NO</label><input type="radio" id="usehi5no" name="conf_value15" value=0 READONLY <?php echo ($_THEME_CFG['use_hi5']==0) ? "CHECKED" : "" ?>>
                    <img class="tooltip" title="hi5 Connect will give even more social opportunity to your website, you will be able to create a feed wall on your website, let your users interact with your website with comments and likes, and let them interact with each other." alt="?" src="images/question_mark.png">
                </td>
              </tr>
              <tr class="newsection" style="<?php echo $usemyspacestyle ?>">
                <td><span style="font-weight:bold;">Use mySpace Connect: </span><input type="hidden" name="conf_field16" value="$_THEME_CFG['use_myspace']"><input type="hidden" name="conf_value_old16" value=<?php echo $default['use_myspace'] ?>><a href="http://developer.myspace.com/wordpress/">mySpace Developer</a></td>
                <td><label for="usemyspaceyes">YES</label><input type="radio" id="usemyspaceyes" name="conf_value16" value=1 READONLY <?php echo ($_THEME_CFG['use_myspace']==1) ? "CHECKED" : "" ?>>
                    <label for="usemyspaceno">NO</label><input type="radio" id="usemyspaceno" name="conf_value16" value=0 READONLY <?php echo ($_THEME_CFG['use_myspace']==0) ? "CHECKED" : "" ?>>
                    <img class="tooltip" title="mySpace Connect will give even more social opportunity to your website, you will be able to create a feed wall on your website, let your users interact with your website with comments and likes, and let them interact with each other." alt="?" src="images/question_mark.png">
                </td>
              </tr>
              <tr class="newsection" style="<?php echo $usenetlogstyle ?>">
                <td><span style="font-weight:bold;">Use Netlog Connect: </span><input type="hidden" name="conf_field17" value="$_THEME_CFG['use_netlog']"><input type="hidden" name="conf_value_old17" value=<?php echo $default['use_netlog'] ?>><a href="http://en.netlog.com/go/developer">Documentation</a></td>
                <td><label for="usenetlogyes">YES</label><input type="radio" id="usenetlogyes" name="conf_value17" value=1 READONLY <?php echo ($_THEME_CFG['use_netlog']==1) ? "CHECKED" : "" ?>>
                    <label for="usenetlogno">NO</label><input type="radio" id="usenetlogno" name="conf_value17" value=0 READONLY <?php echo ($_THEME_CFG['use_netlog']==0) ? "CHECKED" : "" ?>>
                    <img class="tooltip" title="Netlog Connect will give even more social opportunity to your website, you will be able to create a feed wall on your website, let your users interact with your website with comments and likes, and let them interact with each other." alt="?" src="images/question_mark.png">
                </td>
              </tr>
              <tr class="newsection" style="<?php echo $usepartuzastyle ?>">
                <td><span style="font-weight:bold;">Use Partuza Connect: </span><input type="hidden" name="conf_field18" value="$_THEME_CFG['use_partuza']"><input type="hidden" name="conf_value_old18" value=<?php echo $default['use_partuza'] ?>><a href="http://www.developerfusion.com/project/64373/partuza/">Partuza Developer</a></td>
                <td><label for="usepartuzayes">YES</label><input type="radio" id="usepartuzayes" name="conf_value18" value=1 READONLY <?php echo ($_THEME_CFG['use_partuza']==1) ? "CHECKED" : "" ?>>
                    <label for="usepartuzano">NO</label><input type="radio" id="usepartuzano" name="conf_value18" value=0 READONLY <?php echo ($_THEME_CFG['use_partuza']==0) ? "CHECKED" : "" ?>>
                    <img class="tooltip" title="Partuza Connect will give even more social opportunity to your website, you will be able to create a feed wall on your website, let your users interact with your website with comments and likes, and let them interact with each other." alt="?" src="images/question_mark.png">
                </td>
              </tr>
              <tr class="newsection" style="<?php echo $useplaxostyle ?>">
                <td><span style="font-weight:bold;">Use Plaxo Connect: </span><input type="hidden" name="conf_field19" value="$_THEME_CFG['use_plaxo']"><input type="hidden" name="conf_value_old19" value=<?php echo $default['use_plaxo'] ?>><a href="http://www.plaxo.com/api">Documentation</a></td>
                <td><label for="useplaxoyes">YES</label><input type="radio" id="useplaxoyes" name="conf_value19" value=1 READONLY <?php echo ($_THEME_CFG['use_plaxo']==1) ? "CHECKED" : "" ?>>
                    <label for="useplaxono">NO</label><input type="radio" id="useplaxono" name="conf_value19" value=0 READONLY <?php echo ($_THEME_CFG['use_plaxo']==0) ? "CHECKED" : "" ?>>
                    <img class="tooltip" title="Plaxo Connect will give even more social opportunity to your website, you will be able to create a feed wall on your website, let your users interact with your website with comments and likes, and let them interact with each other." alt="?" src="images/question_mark.png">
                </td>
              </tr>
            </table>
            <input type="hidden" name="conf_num" value=20>
            <button type="button" onclick="location.href='/themes/glorioso/install.php?step='+<?php echo $_GET['step']-1 ?>">&#060;&#060; GO BACK</button><button type="submit">SAVE AND CONTINUE &#062;&#062;</button><button type="button" onclick="location.href='/themes/glorioso/install.php?step='+<?php echo $_GET['step']+1 ?>">CONTINUE WITHOUT SAVING &#062;&#062;</button><button type="button" onclick="location.href='/index.php'">-QUIT-</button>
          </form>
        </div>
      </div>
<?php   break;

    case 7:
      unlink("themes/glorioso/firstinstall");
      unlink("themes/glorioso/tracksave.php");
      foreach($files as $file){
        unlink($file);
      } 

?>
      <div id="install" title="Glorioso Theme Installation => Step 7: Congratulazioni">
        <div id="contents">
          <h1>Congratulazioni!</h1>
          <h2>Hai concluso l'installazione del tema Glorioso!</h2>
          <button type="button" onclick="location.href='<?php echo $_FN["siteurl"] ?>'">CONTINUE TO YOUR WEBSITE</button>
        </div>
      </div>

<?php   break;


  }
}
?>
</body>
</html>