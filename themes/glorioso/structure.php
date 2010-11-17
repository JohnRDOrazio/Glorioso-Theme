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
<div id="pagetop" class="top_colmask top_threecol">
			<?php echo local_to_abs("themes/$theme/top.php");
			global $_FN;
			if (isadmin() && $_FN['fneditmode']!=0)
				echo "<span class=\"flatnukeadmin\"><a href=\"index.php?opindex=modcont&amp;file=themes/$theme/top.html\" >"._MODIFICA."</a></span>";
			?>
</div>
<div id="centercontentwrapper" style="clear:both;padding-left:<?php echo $_THEME_CFG['centercolleftmarg'];?>px;padding-right:<?php echo $_THEME_CFG['centercolrightmarg'];?>px;">
<!-- Column 3 start --> 
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
<!-- Column 3 end --> 
<!-- Column 1 start --> 
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
<!-- Column 1 end --> 
<!-- Column 2 start --> 
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
<!-- Column 2 end --> 
</div>
<?php
include("themes/".$_FN['theme']."/footer.php");
if ($_THEME_CFG['use_fb']==1){
  echo "
  <div id=\"fb-root\"></div>
  <script type=\"text/javascript\" src=\"http://connect.facebook.net/it_IT/all.js\"></script>
  <!-- Render facebook XFBML -->
  <script type=\"text/javascript\">
    FB.init({appId: \"{$_THEME_CFG['fb_app_id']}\", status: true, cookie: true, xfbml: true});
    /*
    FB.Event.subscribe('auth.sessionChange', function(response) {
      if (response.session) {
        // A user has logged in, and a new cookie has been saved
      } else {
        // The user has logged out, and the cookie has been cleared
      }
    });
    */
  </script>";
}
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
     'view-params':{\"scope\":\"SITE\",\"allowAnonymousPost\":\"true\",\"features\":\"video,comment\",\"showWall\":\"true\"} },skin);
  </script>";
}
if($_THEME_CFG['full_page_backimage']==1){ //echo "</div>";
 }
echo "<div id='tooltip'></div>";
echo "</body></html>";
?>