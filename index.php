<?php

include_once 'Internal_Functions/PageBuilder/PageBuilder.php';

$page = $_SERVER['PATH_INFO'];
$page = trim($page, "/");

if ($page == "") {
    $page = stripslashes(PageBuilder::getInstance()->getMainPage());
}

PageBuilder::getInstance()->buildPage($page);