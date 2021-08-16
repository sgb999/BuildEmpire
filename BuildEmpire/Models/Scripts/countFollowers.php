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
    echo json_encode($follow->countFollowers($userName));
}
?>