<?php
session_start();
header('Content-Type: text/plain');
$string = $_REQUEST["q"];
$array = explode("/", $string);
$token = $array[0];
if(isset($_SESSION['ajaxToken']) && $_SESSION['ajaxToken'] == $token){
    require_once ('../Classes/Post.php');
    $posts = new Post();
    $postID = $array[1];
    echo json_encode($posts->getSelectedPost($postID));
}
?>