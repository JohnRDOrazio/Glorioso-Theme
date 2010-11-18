<?php
global $_FN,$_THEME_CFG;
?>
<div id="personalizable_pagetop" style="clear:both;padding-left:201px;padding-right:201px;">

<div id="pagetop_centercol" style="float:left;position:relative;width:100%;">

<?php
/* div#toptitle font-family is determined in glorioso.js as example of google webfonts */
echo ($_THEME_CFG['top_title']!="") ? "<div id=\"toptitle\">{$_THEME_CFG['top_title']}</div>" : "";
?>
</div>

<div id="pagetop_leftcol" style="float:left;position:relative;width:200px;margin-left:-100%;right:200px;text-align:center;">
	<?php
		echo ($_THEME_CFG['top_logo']!="") ? "<img style=\"height:65px;position:relative;cursor:pointer;\" src=\"".$_THEME_CFG['top_logo']."\" alt=\"theme-logo\" />" : "";	
	?>
</div>


<div id="pagetop_rightcol" style="float:left;position:relative;width:200px;margin-right:-100%;text-align:center;">
<?php
echo ($_THEME_CFG['top_pic']!="") ? "<img style=\"height:60px;vertical-align:middle;cursor:pointer;\" src=\"".$_THEME_CFG['top_pic']."\" alt=\"theme-pic\" />" : "";
?>
</div>

<?php
			if (isadmin() && $_FN['fneditmode']!=0)
				echo "<span class=\"flatnukeadmin\" style=\"clear:both;\"><a href=\"index.php?opindex=modcont&amp;file=themes/glorioso/top.php\" >"._MODIFICA." top.php</a></span>";
?>

</div><!-- END PERSONALIZABLE PAGETOP -->