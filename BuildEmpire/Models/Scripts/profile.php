<?php
session_start();
header('Content-Type: text/plain');
$string = $_REQUEST["q"];
$array = explode("/", $string);
//$array[0]  ajax token
//array[1]  username
if(isset($_SESSION['ajaxToken']) && $_SESSION['ajaxToken'] == $array[0]){
    require_once ('../Classes/User.php');
    $user = new User();
    echo json_encode($user->getUserProfile($array[1]));
}
?>