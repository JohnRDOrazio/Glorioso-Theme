<?php
if ( strpos(strtolower($_SERVER['SCRIPT_NAME']),strtolower(basename(__FILE__))) ) {
	header("Location: ../../index.php");
	die("...");
	}

/**
 * Visualizza i crediti di Flatnuke
 * 
 * @author Alessandro Vernassa <speleoalex@gmail.com>
 * 
 **/
function MyShowCredits()
{
	global $_FN;
	?>
<div id="jqueryfooter" style="text-align:center;vertical-align:middle;width:287px;height:75px;margin:0 auto;">
<a href="http://jquery.com"><img style="vertical-align:middle;border:0px;height:66px;" src="images/validate/jQuery-alpha-trans.png" alt="jQuery: The Write Less, Do More, Javascript Library" title="jQuery: The Write Less, Do More, Javascript Library" /></a>
<a href="http://jqueryui.com/"><img style="vertical-align:middle;border:0px;height:66px;" src="images/validate/logo_ui.png" alt="jQuery UI" title="jQuery UI" /></a>
</div>
<span>
<a href="http://flatnux.sourceforge.net"> <img style="vertical-align:middle;border:0px;" src="images/validate/flatnuke_powered.png"	alt="Powered by FlatNuX!" title="Powered by FlatNuX!" /></a>
<a href="http://validator.w3.org/check/referer"> <img style="vertical-align:middle;border:0px;" src="images/validate/xhtml.png"	alt="Valid HTML 5!" title="Valid HTML 5!" /></a>
<a href="http://jigsaw.w3.org/css-validator/check/referer"> <img style="vertical-align:middle;border:0px;" src="images/validate/valid_css.png" alt="Valid CSS!" title="Valid CSS!" /></a>
<a href="<?php echo $_FN['datadir']?>/<?php	echo $_FN['lang']?>/backend.xml"> <img style="vertical-align:middle;border:0px;" src="images/validate/rss20_powered.png" alt="Get RSS 2.0 Feed"	title="Get RSS 2.0 Feed" /></a>
<a href='http://jquery.com/' title='jQuery JavaScript Library'><img src='http://jquery.com/files/buttons/jquery-icon.png' alt='jQuery JavaScript Library' title='jQuery JavaScript Library' style='vertical-align:middle;border:none;' /></a>
<br />
Powered&nbsp;by&nbsp;
<span style="font-weight:bold;"><a href="http://flatnux.sourceforge.net">FlatNuX</a></span>
&nbsp;&copy;&nbsp;2003-2005
&nbsp;|&nbsp;
Site&nbsp;Admin:&nbsp;<a href="mailto:<?php echo $_FN['admin_mail']?>"><?php echo $_FN['admin']?></a>
&nbsp;|&nbsp;
<a href="<?php echo $_FN['datadir']?>/index.html">Full&nbsp;Map</a>
<?php if ( file_exists("{$_FN['datadir']}/{$_FN['lang']}/backend.xml") ) { ?>
&nbsp;|&nbsp;
<a href="<?php echo $_FN['datadir']?>/<?php echo $_FN['lang']?>/backend.xml">Get&nbsp;RSS&nbsp;News</a>
<?php } ?>
<br />
<?php echo _LEGAL?>
</span>
<?php } ?>

<!-- FOOTER  -->
<div id="pagebottom" style="font-size:.8em;">
		<?php MyShowCredits(); ?>


	<span>
		<?php $time2 = get_microtime();
		echo "Page generated in ".sprintf("%.4f", abs(get_microtime() - $_FN['timestart']))." seconds.";
		?>
	</span>
</div>
<!-- END FOOTER -->
