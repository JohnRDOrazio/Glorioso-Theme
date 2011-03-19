<?php
include( $_SERVER['DOCUMENT_ROOT'] . "/include/flatnux.php" );
//funzioni per le news
$sctnews = find_section("news");
require_once ('sections/' . $sctnews . '/functions.php');
if(!function_exists("is_news_admin"){
     function is_news_admin(){
          return is_news_administrator();
     }
}
if (is_news_admin()) { echo "ijsynuwesvaedjm"; }
else { echo "scnwogtunkwtsdavdjhm";  }
?>