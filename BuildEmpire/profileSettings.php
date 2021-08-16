<?php
session_start();
if (isset($_SESSION['userName'])) {
    $view = new stdClass();
    $view->pageTitle = 'Homepage';
    require_once('Views/profileSettings.phtml');
}
else{
    header('Location: /index.php');
}