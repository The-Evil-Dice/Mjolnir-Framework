<?php

session_start(); //Begins the user's session, which is used to store their userdata, and identifies them when multiple users are accessing the webapp.

$_TABLES = array(
    'Accounts' => 'Accounts',
    'Usernames' => 'Usernames',
    'Punishments' => 'Punishments',
    'IP_Addresses' => 'IP_Addresses'
);

$connection = new mysqli(
        Settings::getInstance()->getSettings()->DBMS->host,
        Settings::getInstance()->getSettings()->DBMS->username,
        Settings::getInstance()->getSettings()->DBMS->password,
        Settings::getInstance()->getSettings()->DBMS->database,
        Settings::getInstance()->getSettings()->DBMS->port)
        or die("Error: Unable to connect to database:" . PHP_EOL);
