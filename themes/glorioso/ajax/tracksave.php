<?php
chdir("..");
chdir("..");
chdir("..");
if(file_exists("themes/glorioso/tracksave.php")){
  $fd = file("themes/glorioso/tracksave.php");
  $fd[$_POST["step"]] = "$"."saved['step".$_POST["step"]."'] = true;\n";
  $newfile = implode("",$fd);
  $fd = fopen("themes/glorioso/tracksave.php","w");
  fwrite($fd,$newfile);
  fclose($fd);
}
else{ echo "Could not find tracksave file... \n"; }
?>