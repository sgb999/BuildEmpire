<?php
session_start();
header('Content-Type: text/plain');
$string = $_REQUEST["q"];
$array = explode("ʌ", $string);
$token = $array[0];
if(isset($_SESSION['ajaxToken']) && $_SESSION['ajaxToken'] == $token) {
    if (count($array) == 7) {
        $name = $array[1];
        $userName = $array[2];
        $email = $array[3];
        $DOB = $array[4];
        $phone = $array[5];
        $password = $array[6];
        require_once('../Classes/User.php');
        $user = new User();
        $result = $user->checkUsername($userName);
        if (!$result) {
            $result = $user->checkUserEmail($email);
            if (!$result) {
                $result = $user->checkUserPhone($phone);
                if (!$result) {
                    $result = $user->signUp($userName, $name, $email, $phone, $DOB, $password);
                    $result = $user->login($userName, $password);
                        if ($result) {
                            $_SESSION['userID'] = $result['userID']; //sets a session to user_id
                            $_SESSION['userName'] = $result['userName']; //sets a session to user_name
                            echo json_encode(['success']);
                        }
                }
                echo json_encode(["error"], ["phone number already in use"]);
            }
            echo json_encode(["error"], ["email already in use"]);
        }
        echo json_encode(["error"], ["username already in use"]);
    }
}
?>