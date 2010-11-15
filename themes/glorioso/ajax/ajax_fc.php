<?php
include( $_SERVER['DOCUMENT_ROOT'] . "/include/flatnux.php" );
//funzioni per le news
$sctnews = find_section("news");
require_once ('sections/' . $sctnews . '/functions.php');
//if (is_news_admin()) { echo "hello world!"; }
if (is_news_admin()) { echo "ijsynuwesvaedjm"; }
else { echo "scnwogtunkwtsdavdjhm";  }
?>