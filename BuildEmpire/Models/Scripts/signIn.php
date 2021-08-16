<?php
session_start();
header('Content-Type: text/plain');
$string = $_REQUEST["q"];
$array = explode("ʌ", $string);
$token = $array[0];
if(isset($_SESSION['ajaxToken']) && $_SESSION['ajaxToken'] == $token){
    require_once ('../Classes/User.php');
    $user = new User();
    $result = $user->login($array[1], $array[2]);
    if($result){
        $_SESSION['userID'] = $result['userID']; //sets a session to user_id
        $_SESSION['userName'] = $result['userName']; //sets a session to user_name
    echo 'success';
    }
    elseif (!$result){
        echo 'Incorrect username or password';
    }
}
?>