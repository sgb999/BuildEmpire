<?php
session_start();
header('Content-Type: text/plain');
$string = $_REQUEST["q"];
$array = explode("ʌ", $string);
if(sizeof($array) == 3) {
$token = $array[0];
if (isset($_SESSION['ajaxToken']) && $_SESSION['ajaxToken'] == $token) {
    require_once('../Classes/User.php');
    $user = new User();
        if ($array[1] == "userMessage") {
            $user->updateUser("userName", $array[2], $_SESSION['userID']);
            $result = $user->selectUser("userName", $_SESSION['userID'], $array[2]);
            if ($result) {
                $_SESSION['userName'] = $result['userName'];
                $tmp = "refresh";
                $outCome = "success";
            } else {
                $tmp = 'Failed to update username';
                $outCome = "error";
            }
            echo json_encode([$array[1], $tmp, $outCome]);
        }
        if ($array[1] == "emailMessage") {
            $user->updateUser("email", $array[2], $_SESSION['userID']);
            $result = $user->selectUser('email', $_SESSION['userID'], $array[2]);
            if($result){
                $tmp = 'your E-mail address has been updated';
                $outCome = "success";
            }
            if(!$result){
                $tmp = 'Failed to update E-mail';
                $outCome = "error";
            }
            echo json_encode([$array[1], $tmp, $outCome]);
        }
        if ($array[1] == "phoneMessage") {
            $user->updateUser("phoneNumber", $array[2], $_SESSION['userID']);
            $result = $user->selectUser('phoneNumber', $_SESSION['userID'], $array[2]);
            if($result){
                $tmp = 'Your phone number has been updated';
                $outCome = "success";
            }
            if(!$result){
                $tmp = 'Failed to update phone number';
                $outCome = "error";
            }
            echo json_encode([$array[1], $tmp, $outCome]);
        }
        if ($array[1] == "bioMessage") {
            $user->updateUser("bio", $array[2], $_SESSION['userID']);
            $result = $user->selectUser('bio', $_SESSION['userID'], $array[2]);
            if($result){
                $tmp =  'Your Bio has been updated';
                $outCome = "success";
            }
            if(!$result){
                $tmp = 'Failed to update Bio';
                $outCome = "error";
            }
            echo json_encode([$array[1], $tmp, $outCome]);
        }
        if ($array[1] == "DOBMessage") {
            $user->updateUser("dateOfBirth", $array[2], $_SESSION['userID']);
            $result = $user->selectUser('dateOfBirth', $_SESSION['userID'], $array[2]);
            if($result){
                $tmp = 'Your Date Of Birth has been updated';
                $outCome = "success";
            }if(!$result){
                $tmp = 'Failed to update Date Of Birth';
                $outCome = "error";
            }
            echo json_encode([$array[1], $tmp, $outCome]);
        }
    if ($array[1] == "deleteProfilePicture") {
        $result = $user->getProfilePicture($_SESSION['userID']);
        if($result['profilePicture'] !== null){
            $user->updateUser('profilePicture', 'blankProfilePicture.png', $_SESSION['userID']);
            unlink("../../Images/" . $result['profilePicture']);
        }
    }
    if ($array[1] == "delete") {
        $user->deleteFollow($_SESSION['userID']);
        $user->deleteAllPosts($_SESSION['userID']);
        $user->deleteUserAccount($_SESSION['userID']);
        echo json_encode(["delete", "null"]);
    }
    }
}