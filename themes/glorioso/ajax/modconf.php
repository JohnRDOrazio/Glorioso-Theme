<?php

  chdir("..");
  chdir("..");
  chdir("..");
  require_once "include/flatnux.php";

			if ( !is_admin() )
			{
				echo fn_i18n("_NONPUOI");
				return;
			}

			$conf_file = null;
			if ( isset($_POST['conf_file']) )
				$conf_file = strippostpslashes($_POST['conf_file']);
			else
			if ( isset($_GET['conf_file']) )
				$conf_file = strippostpslashes($_GET['conf_file']);
			$fd = file($conf_file);

			$j = 0;
			$new_file = "";
			// scansione file alla ricerca delle variabili
			for ( $i = 0; $i < count($fd); $i++ )
			{
				$postvar = str_replace('$', '\$', str_replace("[", "\[", str_replace("]", "\]", strippostpslashes($_POST["conf_field$j"]))));
				if ( preg_match('/^' . $postvar . "./s", $fd[$i]) )
				{
					$oldvalue = xmldb_encode_preg(strippostpslashes($_POST["conf_value_old$j"]));
					$newvalue = xmldb_encode_preg_replace2nd(strippostpslashes($_POST["conf_value$j"]));
					if ( $oldvalue == "" )
						$new_file .= preg_replace('/=(.*?)("")/s', '=${1}"' . $newvalue . '"', $fd[$i]);
					else
						$new_file .= preg_replace('/=(.*?)(' . $oldvalue . ')/s', '=${1}' . $newvalue, $fd[$i]);
					if ( $j < ($_POST['conf_num'] - 1) )
						$j++;
				}
				else
				{
					$new_file .= $fd[$i];
				}
			}
			/* 		dprint_r($_POST);
			  dprint_xml($new_file); */
			$fd = fopen(stripslashes($conf_file), "wb");
			fwrite($fd, $new_file);
			fclose($fd);
			//dprint_xml($new_file);
?>