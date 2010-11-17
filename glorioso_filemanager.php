<?php
/**
 * filemanager.php Created on 12/nov/07
 *
 * @package flatnux
 * @author Alessandro Vernassa <speleoalex@gmail.com>
 * @copyright Copyright (c) 2003-2005
 * @license http://opensource.org/licenses/gpl-license.php GNU General Public License
 * 
 * adapted for Glorioso Theme by John Romano D'Orazio
 * 02/11/2010   
 */

global $_FN;
$_FN = array();
include "./include/flatnux.php";
if ( file_exists("sections/" . sectionlocation("filemanager") . "/lang." . $_FN['lang'] . ".php") )
	require_once "sections/" . sectionlocation("filemanager") . "/lang." . $_FN['lang'] . ".php";
else
	require_once "sections/" . sectionlocation("filemanager") . "/lang.en.php";
$sess_filemanager_editor = getparam("filemanager_editor",PAR_GET,SAN_HTML);
$sess_filemanager_editor = basename($sess_filemanager_editor);
if ( strstr($sess_filemanager_editor,"..") || strstr($sess_filemanager_editor,'/') || strstr($sess_filemanager_editor,'\\') )
	$sess_filemanager_editor = basename($sess_filemanager_editor);
?>
<head>
<style>
* {
	font: Verdana, Arial, sans-serif;
	font-family: Verdana, Arial;
	font-size: 12px;
	margin: 0px;
	padding: 0px;
}
td { font: 12px Arial, Helvetica, sans-serif; }
form { font: 12px Arial, Helvetica, sans-serif; }
body {
	background-color: #e2ddcf;
	color: #000000;
}
a {
	text-decoration: none;
	color: #000000;
}
a:hover { text-decoration: underline; }
.codepress { width: 100% }
form { border: 0px; }
</style>

<script type="text/javascript">
function check(url)
{
	if(confirm ("<?php
	echo fn_i18n("_SICURO")?>"))
		window.location=url;
}

// parseUri 1.2.2
// (c) Steven Levithan <stevenlevithan.com>
// MIT License

function parseUri (str) {
	var	o   = parseUri.options,
		m   = o.parser[o.strictMode ? "strict" : "loose"].exec(str),
		uri = {},
		i   = 14;

	while (i--) uri[o.key[i]] = m[i] || "";

	uri[o.q.name] = {};
	uri[o.key[12]].replace(o.q.parser, function ($0, $1, $2) {
		if ($1) uri[o.q.name][$1] = $2;
	});

	return uri;
};

parseUri.options = {
	strictMode: false,
	key: ["source","protocol","authority","userInfo","user","password","host","port","relative","path","directory","file","query","anchor"],
	q:   {
		name:   "queryKey",
		parser: /(?:^|&)([^&=]*)=?([^&]*)/g
	},
	parser: {
		strict: /^(?:([^:\/?#]+):)?(?:\/\/((?:(([^:@]*)(?::([^:@]*))?)?@)?([^:\/?#]*)(?::(\d*))?))?((((?:[^?#\/]*\/)*)([^?#]*))(?:\?([^#]*))?(?:#(.*))?)/,
		loose:  /^(?:(?![^:@]+:[^:@\/]*@)([^:\/?#.]+):)?(?:\/\/)?((?:(([^:@]*)(?::([^:@]*))?)?@)?([^:\/?#]*)(?::(\d*))?)(((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[?#]|$)))*\/?)?([^?#\/]*))(?:\?([^#]*))?(?:#(.*))?)/
	}
};

</script>
<title>Filemanager for Glorioso Theme Configuration</title>
</head>
<?php
if ( $sess_filemanager_editor != "" && file_exists("include/extra/$sess_filemanager_editor/filemanager.php") )
{
	include ("include/extra/$sess_filemanager_editor/filemanager.php");
}
else
{
  echo "<body>";
	$opener = getparam("opener",PAR_GET,SAN_FLAT);
  $onchange = getparam("onchange",PAR_GET,SAN_FLAT);
  echo "
<script type=\"text/javascript\" >
    function findnext(fnid,fntype){
      var onode, otarget;
      onode=window.opener.document.getElementById(fnid);
      onode=onode.nextSibling;
      while (onode) {
          if (onode.nodeType==1&&onode.nodeName==fntype) {
              otarget=onode;
              break;
          }
          onode=onode.nextSibling;
      }
      if (otarget) {
          return otarget;
      } else {
          alert('element not found!');
      }    
    }

// funzione chiamata dal filemanager una volta selezionato il file
function insertElement(URL) {
";
	if ( $opener != "" )
	{
    echo ($onchange!=""&&$onchange==1) ? "
    URLpath = parseUri(URL).path;
    try{   
    window.opener.document.getElementById('$opener').value = URLpath;
    img_el = findnext('$opener','IMG');
    img_el.src = URLpath;
    }catch (e){alert(e)}" : "
    try{   
    window.opener.document.getElementById('$opener').value = URLpath;
    }catch (e){alert(e)}";
	}
	echo "	window.close();
}
</script>
";
	include ("sections/" . sectionlocation("filemanager") . "/section.php");
	echo "</body>";
}
?>