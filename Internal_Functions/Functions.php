<?php

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
        header("Location: ". $functions::getInstance()->getRoot().
                "/".$pageBuilder::getInstance()->getMainPage());
    } else {
        $_SESSION['Error'] = $loginAttempt[1];
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
        global $settings;

        return $settings->getSettings();
    }

    public function getRoot() {
        return $this->getSettings()->root;
    }

    public function getConnection() {
        global $connection;

        return $connection;
    }

    public function login($usernameString, $passwordHash) {
        global $settings;
        $users = $settings->getTable($settings->getLoginTable());

        $command = $this->getConnection()
                ->prepare("SELECT * FROM $users WHERE username = ? AND password = ?;");
        $command->bind_param($usernameString, $username);
        $command->bind_param($passwordHash, $password);
        
        $command->execute();
        $query = $command->get_result();

        $loginCheck = (mysqli_num_rows($query) == 0);

        if (!$loginCheck) {
            return array(false, "Incorrect Username or Password!");
        }
        
        $result = mysqli_fetch_assoc($query);

        return array(true, array($result[0], $result[3], $result[4]));
    }

    public function sessionCheck() {
        if (isset($_SESSION['User'])) {
            return true;
        }
        return false;
    }
}

include_once "Additional_Functions.php";