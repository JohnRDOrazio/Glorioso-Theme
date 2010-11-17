<?php
global $_FN,$_GFC,$_FB,$_THEME_CFG;
$logouturl = $_FN["self"]."?mod=login&amp;op=logout";
$loginurl = $_FN["self"]."?mod=login";
$urlregistrazione = $_FN["self"]."?mod=login&amp;op=vis_reg";
?>
<div style="clear:both;"></div>
<div id="toolbar-show"  class="fg-button fg-button-icon-left ui-corner-bottom" style="display:none;position:absolute;right:5px;top:68px;border:2px groove White;border-top:none;z-index:999999;"><span class="ui-icon ui-icon-arrowthickstop-1-s"></span>SHOW</div>
<!-- TOOLBAR WRAPPER -->
<div id="toolbar-wrapper">
<!-- PAGE WIDE TOOLBAR -->
<div id="top_toolbar" class="ui-widget-header ui-corner-all ui-helper-clearfix" style="margin:3px 0px;">
<!-- DIV UTENTE (LEFT DIV) -->
<div style="float:left;padding:5px;margin:2px;width:39%;border:1px inset White;">
	<!-- USER WELCOME -->
	<?php	
    /*********************** LOGGED IN USER ***********************/
		if ($_FN ['user'] !== "") { 
		/* Verifico a quali gruppi l'utente appartiene */
		$fndb = new XMLDatabase("fndatabase","misc");
		$query = "SELECT group FROM users WHERE username = '".$_FN['user']."'";
		$groups = $fndb->Query($query);
    /* SE E' INCLUSO IL SISTEMA DI MESSAGGI PRIVATI, VERIFICO PRESENZA DI MESSAGGI PRIVATI */
      // imposto il nome della sezione
      $MP_section=find_section("FlatMP");
      if($MP_section!=''){     
        // importo i file necessari
        include_once("sections/$MP_section/mp_config.php");
        include_once("sections/$MP_section/mp_functions.php");
        //include("config.php");
        // verifica l'esistenza della cartella mailboxes altrimenti la crea
        if (!file_exists($_FN['datadir']."/mailboxes"))
        	mkdir($_FN['datadir']."/mailboxes");
        // verifica l'esistenza della cartella dell'utente altrimenti la crea
        if (!file_exists($_FN['datadir']."/mailboxes/".$_FN['user']))
        	mp_first($_FN['user'],$_FN['admin']);
      }
		/* DO IL BENVENUTO */
		echo "<div style='float:left;'>"._BENVENUTO."<span id=\"span_username\"> ".$_FN['user']." </span>!</div>";
    // visualizzo i messaggi privati non letti	
    if($MP_section!=''){     
      if((user_can_view_section($MP_section))) {
      		switch ( mp_count($_FN['user']) ) {
            case 0:
              $mp_imgsrc = "images/mp/mail.png";
              break;
            case 1:
              $mp_imgsrc = "images/mp/mail1.png";
              break;
            case 2:
              $mp_imgsrc = "images/mp/mail2.png";
              break;
            case 3:
              $mp_imgsrc = "images/mp/mail3.png";
              break;
            case 4:
              $mp_imgsrc = "images/mp/mail4.png";
              break;
            case 5:
              $mp_imgsrc = "images/mp/mail5.png";
              break;
            case 6:
              $mp_imgsrc = "images/mp/mail6.png";
              break;
            case 7:
              $mp_imgsrc = "images/mp/mail7.png";
              break;
            case 8:                       
              $mp_imgsrc = "images/mp/mail8.png";
              break;
            case 9:
              $mp_imgsrc = "images/mp/mail9.png";
              break;
            case 10:
              $mp_imgsrc = "images/mp/mail10.png";
              break;
            case (mp_count($_FN['user']) > 10):
              $mp_imgsrc = "images/mp/mail10+.png";   
          }
      		echo "<div style='float:left;margin-left:15px;'><a href=\"index.php?mod=".$MP_section."\"><img id='MPimg' class='jqtooltip-dx' style='width:32px;' src=$mp_imgsrc title='"._MP." ".mp_count($_FN['user'])." "._NOREADMP."' /></a></div>";
          }
      else
      		echo _LOGINMP;
    } // END MP
?>
	<!-- LOGIN / LOGOUT, PROFILE, REGISTRATION BUTTONSET -->
	<div id="userdetails" style="float:right;" class="fg-buttonset fg-buttonset-single ui-helper-clearfix">
	<?php
      // profile button
			echo "<div id='userprofile' class='jqtooltip-dx fg-button fg-button-icon-left ui-state-default ui-priority-primary ui-corner-left' onclick='location.href=\"{$_FN['self']}?mod=login&amp;opmod=profile\"' title='"._VIEW_USERPROFILE."'>";      
      echo "<span class='ui-icon ui-icon-person'></span></div>";
	    //if logged in with facebook connect, show facebook logout (which also logs out of the site)
			if ($_FB['me']){ 
	?>
				<span id="fb_logout" class='jqtooltip-dx fg-button ui-state-default ui-priority-primary ui-corner-right' title='Esci sia da facebook che da questo sito' >
					<img id="fb_logout_image" src="/themes/glorioso/images/social/fb_logout_small.gif" alt="Connect" />
				</span>				
	<?php }
	    elseif ($_GFC['session']){
  ?>
				<span id="gfc_logout" class='jqtooltip-dx fg-button ui-state-default ui-priority-primary ui-corner-right' title='Esci sia da google friend connect che da questo sito' >
					<img src="/themes/glorioso/images/social/google_logo.png" alt="Connect" width=16 />
					Logout
				</span>
  <?php
      }
      //else if user is only logged into the site and not to facebook connect, show flatnux logout
      else {  ?>
		    	<div class='jqtooltip-dx fg-button fg-button-icon-left ui-state-default ui-state-active ui-priority-primary ui-corner-right' title='Esci da questo sito'><span class="ui-icon ui-icon-power"></span><a href="<?php echo $logouturl ?>"><?php echo _LOGOUT ?></a></div>
	<?php } ?>
	</div><!-- END USERDETAILS BUTTONSET -->
<?php
    echo "<div style='clear:both;'>";
    //-disegno la barra del livello ->
		$level = getlevel($_FN['user']);
			echo "<div id=\"USERPAN_LEVEL\" class=\"jqtooltip-dx\" title=\"".fn_i18n("_LEVEL") . " ". $level ."<br />Fai parte dei seguenti gruppi: ". $groups[0]['group'] ."\" style=\"float:left;text-align:center;margin:.2em 15px;vertical-align:middle;border:ridge 1px White;padding:0px 3px 3px 3px;\">";
			for ( $i = 0;$i < $level;$i++  )
				echo "<img  src=\"{$_FN['siteurl']}images/useronline/level_y.gif\" alt=\"level\" style=\"vertical-align:middle;\" />";
			for (;$i < 10;$i++  )
				echo "<img  src=\"{$_FN['siteurl']}images/useronline/level_n.gif\" alt=\"level\" style=\"vertical-align:middle;\" />";
			print "</div>";
		//-disegno la barra del livello -<
    echo "</div>";
}
/*********************** END LOGGED IN USER **********************/
/*********************** START NOT LOGGED IN *********************/
	else { 
		echo "<div style='float:left;'>"._BENVENUTO."<span id=\"span_username\"> Ospite </span>!</div>";
  ?>
  <div id="userlogin-wrapper" style="float:right;">
	    <div id="userlogin" class="ui-corner-all ui-state-default" style="position:absolute;margin-left:-210px;margin-top:-5px;width:200px;padding:5px;z-index:9998;">
        <div id="login-span-wrapper">
          <span id="login-span">LOGIN</span>
          <?php if ($_THEME_CFG['use_fb']==1){ ?>
          <img src="images/social/logo-facebook-small.png" width=16 style="margin-left:10px;" title="login con facebook connect" />
          <?php }
                if ($_THEME_CFG['use_gfc']==1){ ?>
          <img src="images/social/google_logo.png" width=16 style="margin-left:10px;" title="login con il tuo account google" />
          <?php } ?>
          <span style="float:right;" class="ui-icon ui-icon-carat-1-s"></span>
        </div>
        <div id="userlogin-dropdown" class="ui-corner-all" style="display:none;">
      	  <!-- link to site login page -->
          <div id='flatnuxlogin' class='jqtooltip-dx ui-corner-all' title='Entra in questo sito (ti potrai registrare se ancora non l&apos;hai fatto).' rel="<?php echo find_section('login')?>">
            <a href="<?php echo $loginurl ?>"><span class="ui-icon ui-icon-power" style="float:left;"></span><?php echo _LOGIN ?></a>
          </div>
      		<?php if ($_THEME_CFG['use_fb']==1){ ?>
          <!-- facebook login button -->		
      		<div id='facebooklogin' class='jqtooltip-dx ui-corner-all' title='Entra in questo sito con il tuo account facebook per avere funzioni sociali sul sito Parrocchia San Lino'>
      					<img src="/themes/glorioso/images/social/fb_login-button.png" alt="Facebook Login" /> 
      		</div>    
          <?php } ?>
      		<?php if ($_THEME_CFG['use_gfc']==1){ ?>
          <!-- google friend connect button-->
            <div id='gfc-button' class='jqtooltip-dx ui-corner-all' title='Entra in questo sito con il tuo account google per avere funzioni sociali sul sito Parrocchia San Lino'></div>
            <script type="text/javascript">
              google.friendconnect.renderSignInButton({ "id":"gfc-button", "style":"long", "text":"Login with Google" });
            </script>
          <?php } ?>
          <!--  Registration button  --> 
      	  <?php if ( $_FN['enable_registration'] == 1 ) {  ?>
      		<div class="jqtooltip-dx ui-corner-all" title="Registrati ora se ancora non l'hai fatto!">
            <span class="ui-icon ui-icon-star" style="float:left;"></span><a href="<?php echo $urlregistrazione ?>"><?php echo fn_i18n("_REGORA"); ?></a>
          </div>
      	  <?php } ?>
        </div> <!-- END USERLOGIN-DROPDOWN -->
      </div> <!-- END USERLOGIN -->
  </div> <!-- END USERLOGIN-WRAPPER DIV -->
<?php
    } 
/*********************** END NOT LOGGED IN ***********************/
?>
</div>
<!-- END DIV UTENTE (LEFT DIV) -->
<!-- START DIV UTENTE (RIGHT DIV) -->
<div style="width:59%;float:right;">
<!-- TOP DIV: SEARCH - ADMIN - LANG - THEME -->
<div style="margin: 5px 0px 0px 5px;" class="ui-helper-clearfix">
	<!-- SEARCH FIELD -->
		<button id="CTRLPAN_SEARCH" style="float:left;" class="jqtooltip-dx" onclick="location.href='<?php echo $_FN['self']?>?mod=search'" title="Effettua una ricerca sul sito">
      <?php echo _CERCA;?>
    </button>
	<!-- USERSTUFF BUTTONSET -->
	<div id="userbuttonset" style="float:left;margin-left:20px;">
	<?php if ($_FN ['user'] != "") { // if already logged in
		//CONTROLCENTER
	    if (isadmin ()) {	?>
			<input type="checkbox" id="CTRLPAN_ADMIN" /><label for="CTRLPAN_ADMIN" class="jqtooltip-dx" title="<?php echo _MANAGEFLATNUKE;?> (Pannello di Controllo)">CtlPan</label>
	    <input type="checkbox" id="THEME_CFG" /><label for="THEME_CFG" class="jqtooltip-dx" title="Configura il tema (config.php)">Cfg Theme</label>
      <?php }
		//FILEMANAGER
		if ( user_can_edit_section($_FN['vmod']) )
		{ ?>
			<input type="checkbox" id="CTRLPAN_FILEMNGR" /><label for="CTRLPAN_FILEMNGR" class="jqtooltip-dx" title="<?php echo strtoupper(fn_i18n('_MANAGEFILE')); ?> :<br /> <?php echo fn_i18n('_FILESINSECTION'); ?>">FileMngr</label>
	<?php
    }
		//ADMIN ON/OFF
		if ( isadmin() || can_modify($_FN['user'],"sections/{$_FN['vmod']}") ){
			echo ( $_FN['fneditmode'] != 0 ) ? "<input type=\"checkbox\" id=\"glorioso_adminonoff\" name=\"glorioso_adminonoff\" rel=\"glorioso_adminon\" checked /><label for=\"glorioso_adminonoff\" class=\"jqtooltip-dx\" title=\"" . fn_i18n("_EDITMODEOFF"). "\">OFF</label>" : "<input type=\"checkbox\" id=\"glorioso_adminonoff\" name=\"glorioso_adminonoff\" rel=\"glorioso_adminoff\" /><label for=\"glorioso_adminonoff\" class=\"jqtooltip-dx\" title=\"". fn_i18n("_EDITMODEON") ."\" />ON</label>";
			}		
		}
		// whether logged in or not:
		// nnn
		?>
	</div> <!-- END USERSTUFF BUTTONSET -->
	<!-- SHOW/HIDE, LANG and THEME right floated -->
	<div id="toolbar-hide" style="float:right;" class="fg-button fg-button-icon-left ui-corner-top"><span class="ui-icon ui-icon-arrowthickstop-1-n"></span>HIDE</div>
	<div class="jqtooltip-dx" title="Visualizza questo sito in altre lingue (anche se non è ancora tradotto... Beh vedi tu!!!)" style="float:right;"><?php getlangs(); ?></div>
	<script type="text/javascript" src="http://jqueryui.com/themeroller/themeswitchertool/"></script>
	<div id="gloriosothemeswitcher" class="jqtooltip-dx" title="Scegli il tema che più ti piace, si applicherà al volo!"></div>
</div>
<!-- END TOP DIV: SEARCH - ADMIN - LANG - THEME -->
<?php if ($_THEME_CFG['use_fb']==1){ ?>
<!-- START BOTTOM DIV: FACEBOOK -->
<div style="border-top:inset 1px red;margin: 5px 0px 0px 5px;" class="ui-helper-clearfix">
  <!-- FACEBOOK LIKE AND FACEBOOK BOOKMARK ON THE LINE BELOW, TO THE LEFT -->
  	<div id="fb_bookmark_btn" class="jqtooltip-dx" style="float:left;margin-right:5px;" title="Aggiungi un segnalibro al tuo home su facebook per raggiungere facilmente questa applicazione!"><fb:bookmark /></div>
    <div id="fb_like_btn" class="jqtooltip-dx" style="float:left;margin-right:5px;" title="Fai sapere ai tuoi amici che ti piace questo sito!"><fb:like layout="button_count" colorscheme="light" href="<?php echo $_FN['siteurl'] ?>"></fb:like></div>
  	<!-- <div style="float:right;margin:0px 5px 0px 5px;"><fb:chat-invite></fb:chat-invite></div> -->
</div>
<!-- END BOTTOM RIGHT DIV ON USERBAR: FACEBOOK -->
<?php } ?>
</div>
<!-- END DIV UTENTE (RIGHT DIV) -->
</div><!-- END TOOLBAR -->
<?php if(!$_THEME_CFG['backimage']){ ?>
  <div class="pagetop_topmargin" style="height:10px;border:1px solid #FFFFFF;border-bottom:0px;clear:both;">
</div>
<?php }?>
</div><!-- END TOOLBAR WRAPPER -->
<?php if(!$_THEME_CFG['backimage']){ ?>
  <div class="pagetop_bottommargin" style="clear:both;height:10px;border:1px solid #FFFFFF;border-top:0px;">
</div>
<?php }
else{ echo "<div style=\"clear:both;height:20px;\"></div>"; }
?>