<?php

include_once 'Connection/_connect.php';

if (isset($_POST['login'])) {
    $functions = new Functions();
    
    $username = $_POST['username'];
    $password = hash("sha256",
            hash("sha256",
                    $functions::getInstance()->getSettings()->salt.$_POST['password'])
            .$functions::getInstance()->getSettings()->salt);

    $username = stripslashes($username);
    $username = $connection->real_escape_string($username);

    $password = stripslashes($password);
    $password = $connection->real_escape_string($password);
    
    $password = str_split($password, strlen($password)/2);
    
    $loginAttempt = $functions::getInstance()->login($username, $password[1].$password[0]);
    
    if ($loginAttempt[0]) {
        $_SESSION['User'] = $loginAttempt[1];
        header("Location: ". $functions::getInstance()->getRoot() ."/Dashboard/");
    } else {
        $_SESSION['Error'] = $loginAttempt[1];
        //print $password[1].$password[0];
        header("Location: ". $functions::getInstance()->getRoot());
    }
} else if (isset($_POST['logout'])) {
    $functions = new Functions();
    session_destroy();
    header("Location: ". $functions::getInstance()->getRoot());
}

class Functions {

    protected static $_instance;

    public static final function getInstance() {
        if (!self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function getSettings() {
        return Settings::getInstance()->getSettings();
    }

    public function getRoot() {
        return $this->getSettings()->root;
    }

    public function getConnection() {
        global $connection;

        return $connection;
    }

    public function getTable($tablename = NULL) {
        global $_TABLES;
        if ($tablename == NULL) {
            return $_TABLES;
        }

        return $_TABLES[$tablename];
    }

    public function login($username, $passwordHash) {
        $accountsTable = $this->getTable('Accounts');
        $usernames = $this->getTable('Usernames');

        $command = "SELECT UserID FROM $usernames WHERE Username = '$username' ORDER BY UsernameID desc LIMIT 1;";
        $query1 = mysqli_query($this->getConnection(), $command) or die(mysqli_error());

        $userExists = (mysqli_num_rows($query1) > 0);

        if (!$userExists) {
            return array(false, "Incorrect Username!");
        }

        $userID = mysqli_fetch_row($query1)[0];

        $command = "SELECT * FROM $accountsTable"
                . " LEFT JOIN $usernames ON $accountsTable.UserID=$usernames.UserID"
                . " WHERE $accountsTable.UserID = '$userID' AND Username = '$username' ORDER BY UsernameID desc LIMIT 1;";
        $query2 = mysqli_query($this->getConnection(), $command) or die(mysqli_error());

        $result = mysqli_fetch_row($query2);

        $passwordCheck = $result[1] == $passwordHash;

        if (!$passwordCheck) {
            return array(false, "Incorrect Password!");
        }

        return array(true, array($result[0], $result[3], $result[4]));
    }

    public function sessionCheck() {
        if (isset($_SESSION['User'])) {
            return true;
        }
        //header("Location: ". $this->getRoot() ."/index.php");
        return false;
    }
}