<?php
/*******************************************************************************/
/* fLOSt -> Flatnux Open Social Theme                                          */
/* ============================================                                */
/*                                                                             */
/* Copyright (c) 2010-2011 by John R. D'Orazio                                 */
/* http://johnrdorazio.altervista.org                                          */
/*                                                                             */
/* This program is free software. You can redistribute it and/or modify        */
/* it under the terms of the GNU General Public License as published by        */
/* the Free Software Foundation; either version 3 of the License, or           */
/* (at your option) any later version.                                         */
/*                                                                             */
/* This program is distributed in the hope that it will be useful,             */
/* but WITHOUT ANY WARRANTY; without even the implied warranty of              */
/* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the               */
/* GNU General Public License for more details.                                */
/*                                                                             */
/* You should have received a copy of the GNU General Public License           */
/* along with this program.  If not, see <http://www.gnu.org/licenses/>.       */
/*******************************************************************************/

if ( strpos(strtolower($_SERVER['SCRIPT_NAME']),strtolower(basename(__FILE__))) )
{
	header("Location: ../../index.php");
	die("...");
}
global $_FN,$_FB;
switch($_FN['lang']){
	case "it":
		setlocale(LC_ALL, "it_IT."._CHARSET);
		break;
	case "en":
		setlocale(LC_ALL, "en_EN."._CHARSET);
		break;
	case "es":
		setlocale(LC_ALL, "es_ES."._CHARSET);
		break;
	case "fr":
		setlocale(LC_ALL, "fr_FR."._CHARSET);
		break;
	case "de":
		setlocale(LC_ALL, "de_DE."._CHARSET);
		break;
	case "ru":
		setlocale(LC_ALL, "ru_RU."._CHARSET);
		break;		
}
//config.php
include ("themes/{$_FN['theme']}/config.php");
define("_THEME_VER", "1.9");

function showmotd()
{
	global $_FN;
	if (file_get_contents ( "{$_FN['datadir']}/motd." . $_FN['lang'] . ".php" ) == "")
		return;
	if (function_exists ( "FN_OpenMotd" ) && function_exists ( "FN_CloseMotd" ))
		FN_OpenMotd ();
	else
		OpenTable ();
	if (file_exists ( "themes/{$_FN['theme']}/images/motd.png" ))
		echo "<img src='themes/{$_FN['theme']}/images/motd.png' style='float:left;margin:10px;' alt='Motd' />";
	echo local_to_abs ( "{$_FN['datadir']}/motd." . $_FN['lang'] . ".php" );
	
	if (isadmin () && $_FN['fneditmode'] != 0)
	{
		echo "<br /><span class=\"flatnukeadmin\"><a href=\"index.php?opindex=modcont&amp;file={$_FN['datadir']}/motd.{$_FN['lang']}.php&amp;from=index.php\">" . _MODIFICA . "</a></span>";
	
	}
	
	if (function_exists ( "FN_OpenMotd" ) && function_exists ( "FN_CloseMotd" ))
		FN_CloseMotd ();
	else
		CloseTable ();
}
function create_menu()
{
	global $_FN,$_THEME_CFG;
	$accesskey = "";
	$title = "Menu";
	$css_class = "";
	OpenBlock ( "{$_FN['siteurl']}images/menu.png", $title );
	echo "<div id=\"vertical-menu\" class=\"fn-menu\">";
	$tl=($_FN['lang'] != $_FN['lang_default'])?"?lang={$_FN['lang']}":"";
	if($_FN['home_section']==""){
		if ( ($text=getLang("sections/.lang.xml"))!="" )
			$title = $text;
		elseif ( defined(_FIRSTBUTTONMENU) )
			$title = _FIRSTBUTTONMENU;
		else
			$title = "HOME";
		$href = "href=\"{$_FN['siteurl']}index.php\"";
		if($_FN['vmod']==""){
			$css_class="ui-state-active ui-state-disabled";
			$href = "";
		}
		if($_THEME_CFG['show_icons']){
			if(file_exists("themes/{$_FN['theme']}/images/sections/$title.png")){
				$imagesrc="themes/{$_FN['theme']}/images/sections/$title.png";
				}
			else{
				$imagesrc = fromtheme ( "images/menu.png" );
				}
			$imagesize = getimagesize($imagesrc);
			$css_size="";
			if($imagesize[0]>$_THEME_CFG['max_size_icons']){
				$css_size="height:{$_THEME_CFG['max_size_icons']}px;";
				}
			echo "<div class=\"fg-button ui-state-default $css_class ui-priority-primary ui-corner-top\" style=\"height:{$_THEME_CFG['max_size_icons']}px;\"><a $href $accesskey title=\"\"><img alt='$title' style='{$css_size}vertical-align:middle;padding-right:10px;' src=\"$imagesrc\" />$title</a></div>\n";
			}
		else {
			echo "<div class=\"fg-button ui-state-default $css_class ui-priority-primary ui-corner-left\"><a $href $accesskey title=\"\">$title</a></div>\n";
			}
		$button_corner_css = "";
		$x = 1;
		}
	else { $button_corner_css = "ui-corner-top"; $x = 0;}//Se c'è una sezione che fa da HOME (e quindi non c'è FIRSTBUTTONMENU)
		printsection2("sections",$_THEME_CFG['menu_recursive'], $button_corner_css, $x);
		echo "</div>";
		CloseBlock();
}
/**
 * Stampa la lista delle sezioni e delle sottosezioni
 *
 * @param string $path dove cercare la sezione (es. sections/01_pippo)
 */
function printsection2($path, $recursive=true, $btn_crn_css="", $xval=1)
{
	global $_FN,$_THEME_CFG;
	static $slevel=0;
	$modlist = list_sections_translated($path, false, false); // return array with title - link
	$slevel++;
	$i=count($modlist) + $xval;
	//serve per indicizzare tutte le lingue
	$tl = ($_FN['lang'] != $_FN['lang_default']) ? "&amp;lang={$_FN['lang']}" : "";
	foreach ($modlist as $modl)	{
	 -- $i;
	 if (  user_can_view_section($modl['link'],$_FN['user']) ){
		$link = $modl['link'];
		$title = $modl['title'];
		$accesskey = $modl['accesskey'];
		if ($accesskey != "")
			$accesskey = "accesskey='$accesskey'";
		$css_class = "";
		$btn_style = "";
		$btn_height = "";
		$href="href=\"".fn_rewritelink("index.php?mod=$link")."\"";
		if($_FN['vmod']==$modl['link']){
			$css_class = "ui-state-active ui-state-disabled";
			$href = "";
			}
		if ( $slevel > 1 )	{
			$_THEME_CFG['max_size_icons']==$_THEME_CFG['max_size_icons']-($slevel*2);
			$btn_width = 100 - ($slevel*10);
			$btn_font_size = 10 - (($slevel-1)*2);
			$btn_style = "width:$btn_width%;margin:0 auto;font-size:.{$btn_font_size}em;";
			}
		if($_THEME_CFG['show_icons']==1){
			$idsezione = get_section_id($modl['link']);
			if(file_exists("themes/{$_FN['theme']}/images/sections/$idsezione.png")){
				$iconasezione = "themes/{$_FN['theme']}/images/sections/$idsezione.png";
				}
			else {
				$iconasezione = fromtheme ( "images/section.png" );
				}
			$imagesize = getimagesize($iconasezione);
			$css_size="";
			if($imagesize[0]>$_THEME_CFG['max_size_icons']){
				$css_size="height:{$_THEME_CFG['max_size_icons']}px;";
				}
			$title = "<img alt='$title' style='{$css_size}vertical-align:middle;padding-right:10px;' src='$iconasezione' />".$title;
			$btn_height = "height:{$_THEME_CFG['max_size_icons']}px;";
			}
			echo "<div style=\"{$btn_height}{$btn_style}\" class=\"fg-button ui-state-default $css_class ui-priority-primary $btn_crn_css\"><a $href $accesskey title=\"$link\">$title</a></div>\n";
			$l=basename($link);
			if ( $recursive )
			{
				if( $slevel > 1 ) {
					$div_margin = "margin:0 auto;"; $div_width = "width:".(105 - ($slevel*10))."%;";
					}
				else { $div_margin = ""; $div_width = ""; }
				// If the page is opened directly on a subsection (and not via ajax),
				// the subsection should be expanded. Still needs to be implemented...
				if ( fn_erg('^' . $modl['link'],$_FN['vmod']) ){
					$subsect_style = "expanded";
					echo "<div class='subsection' style='$div_width $div_margin'>";
					printsection2("$path/$l");
					echo "</div>";
					}
				else {
					echo "<div class='subsection' style='$div_width $div_margin'>";
					printsection2("$path/$l");
					echo "</div>";
					}
			} // END IF RECURSIVE
	 } // END IF USER CAN VIEW SECTION
			if ( $i > 2 ){ $btn_crn_css = ""; }
			elseif ( $i == 2 ) { $btn_crn_css = "ui-corner-bottom";	}
	} // END FOR CYCLE
	$slevel--;
}
function create_h_menu($separator="|"){
	global $_FN,$_THEME_CFG;
	if($_FN['home_section']==""){ // Se non c'è una sezione di default, index.php è la sezione di default (HOME)
		$accesskey = "";
		if ( ($text=getLang("sections/.lang.xml"))!="" )
			$title = $text;
		elseif ( defined(_FIRSTBUTTONMENU) )
			$title = _FIRSTBUTTONMENU;
		else
			$title = "HOME";
		$css_class = "";
		$href="href=\"index.php\"";
		if($_FN['vmod']==""){
			$css_class = "ui-state-active ui-state-disabled";
			$href = "";
			}
		if($_THEME_CFG['show_icons']==1){
			if(file_exists("themes/{$_FN['theme']}/images/sections/$title.png")){
				$imagesrc="themes/{$_FN['theme']}/images/sections/$title.png";
				}
			else{
				$imagesrc = fromtheme ( "images/menu.png" );
				}
			$imagesize = getimagesize($imagesrc);
			$css_size="";
			if($imagesize[0]>$_THEME_CFG['max_size_icons']){
				$css_size="height:{$_THEME_CFG['max_size_icons']}px;";
				}
			echo "<div class=\"fg-button ui-state-default $css_class ui-priority-primary ui-corner-left\" style=\"height:{$_THEME_CFG['max_size_icons']}px;\"><a  $href $accesskey title=\"\"><img alt='$title' style='{$css_size}vertical-align:middle;' src=\"$imagesrc\" />$title</a></div>\n";
			}
		else {
			echo "<div class=\"fg-button ui-state-default $css_class ui-priority-primary ui-corner-left\"><a $href $accesskey title=\"\">$title</a></div>\n";
			}
		$button_corner_css = "";
		$x = 1;
		}
	else { $button_corner_css = "ui-corner-left"; $x = 0;}//Se c'è una sezione che fa da HOME (e quindi non c'è FIRSTBUTTONMENU)
	$modlist = list_sections_translated("sections"); // return array with title - link
	$i=count($modlist) + $x;
	//serve per indicizzare tutte le lingue
	$tl = ($_FN['lang'] != $_FN['lang_default']) ? "&amp;lang={$_FN['lang']}" : "";
	foreach ($modlist as $modl)	{
	 -- $i;
	 if (  user_can_view_section($modl['link'],$_FN['user']) ){
		$link = $modl['link'];
		$title = $modl['title'];
		$accesskey = $modl['accesskey'];
		if ($accesskey != "")
			$accesskey = "accesskey='$accesskey'";
		$css_class = "";
		$btn_height = "";
		$href="href=\"".fn_rewritelink("index.php?mod=$link")."\"";
		if($_FN['vmod']==$modl['link']){
			$css_class = "ui-state-active ui-state-disabled";
			$href = "";
			}
		if($_THEME_CFG['show_icons']==1){
			$idsezione = get_section_id($modl['link']);
			if(file_exists("themes/{$_FN['theme']}/images/sections/$idsezione.png")){
				$iconasezione = "themes/{$_FN['theme']}/images/sections/$idsezione.png";
				}
			else {
				$iconasezione = fromtheme ( "images/section.png" );
				}
			$imagesize = getimagesize($iconasezione);
			$css_size="";
			if($imagesize[0]>$_THEME_CFG['max_size_icons']){
				$css_size="height:{$_THEME_CFG['max_size_icons']}px;";
				}
			$title = "<img alt='$title' style='{$css_size}vertical-align:middle;' src='$iconasezione' />".$title;
			$btn_height = "style=\"height:{$_THEME_CFG['max_size_icons']}px;\"";
			}
			echo "<div $btn_height class=\"fg-button ui-state-default $css_class ui-priority-primary $button_corner_css\"><a $href $accesskey title=\"$link\">$title</a></div>\n";
	 }
			if ( $i > 2 ){ $button_corner_css = ""; }
			elseif ( $i == 2 ){ $button_corner_css = "ui-corner-right"; }
	}
}
	/**
	 * Visualizza i blocchi laterali
	 *
	 * Visualizza il contenuto dei blocchi laterali presenti nelle directories
	 * <i>/blocks/dx/</i> oppure <i>/blocks/sx/</i> a seconda del parametro passato;
	 * non vengono stampati i blocchi che iniziano per "none_".
	 *
	 * @author Simone Vellei <simone_vellei@users.sourceforge.net>
	 * @author Alessandro Vernassa <speleoalex@gmail.com>
	 * @param string $edge Lato dei blocchi da stampare
	 * 
	 * --> Modifica John R. D'Orazio: nessun <br /> tra un blocco e l'altro,
	 *  piuttosto margin-bottom col css
	 */
	function create_blocks($edge)
	{
		global $_FN;
		$handle = opendir ( 'blocks/' . $edge );
		$modlist = array ();
		
		while ( false !== ($file = readdir ( $handle )) )
		{
			if (! is_dir ( "blocks/$edge/$file" ) and ! preg_match ( "/^\\./s", $file ) and ! stristr ( $file, "none_" ) and ! stristr ( $file, ".xml" ) and ! preg_match ( "/~$/s", $file ))
			{
				array_push ( $modlist, $file );
			}
		}
		
		closedir ( $handle );
		fn_natsort ( $modlist );
		
		foreach ( $modlist as $kk => $mod )
		{
			$ext = get_file_extension ( $mod );
			$tmp = preg_replace ( '/\.' . $ext . '$/s', '', $mod );
			$tmp = preg_replace ( "/^[0-9]+_|^none_/i", "", $tmp );
			$title = str_replace ( "_", "&nbsp;", $tmp );
			$filelang = "blocks/$edge/" . preg_replace ( "/^[0-9]+_|^none_/si", "", $mod ) . ".xml";
			$cfgfile = "blocks/$edge/" . $tmp . "/config.php";
			if (file_exists ( $filelang ))
			{
				$title = getLang ( $filelang, $title );
			}
			
			if(ob_start()){
				fn_include ( "blocks/$edge/$mod" );
				$string = ob_get_contents ();
				ob_end_clean ();
      }
			// se il blocco e' vuoto esco
			if ($string != "")
			{
				
				OpenBlock ( "{$_FN['siteurl']}images/block.png", $title, $cfgfile );
				echo "$string";
				//ripristino mod nel caso venga cambiato dal blocco
				$mod = $modlist[$kk];
				//dprint_r($mod);
				if (isadmin () && $_FN['fneditmode'] != 0)
					echo "<br /><span class=\"flatnukeadmin\"><a href=\"index.php?opindex=modcont&amp;file=blocks/$edge/$mod&amp;from={$_FN['vmod']}\">" . _MODIFICA . "</a></span>";
				
				CloseBlock ();
			}
		}
	}
function FN_CreateSubmenu()
{
	global $_FN,$_THEME_CFG;
	$section = $_FN['vmod'];
	$modlist = list_sections_translated ( 'sections/' . $section );
	//if (count ($modlist)==0)
	//	$modlist = list_sections_translated ( 'sections/' . dirname($section) );
	
	if (count ( $modlist ) > 0)
	{
		OpenTable ("fn-menu");
		foreach ( $modlist as $modl )
		{
			if (  user_can_view_section($modl['link'],$_FN['user']) ){
				$link = $modl['link'];
				$linkh = get_section_id($modl['link']);
				$title = $modl['title'];
				$accesskey = $modl['accesskey'];
				if ($accesskey != "")
					$accesskey = "accesskey='$accesskey'";
				if($_THEME_CFG['show_icons']==1){
					if(file_exists("themes/{$_FN['theme']}/images/sections/$linkh.png")){
						$iconasezione = "themes/{$_FN['theme']}/images/sections/$linkh.png";
						}
					else {
						$iconasezione = fromtheme ( "images/section.png" );
						}
					$imagesize = getimagesize($iconasezione);
					$css_size="";
					if($imagesize[0]>$_THEME_CFG['max_size_icons']){
						$css_size="width:{$_THEME_CFG['max_size_icons']}px;";
						}
					$title = "<img alt='$title' style='{$css_size}vertical-align:middle;' src='$iconasezione' /><span>".$title."</span>";
					}
				echo "\n<div class='fg-button ui-corner-all ui-state-default'><a $accesskey rel='".fn_rewritelink("index.php?mod=$linkh")."' href='".fn_rewritelink("index.php?mod=$linkh")."'>$title</a></div>";
				}
		}
		echo "<div style=\"clear:both;\"></div>";
    CloseTable ();
	}
}
/*****************************
function FN_SectionFooter(){}
The default function defined in include/theme.php is just fine.
******************************/
function FN_CreateNavbar($tree, $title)
{
	
	$tit = "";
	for($i = 0; $i < sizeof ( $tree ); $i ++)
	{
		$mypath = "";
		for($j = 0; $j <= $i; $j ++)
		{
			if ($i > 0 and ($j != $i))
			{
				$mypath .= $tree[$j] . "/";
			}
			else
			{
				$mypath .= $tree[$j];
			}
		}
		$tmp = $title[$i];
		
		if ($i != (sizeof ( $tree ) - 1))
		{
			$accesskey = getaccesskey ( $tmp, $mypath );
			$tit .= "<a accesskey=$accesskey href='index.php?mod=$mypath'>$tmp</a> &#187;&nbsp;";
		}
		else
		{
			$tit .= "<span style='text-weight:bold;'>$tmp</span>";
		}
	}
	return $tit;
}
/**
 * FN_OpenSection
 * apre una sezione
 * @param $title titolo sezione
 **/
function FN_OpenSection($title)
{
	global $_THEME_CFG;
	if ($_THEME_CFG['show_subsections_in_section'])
		FN_CreateSubmenu();
	OpenTableTitle($title);
}
/**
 * FN_CloseSection
 * chiude una sezione
 * @param $title titolo sezione
 **/
function FN_CloseSection()
{
	CloseTableTitle();
}
function OpenBlock($img, $title, $cfgfile="")
{
  echo "<div class=\"ui-widget ui-widget-content ui-corner-all ui-helper-clearfix flatnux-block\">";
	$cfgbtn = "";
  if( file_exists($cfgfile) && isadmin() ){ $cfgbtn = "<span class=\"ui-icon ui-icon-wrench flatnux-block-cfg\" onclick=\"opencfg('$cfgfile','$title')\"></span>"; }
  echo "<div class=\"ui-widget-header ui-corner-all flatnux-block-header\"><span class=\"ui-icon ui-icon-minusthick collapsable\"></span>{$cfgbtn}<img src=\"$img\" alt=\"$title\" />&nbsp;$title</div>";
	echo "<div class=\"flatnux-block-content\">";
}
function CloseBlock()
{
	echo "</div>";
	echo "</div>";
}
function FN_OpenNews($title)
{
	global $_THEME_CFG;
	static $i;
	if ($i == "")
		$i = 0;
	$i++;
	if ($_THEME_CFG['align_news_horizontal'] == 1)
	{
		if ($i % 2 == 1)
  		echo "<div style=\"float:left;width:49%;overflow:auto;padding:4px;clear:both;\">";
		else
		  echo "<div style=\"float:left;width:49%;overflow:auto;padding:4px;\">";
	}
//	else
//		echo "<br />";
	echo "<div class=\"ui-widget ui-corner-top ui-widget-content flatnux-block\">
	    <div class=\"ui-widget-header ui-corner-all flatnux-block-header\" style=\"padding-left:10px;\"><span class=\"ui-icon ui-icon-minusthick collapsable\"></span><h3>$title</h3></div><div class=\"flatnux-block-content\">";
}
function FN_CloseNews()
{
	global $_THEME_CFG;
	echo "</div></div>";
	if ($_THEME_CFG['align_news_horizontal'] == 1)
		echo "</div>";
}
function OpenTableTitle($title)
{
	echo "<div class=\"ui-widget-content ui-corner-all\" style=\"padding:10px;\"><div class=\"ui-widget-header ui-corner-all\" style=\"padding-left: 10px;\"><h3>$title</h3></div><div style=\"padding:10px;\">";
}
function CloseTableTitle()
{
	echo "</div></div>";
}
function OpenTable($optionalclass="") // tables with no headers
{
  echo "<div class=\"ui-widget ui-widget-content ui-corner-all $optionalclass\" style=\"margin-bottom:20px;\">\n";
}
function CloseTable()
{
	echo "</div>\n";
}
function FN_OpenFootNews()
{
	echo "
	<table width=\"100%\" style=\"text-align:center\" >
		<tr>
			<td style=\"text-align:center\" >
	";
}
function FN_CloseFootNews()
{
	echo "
			</td>
		</tr>
	</table>";
}

function xmldb_get_lang_img($lang)
{
	return "<img alt=\"$lang\" style=\"border:0px;\" src=\"".fromtheme("images/flags/$lang.png")."\" />";
}

function theme_doctype($charset="UTF-8"){
  $browser = new Browser ; 
  $xhtml = array("doctype" => "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.1//EN\" \"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd\">","htmlversion" => "xhtml11","metacharset" => "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=".$charset."\" />","closetag" => "/","metachromeframe" => "<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame\n Remove this if you use the .htaccess -->\n <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\" />");
  $html5 = array("doctype" => "<!DOCTYPE html>","htmlversion" => "html5","metacharset" => "<meta charset=\"".$charset."\" />","closetag" => "","metachromeframe" => "");
switch ($browser->Name) {
      case "msie":
      if( $browser->Version < 8 ) {
        return $xhtml;
      }
      else {
        return $html5;
      }
      break;
    case "firefox":
      if( $browser->Version < 3.5 ) {
        return $xhtml;
      }
      else {
        return $html5;
      }
      break;
    case "safari":
      if ( $browser->Version < 4 ) {
        return $xhtml;
      }
      else {
        return $html5;
      }
      break;  
    default:
      return $html5;
  }
  
}

function shift_brightness($hexcolor, $shiftvalue)
{
	// convert RGB hex values to decimal and calculate new values
	$R = hexdec(substr($hexcolor, 0,2))+($shiftvalue);
	$G = hexdec(substr($hexcolor, 2,2))+($shiftvalue);
	$B = hexdec(substr($hexcolor, 4,2))+($shiftvalue);
	// if new values are over the 255 limit, keep them at 255
	$R = ($R>255?255:$R);
	$G = ($G>255?255:$G);
	$B = ($B>255?255:$B);
	// of if the new values are under the 0 limit, keep them at 0
	$R = ($R<0?0:$R);
	$G = ($G<0?0:$G);
	$B = ($B<0?0:$B);
	
	// convert the new values back from decimal to hex
	$R = dechex($R);
	$G = dechex($G);
	$B = dechex($B);
	
	return $R.$G.$B;
}
function getlangs(){
        global $_FN;
        if ( count($_FN['listlanguages']) <= 1 )
        	return;
        $htmllanguages = array();
        foreach ( $_FN['listlanguages'] as $l )
        {
        	$ll = $l;
        	$a = getaccesskey($ll,"lang=$l");
        	$ak = "";
        	if ( $_FN['showaccesskey'] == 1 )
        		$ak = "[$a]";
        	$getvars = "";
        	foreach ( $_GET as $key=>$value )
        	{
        		$key = getparam($key,PAR_NULL,SAN_HTML);
        		$value = getparam($value,PAR_NULL,SAN_HTML);
        		if ( $key !== "mod" && $key != "lang" )
        		{
        			$getvars .= "&amp;$key=$value";
        		}
        	}
        	$ltitle = getLang("languages/$l.php.xml",$l,$l);
        	$htmllanguages[] = "<a accesskey=\"$a\" title=\"$ltitle\" href=\"" . fn_rewritelink("index.php?mod={$_FN['idmod']}&amp;lang={$l}$getvars") . "\"></a>";
        	if ($l==$_FN['lang']){$selected="selected=\"selected\"";} else {$selected = "";}
                $selectlanguages[] = "<option $selected class=\"$l\" value=\"". fn_rewritelink("index.php?mod={$_FN['idmod']}&amp;lang={$l}$getvars") . "\" title=\"$ltitle\">$l</option>";
        }
        echo "<span style='display:none;'>".implode("&nbsp;",$htmllanguages)."</span>";
        echo "<select class=\"customicons\" id=\"select_langs\" onchange=\"location.href=this.options[this.selectedIndex].value\">".implode("",$selectlanguages)."</select>";
}
// Custom javascripts-include function that operates a natsort on the files in the include/javascripts folder,
// seeing that the regular flatnux function doesn't
function MyIncludeJavascripts() {
	global $_FN;
	$path_js = "include/javascripts";
	if ( file_exists($path_js) )
	{
		$dir_js = opendir($path_js);
		$file_js = 0;
		while (false !== ($filename_js = readdir($dir_js)))
		{
			$extension_js = null;
			preg_match('/[\.]*[[:alpha:]]+$/s',$filename_js,$extension_js);
			if ( isset($extension_js[0]) && strtolower($extension_js[0]) == ".js" and $filename_js != "." and $filename_js != ".." )
			{
				$array_js[$file_js] = $filename_js;
				$file_js++ ;
			}
		}
		closedir($dir_js);
		fn_natsort($array_js);
                for ( $i = 0;$i < $file_js;$i++  )
		{
			echo "\n\t<script type=\"text/javascript\" src=\"" . $_FN['siteurl'] . "$path_js/$array_js[$i]\"></script>";
		}
	}
}

class Browser 
{ 
    private $props    = array("Version" => "0.0.0", 
                                "Name" => "unknown", 
                                "Agent" => "unknown") ; 

    public function __Construct() 
    { 
        $browsers = array("firefox", "msie", "opera", "chrome", "safari", 
                            "mozilla", "seamonkey",    "konqueror", "netscape", 
                            "gecko", "navigator", "mosaic", "lynx", "amaya", 
                            "omniweb", "avant", "camino", "flock", "aol"); 

        $this->Agent = strtolower($_SERVER['HTTP_USER_AGENT']); 
        foreach($browsers as $browser) 
        { 
            if (preg_match("#($browser)[/ ]?([0-9.]*)#", $this->Agent, $match)) 
            { 
                $this->Name = $match[1] ; 
                $this->Version = $match[2] ; 
                break ; 
            } 
        } 
    } 

    public function __Get($name) 
    { 
        if (!array_key_exists($name, $this->props)) 
        { 
            die ("No such property or function $name") ; 
        } 
        return $this->props[$name] ; 
    } 

    public function __Set($name, $val) 
    { 
        if (!array_key_exists($name, $this->props)) 
        { 
            SimpleError("No such property or function.", "Failed to set $name", $this->props) ; 
            die ; 
        } 
        $this->props[$name] = $val ; 
    } 

} 

?>