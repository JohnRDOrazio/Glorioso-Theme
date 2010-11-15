 <?php
	
	
global $_FN,$_FB;
chdir("..");
chdir("..");
chdir("..");
include_once("include/flatnux.php");
if(isset($_POST['vmod'])){ $_FN['vmod'] = $_POST['vmod']; }

	$opindex = getparam("opindex",PAR_GET,SAN_FLAT);
	if ( $_FN['mod'] == "modcont" )
		$opindex = "modcont";
		
	if ( $opindex )
	{
		$filetomodify = getparam("file",PAR_GET,SAN_FLAT);
		if ( $filetomodify != "" && can_modify_file($_FN['user'],$filetomodify) )
		{
			if ( fn_erg('config.php$',$filetomodify) )
				gl_editconffile($filetomodify);
			else
				edit_content($filetomodify);
		}
	}
	else
	{
		$sectionborders = true;
		if ( $_FN['show_welcome_message'] !== 0 && $_FN['vmod'] == $_FN['home_section'] )
			if (  !isset($_GET['op']) &&  !isset($_GET['opindex']) )
			{
				$sectionborders = false; //non visualizzo footer sezione e bordi
				showmotd();				
			}
		if ( $_FN['vmod'] != "" ) //se esiste la sezione di default
		{
			if ( ($_FN['show_welcome_message'] === 0) )
				$sectionborders = true;
			view_section($_FN['vmod'],$sectionborders);
		}
		
		ShowAdminOptions();		
	}

/**
 * Estrae i file di configurazione e li stampa a video per la modifica.
 *
 * Esempio formattazione:
 * #[it]Titolo in italiano {opzione1=1,opzione2=2}
 * #[en]Title 2 in english 
 * $nomevariabile // {string}
 * #[it]Titolo 2 in italiano 
 * #[en]Title 2 in english 
 * $nomevariabile2 // {color}
 *
 * @param   string  $file      nome del file
 */
/**
 * Edit config file
 * 
 * Sample:
 * #[it]Titolo in italiano {opzione1=1,opzione2=2}
 * #[en]Title 2 in english 
 * $nomevariabile // {string}
 * #[it]Titolo 2 in italiano 
 * #[en]Title 2 in english 
 * $nomevariabile2 // {color}
 * 
 * 
 * @param string $file
 * @param string $from
 */
function gl_editconffile($file, $from = false)
{
	global $_FN;
	$lang = $_FN['lang'];
	if (  !file_exists($file) ) // controllo che il file esista prima di fare qualsiasi operazione
		return;
	if ( $from == false )
	{
		$from = isset($_GET['from']) ? $_GET['from'] : getparam("HTTP_REFERER",PAR_SERVER,SAN_FLAT);
		if ( $from == "" )
			$from = "index.php";
	}
	echo "
<!-- lista dei campi da modificare in textfields -->
<form action=\"verify.php\" method=\"post\"><input type=\"hidden\" name=\"mod\"
	value=\"modconfig\" /> <input type=\"hidden\" name=\"conf_file\"
	value=\"$file\"> <!-- nome file di configurazione da modificare --> <input
	type=\"hidden\" name=\"from\" value=\"$from\" />
<table border=\"0\" cellpadding=\"1\" cellspacing=\"0\">
	<tbody>
";
	$ffile = $file;
	$fg = file($file);
	$j = 0;
	// scansione file alla ricerca delle variabili
	for ( $i = 0;$i < count($fg);$i++  )
	{
		if ( preg_match('/^\$./s',$fg[$i]) && strpos($fg[$i],"Array();")===false ) // prende solo le righe che iniziano col carattere "$" e che non sia una variabile dichiarata come array
		{
			$line_tmp1 = explode("=",$fg[$i]); // get variable and it's value
			unset($line_tmp1[0]);
			$line_tmp1 = implode("=",$line_tmp1);
			$varvalue = "";
			eval('$varvalue=' . $line_tmp1);
			$line_tmp = explode(";",$fg[$i]); // cancella eventuali commenti a dx della variabile
			$type = "";
			$onchange = "";
			$class = "";
			//ricavo il tipo di campo -->
			if ( isset($line_tmp[1]) )
				preg_match('/[\{].+[\}]/i',$line_tmp[1],$type);
			if ( isset($type[0]) )
				$type = trim($type[0]);
			else
				$type = "";
			switch ( $type )
			{
			  case "{color}":
			     $class = "cfg_colorpicker";
           break;
        case "{slider}":
            $class = "cfg_slider";
            break;
        case "{image}":
            $class = "cfg_image";
            $onchange = "onchange=\"$(this).next('img').attr( 'src', this.value )\""; 
      }
			//ricavo il tipo di campo <--
			$line = explode("=",$line_tmp[0]); // separa variabile e valorizzazione
			$title = "";
			$options = false;
			// cerca il titolo tradotto, se non esiste usa il primo oppure il nome della variabile 
			$find = 1;
			$exists = false;
			while (preg_match('/^#./s',$fg[$i - $find]) &&  !($exists = preg_match('/^#\[' . $lang . '\]./s',$fg[$i - $find])))
			{
				$find++ ;
			}
			if ( !$exists )
				$find = 1;
			if ( preg_match('/^#./s',$fg[$i - $find]) )
			{
				$title = preg_replace('/^#/s',"",$fg[$i - $find]);
				$t = "";
				preg_match('/[\{].+[\}]/i',$title,$t);
				if ( isset($t[0]) )
				{
					$options = explode(',',str_replace("{","",str_replace("}","",$t[0])));
				}
			}
			if ( preg_match('/^\\/\\/./s',$fg[$i - 1]) )
			{
				$title = preg_replace('/^\\/\\//s',"",$fg[$i - 1]);
			}
			$title = preg_replace('/\{.+\}/s','',$title);
			$title = preg_replace('/\[' . $lang . ']/s','',$title);
			$title = htmlentities(trim($title));
			$varname = htmlentities(ucfirst(str_replace("_"," ",trim(preg_replace('/^\$/s','',$line[0])))));
			if ( $title == "" )
				$title = $varname;
			echo "<tr><td style=\"border-bottom:1px dotted #dadada;text-align:left;\">";
			echo "\n<i>$title:</i><input type=\"hidden\" name=\"conf_field$j\" value=\"{$line[0]}\" />";
			echo "</td><td style=\"border-bottom:1px dotted #dadada;text-align:left;\">";
			if (  !$options )
			{
        echo ( $class == "cfg_image" ) ? "<textarea title=\"$varname\" $onchange class=\"$class\" name=\"conf_value$j\" id=\"conf_value$j\" cols=\"30\">" . htmlentities($varvalue) . "</textarea><img height=32 style='border:inset 1px White;padding:2px;margin-left:10px;' src='".$varvalue."' alt='no image' /><button type='button' onclick=\"window.open('glorioso_filemanager.php?opener=conf_value$j&filemanager_editor=yup&onchange=1&dir=themes/glorioso/images/','filemanager','toolbar=1,location=1,directories=0,status=0 ,menubar=0,scrollbars=1,resizable=1,width=640,height=480');\">Scegli altro file</button>" : "<input title=\"$varname\" $onchange class=\"$class\" type=\"text\" name=\"conf_value$j\" size=\"50\" maxlength=\"1200\" value=\"" . htmlentities($varvalue) . "\" />"; 
      }
			else
			{
				//---------checkbox----------------------->
				if ( $options[0][0] == "+" )
				{
				}
				//---------checkbox-----------------------<
				else
				{
					$onchange = "";
					$script = "onchange=\"this.options[this.selectedIndex].onfocus()\"";
					$script .= " onkeyup=\"this.options[this.selectedIndex].onfocus()\"";
					$divid = "conf_$i";
					echo "<select $script $onchange name=\"conf_value$j\"  >";
					$script = "document.getElementById('$divid').innerHTML = '" . addslashes("") . "'";
					foreach ( $options as $val )
					{
						$valdesc = trim($val);
						if ( preg_match("/=/s",$valdesc) )
						{
							$t = explode("=",$valdesc);
							$val = trim($t[0]);
							$valdesc = trim($t[1]);
							$s = ($val == trim($line[1],"\" ")) ? "selected=\"selected\"" : "";
							echo "<option onfocus=\"$script\" $s value=\"$val\">$valdesc</option>";
						}
					}
					echo "</select>";
				}
			}
			$v = trim($line[1],"\" ");
			?>
<input type="hidden" name="conf_value_old<?php
			echo $j?>"
	value="<?php
			echo htmlentities($varvalue)?>" />
</td>
</tr>
<?php
			$j++ ;
		}
	}
	?>
<tr>
	<td colspan="2"><input type="button" class="button" name="prev"
		onclick='window.location=("<?php
	echo $from?>")'
		value="<?php
	echo fn_i18n("_CANCEL")?>" />
		<?php
	if ( is_writable($ffile) )
	{
		?>
		<input type="submit" class="submit" name="save"
		value="<?php
		echo fn_i18n("_SAVE")?>" />
		<?php
	}
	else
	{
		echo fn_i18n("_READONLY");
	}
	?>
		</td>
  </tr>
	</tbody>
	</table>
	<br />
	<input type="hidden" name="conf_num" value="<?php
	echo $j?>">
	<!-- numero di campi totali da modificare -->
	</form>
<?php

}


?>