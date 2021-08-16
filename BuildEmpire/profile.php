<?php
$view = new stdClass();
$view->pageTitle = 'Homepage';
session_start();
$userName = implode($_GET);
require_once('Views/profile.phtml');