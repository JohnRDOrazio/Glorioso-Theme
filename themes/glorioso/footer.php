<?php
if ( strpos(strtolower($_SERVER['SCRIPT_NAME']),strtolower(basename(__FILE__))) ) {
	header("Location: ../../index.php");
	die("...");
	}
	?>
  <div id="validate-icons">
    <a class="validate-icon flatnux" href="http://flatnux.sourceforge.net"></a>
    <a class="validate-icon html" href="http://validator.w3.org/check/referer"></a>
    <a class="validate-icon css" href="http://jigsaw.w3.org/css-validator/check/referer"></a>
    <a class="validate-icon rss" href="<?php echo $_FN['datadir']?>/<?php	echo $_FN['lang']?>/backend.xml"></a>
    <a class="validate-icon jquery" href="http://jquery.com/" title="jQuery JavaScript Library"></a>
    <a class="validate-icon jquery-ui" href="http://jquery-ui.com" title="jQuery UI"></a>
  </div>
  <div id="credits-links">
  Powered&nbsp;by&nbsp;<a  style="font-weight:bold;" href="http://flatnux.sourceforge.net">FlatNuX</a>&nbsp;&copy;&nbsp;2003-2005
  &nbsp;|&nbsp;
  <span style="font-style:italic;">Glorioso Theme</span>
  &nbsp;|&nbsp;
  Site&nbsp;Admin:&nbsp;<a href="mailto:<?php echo $_FN['admin_mail']?>"><?php echo $_FN['admin']?></a>
  &nbsp;|&nbsp;
  <a href="<?php echo $_FN['datadir']?>/index.html">Full&nbsp;Map</a>
<?php if ( file_exists("{$_FN['datadir']}/{$_FN['lang']}/backend.xml") ) { ?>
  &nbsp;|&nbsp;
  <a href="<?php echo $_FN['datadir']?>/<?php echo $_FN['lang']?>/backend.xml">Get&nbsp;RSS&nbsp;News</a>
<?php } ?>
  </div>
  <div id="credits-legal">
    <?php echo _LEGAL?>
  	<span>
  		<?php $time2 = get_microtime();
  		echo "Page generated in ".sprintf("%.4f", abs(get_microtime() - $_FN['timestart']))." seconds.";
  		?>
  	</span>
  </div>
