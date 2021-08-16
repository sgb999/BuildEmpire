<?php
session_start();
header('Content-Type: text/plain');
$string = $_REQUEST["q"];
$array = explode("/", $string);
$token = $array[0];
if(isset($_SESSION['ajaxToken']) && $_SESSION['ajaxToken'] == $token){
    require_once ('../Classes/Post.php');
    $posts = new Post();
    if($array[1] == "null"){
        $symbol = "<=";
        $date = date("Y-m-d");
    }
    else{
        $symbol = ">=";
        $date = $array[1];
    }
    echo json_encode($posts->getPosts($symbol, $date));
}
?>