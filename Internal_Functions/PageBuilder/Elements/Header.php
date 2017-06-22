<?php
global $page;
$root = Functions::getInstance()->getRoot();

if ($page != "Login") {
    Functions::getInstance()->sessionCheck();
}
?>
<html>
    <head>
        <meta charset='UTF-8'>

        <link rel='stylesheet' type='text/css' href='<?php print $root; ?>/Design/Bootstrap/css/bootstrap.min.css'>
        <link rel='stylesheet' type='text/css' href='<?php print $root; ?>/Design/Style.css'>
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js'></script>
        <script src='<?php print $root; ?>/Design/Bootstrap/js/bootstrap.min.js'></script>

        <title><?php print $page; ?></title>
    </head>