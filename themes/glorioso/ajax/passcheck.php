<?
  global $_FN;
  include_once("include/xmldb.php");
  $db = new XMLDatabase("fndatabase","misc");

  $pass = $_GET['password'];
  $query = "SELECT passwd FROM users WHERE username = '{$_GET['username']}'";
  $result = $db->Query($query);
  if(md5($pass)==$result[0]['passwd']){ echo "false"; }
  else{ echo "true"; }

?>