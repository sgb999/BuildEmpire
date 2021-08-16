<?php
require_once('Database.php');
class Post
{
    protected $_dbConnection, $_dbInstance;

    public function __construct()
    {
        $this->_dbInstance = Database::getInstance();
        $this->_dbConnection = $this->_dbInstance->getDbConnection();
    }
    public function getPosts($symbol, $dateTime)
    {
        $sqlQuery = "SELECT postID, postHeader, userName, postDate FROM post, user WHERE postBy = userID AND postDate $symbol '$dateTime' LIMIT 21;";
        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        return $statement->fetchAll();
    }
    public function getProfilePosts($user)
    {
        $sqlQuery = "SELECT postHeader, postText, postDate FROM post WHERE postBy = (SELECT userID FROM user WHERE userName = '$user') LIMIT 20;";
        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        return $statement->fetchAll();
    }
    public function getSelectedPost($postID)
    {
        $sqlQuery = "SELECT postHeader, postText, postDate, userName FROM post, user WHERE postID = '$postID' AND userID = postBy";
        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        return $statement->fetchAll();
    }
}