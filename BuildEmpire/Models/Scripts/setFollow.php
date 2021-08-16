<?php
header('Content-Type: text/plain');
require_once ('../Classes/Follow.php');
$follow = new Follow();
$string = $_REQUEST["q"];
session_start();
$result = $follow->getFollow($_SESSION['userID'], $string);
if(!$result){
    $result = $follow->setFollowers($_SESSION['userID'], $string);
}
else{
    $result = $follow->unfollow($_SESSION['userID'], $string);
}
?>