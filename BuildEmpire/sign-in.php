<?php
session_start();
if (isset($_SESSION['userName'])) {
    header('Location: /index.php');
}
$view = new stdClass();
$view->pageTitle = 'Sign In';
require_once('Views/sign-in.phtml');