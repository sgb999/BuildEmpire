<?php
$view = new stdClass();
$view->pageTitle = 'Post';
$postID = implode($_GET);
session_start();
require_once('Views/selectedPosts.phtml');