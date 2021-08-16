<?php

session_start();
$view = new stdClass();
$view->pageTitle = 'Posts';
require_once('Models/MySQL.php');
$post_id = implode($_GET);
$MySQL = new MySQL();
if (isset($_SESSION['user_name'])) //checks if user has logged in
{
    if (isset($_POST['submit'])) {
        $result = $MySQL->setComment($_POST['comment'], ($topic_id));
    }
}
$allMySQL = $MySQL->getPosts($post_id);
$view->MySQL = $allMySQL;
require_once('Views/replies2.phtml');
//foreach ($MySQL as $replies) {
//<tr><td><h3><?php echo $replies['reply']; </h3></td>
//</tr>
//<p></p>
//<tr><td><?php echo $replies['user_name']; </td>
//</tr>
//<p></p>
//<tr><td><?php echo $replies['reply_date']; </td>
//</tr>
//<p></p>