<?php
global $_FN,$_THEME_CFG;
?>

<div class="top_colmid">
<div class="top_colleft">

<div class="top_col1">
<div id="pagetop_midelement" style="vertical-align:middle;padding:0px 15px;height:65px;border-top:3px outset #D2D3B3;border-bottom:3px outset #D2D3B3;border-right:1px outset #D2D3B3;border-left:1px outset #D2D3B3;">

<?php
echo ($_THEME_CFG['top_title']!="") ? "<div style=\"float:left;width:80%;\" id=\"toptitle\">{$_THEME_CFG['top_title']}</div>" : "";
echo ($_THEME_CFG['top_pic']!="") ? "<img style=\"float:right;height:60px;vertical-align:middle;cursor:pointer;\" src=\"".$_THEME_CFG['top_pic']."\" alt=\"theme-pic\" />" : "";

?>
</div>
</div>

<div class="top_col2">
	<div id="pagetop_leftelement" style="vertical-align:middle;height:65px;border:3px outset #D2D3B3;border-right:1px outset #D2D3B3;text-align:center;">
	<?php
		echo ($_THEME_CFG['top_logo']!="") ? "<img style=\"height:65px;position:relative;cursor:pointer;\" src=\"".$_THEME_CFG['top_logo']."\" alt=\"theme-logo\" />" : "";	
	?>
	</div>
</div>


<div class="top_col3">
<div id="pagetop_rightelement" style="vertical-align:middle;height:65px;border:3px outset #D2D3B3;border-left:1px outset #D2D3B3;">

	<!-- CLOCK -->
	<img id="gloriosocal" src="images/pagetop/calendario.gif" alt="Calendario" title="Visualizza il Calendario degli Eventi" />
	<!-- Calendar feed as defined in config.php -->
	<input type="hidden" id="gcal-feed" value="<?php echo $_THEME_CFG['gcal_feed']?>" />
	<?php include("fullcalendar.php"); ?>

	<input type="hidden" id="current_timestamp" value="<?php echo time(); ?>" />
	<input type="hidden" id="current_langset" value="<?php echo $_FN['lang']; ?>" />
	<div style="float:right;vertical-align:middle;text-align:center;">
	<div id="currentdate" style="margin-bottom:5px;text-align:center;clear:both;"><?php if($_FN['lang']=='en'){echo strftime('%A, %B %e, %Y', time());}else{echo strftime('%A, %e %B %Y', time());} ?></div>
	<div id="clock" style="padding:0px 3px;text-align:center;clear:both;"><?php if($_FN['lang']=='en'){echo strftime('%r', time());} else {echo strftime('%T', time());} ?></div>
	</div>
	<!-- END CLOCK -->

</div>
</div>

</div>
</div>
<?php
			if (isadmin() && $_FN['fneditmode']!=0)
				echo "<span class=\"flatnukeadmin\" style=\"clear:both;\"><a href=\"index.php?opindex=modcont&amp;file=themes/glorioso/top.php\" >"._MODIFICA." top.php</a></span>";
?>