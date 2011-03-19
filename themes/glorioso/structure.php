<?php

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
	echo "<body style=\"{$_THEME_CFG['bodycolor']}\" >";
	echo "<img class=\"bg\" src=\"{$_THEME_CFG['backimage']}\" />";
	//echo "<div id=\"body-content\">";
}
else{
	if($_THEME_CFG['backimage']!=""){ $_THEME_CFG['backimage']="background-image:url({$_THEME_CFG['backimage']});"; }
	if($_THEME_CFG['backimage_repeat']!=""){ $_THEME_CFG['backimage_repeat']="background-repeat:{$_THEME_CFG['backimage_repeat']};"; }
	if($_THEME_CFG['backimage_attachment']!=""){ $_THEME_CFG['backimage_attachment']="background-attachment:{$_THEME_CFG['backimage_attachment']};"; }
	echo "<body style=\"{$_THEME_CFG['bodycolor']}{$_THEME_CFG['backimage']}{$_THEME_CFG['backimage_repeat']}{$_THEME_CFG['backimage_attachment']}\" >";
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
    e.src = document.location.protocol + '//connect.facebook.net/"._FN_LANG."/all.js';
    e.async = true;
    document.getElementById('fb-root').appendChild(e);
  }());
</script>";
}

if ($_THEME_CFG['use_messlive']==1){
  echo "<div id=\"messlive-root\">
        <wl:app
          channel-url={WRAP_CHANNEL_URL}
          callback-url={WRAP_CALLBACK}
          client-id={WRAP_CLIENT_ID}
          scope=\"WL_Profiles.View,WL_Contacts.View\"
          onload=\"appLoaded\">
        </wl:app>  
        </div>
<script type=\"text/javascript\">
var dataContext,auth;

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
        listContacts();
        location.href = '?mod=login&opmod=profile';
    }
}

function signOutCompleted() {
    // Perform actions upon signing out.
    Sys.Debug.trace('Good-bye.');
    location.href = '?mod=login&op=logout';
}
// Load contacts and list them.
function listContacts() {
    var contactCollection;
    dataContext.loadAll(Microsoft.Live.DataType.contacts, function(args) {
        if (args.get_resultCode() !== Microsoft.Live.AsyncResultCode.success) {
            Sys.Debug.trace('listContacts: Error retrieving contacts. ' + args.get_error().message);
            return;
        }
        contactCollection = args.get_data();
        Sys.Debug.trace('listContacts: Successfully retrieved contacts: ' + contactCollection.get_length() + ' entries');
        // Contacts loaded. Show the displayname for each:
        for (var i = 0; i < contactCollection.get_length(); i++) {
            Sys.Debug.trace('listContacts: Contact ' + i + ': ' + contactCollection.get_item(i).get_formattedName());
        }
    })
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
  skin['DEFAULT_COMMENT_TEXT'] = '"._GFCBAR_COMMENT_TEXT."';
  skin['HEADER_TEXT'] = '"._GFCBAR_HEADER_TEXT."';
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