<fb:dashboard></fb:dashboard>
<div style="margin:15px auto 15px auto;border:3px inset Orange;background:LightYellow;width:75%;">

<?php

if(isset($_POST["ids"])) {
	echo "<center>Grazie per aver invitato ".sizeof($_POST["ids"])." dei tuoi amici a <b><a href=\"index.php\">Parrocchia San Lino</a></b>.<br /><br />\n";
        $friends_invited = implode("'></fb:name>,<fb:name uid='", $_POST["ids"]);
        echo "Hai invitato: <fb:name uid='".$friends_invited."'></fb:name>";

	echo "<h2><a href=\"index.php\">Clicca qui per tornare a Parrocchia San Lino</a>.</h2></center>";
}


?>

</div>