<?php
session_start();
require_once('../Classes/User.php');
$user = new User();
$allowed = array('png', 'png', 'jpg', 'jpeg');
$filename = $_FILES['image']['name'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);
if (in_array($ext, $allowed)) {
    $name = $_SESSION['userName'] . "-" . rand(5, 400) . "-" . ".jpg";
    require_once('../Classes/User.php');
    $user = new User();
    $result = $user->getProfilePicture($_SESSION['userID']);
    if($result['profilePicture'] !== null){
        $user->updateUser('profilePicture', $name, $_SESSION['userID']);
        unlink("../../Images/" . $result['profilePicture']);
    }
     else{
         $user->updateUser('profilePicture', $name, $_SESSION['userID']);
     }
    $targetPath = "../../Images/" . $name;
    move_uploaded_file($_FILES["image"]["tmp_name"], $targetPath);
}