<?php
header('Content-Type: text/plain');
require_once ('../Classes/Follow.php');
$follow = new Follow();
$string = $_REQUEST["q"];
session_start();
$array = explode("/", $string);
$ajaxToken = $array[0];
if(isset($_SESSION['ajaxToken']) && $_SESSION['ajaxToken'] == $ajaxToken) {
   $userName = $array[1];
   $result = $follow->followEach($_SESSION['userID'], $userName);
   if(count($result) == 2) {
       if ($result) {
           echo "true";
       } else {
           echo "false";
       }
   }
}
?>