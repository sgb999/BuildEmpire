<?php
require_once('Database.php');
class User
{
    protected $_dbConnection, $_dbInstance;

    public function __construct()
    {
        $this->_dbInstance = Database::getInstance();
        $this->_dbConnection = $this->_dbInstance->getDbConnection();
    }
    public function login($username, $password)
    {
        $sqlQuery = "SELECT userID, userName, password FROM user WHERE userName = '$username' AND password = sha2('$password', 256);";
        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        return $statement->fetch();
    }
    public function signUp($userName, $name, $email, $DOB, $phoneNumber,$password){
        $sqlQuery = "INSERT INTO user (userName, name, email, dateOFBirth, phoneNumber, password) VALUES('$userName', '$name', '$email', '$DOB', '$phoneNumber', sha2('$password', 256));";
        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        return $statement;
    }
    public function getUserProfile($username)
    {
        $sqlQuery = "SELECT userName, bio, profilePicture FROM user WHERE username = '$username';";
        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        return $statement->fetchAll();
    }
    public function selectUser($rowName, $userID, $update)
    {
        $sqlQuery = "SELECT $rowName from user WHERE userID = '$userID' AND $rowName = '$update'";
        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        return $statement->fetch();
    }
    public function getProfilePicture($userID){
        $sqlQuery = "SELECT profilePicture FROM user WHERE userID = '$userID';";
        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        return $statement->fetch();
    }
    public function deleteUserAccount($userID)
    {
        $sqlQuery = "DELETE FROM user WHERE userID = '$userID';";
        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        return $statement->fetch();
    }
    public function deleteAllPosts($userID)
    {
        $sqlQuery = "DELETE FROM post WHERE postBy = '$userID';";
        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        return $statement->fetch();
    }
    public function deleteFollow($userID)
    {
        $sqlQuery = "DELETE FROM follow WHERE follower = '$userID' OR following = '$userID';";
        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        return $statement->fetch();
    }
    public function updateUser($column, $update, $userID)
    {
        $sqlQuery = "UPDATE user SET $column = '$update' WHERE userID = '$userID';";
        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        return $statement->fetch();
    }
    function checkUsername($userName){
        $sqlQuery = "SELECT * FROM user WHERE userName = '$userName';";
        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        return $statement->fetch();
    }
    function checkUserEmail($email){
        $sqlQuery = "SELECT * FROM user WHERE email = '$email';";
        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        return $statement->fetch();
    }
    function checkUserPhone($phone){
        $sqlQuery = "SELECT * FROM user WHERE phoneNumber = '$phone';";
        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        return $statement->fetch();
    }
}