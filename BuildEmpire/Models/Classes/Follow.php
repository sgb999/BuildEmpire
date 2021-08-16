<?php
require_once('Database.php');
class Follow
{
    protected $_dbConnection, $_dbInstance;
    public function __construct()
    {
        $this->_dbInstance = Database::getInstance();
        $this->_dbConnection = $this->_dbInstance->getDbConnection();
    }

    public function setFollowers($follower, $following){
        $sqlQuery = "INSERT INTO follow(follower, following) VALUES('$follower', (SELECT userID FROM user WHERE userName = '$following'))";
        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        return $statement;
    }
    public function unfollow($follower, $following){
        $sqlQuery = "DELETE FROM follow WHERE follower = $follower AND following = (SELECT userID FROM user WHERE userName = '$following')";
        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        return $statement;
    }
    public function getFollow($follower, $following)
    {
        $sqlQuery = "SELECT * FROM follow WHERE follower = '$follower' AND following = (SELECT userID FROM user WHERE userName = '$following')";
        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        return $statement->fetch();
    }
    public function countFollowers($following)
    {
        $sqlQuery = "SELECT COUNT(follower) FROM follow WHERE following = (SELECT userID FROM user WHERE UserName = '$following');";
        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        return $statement->fetch();
    }
    public function followEach($follower, $following)
    {
        $sqlQuery = "SELECT DISTINCT follower, following FROM follow WHERE follower = '$follower' AND following = (SELECT userID FROM user WHERE userName = '$following') OR follower = (SELECT userID FROM user WHERE userName = '$following') AND following = '$follower';";
        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        return $statement->fetchAll();
    }
}