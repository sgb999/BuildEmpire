<?php
session_start();
unset($_SESSION['userID']); //ends user_id session
unset($_SESSION['userName']); //ends user_name session
header("Location: index.php"); //redirects to index page
exit;