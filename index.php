<?php
///Includes///
include_once 'Internal_Functions/Settings/Settings.php';
$settings = new Settings();
include_once 'Internal_Functions/PageBuilder/PageBuilder.php';
$pageBuilder = new PageBuilder();
include_once 'Internal_Functions/Functions.php';
$functions = new Functions();
include_once 'Connection/_connect.php';
///Includes///

$page = $_SERVER['PATH_INFO'];
$page = trim($page, "/");

if ($page == "") {
    $page = stripslashes($pageBuilder::getInstance()->getMainPage());
}

$pageBuilder::getInstance()->buildPage($page);