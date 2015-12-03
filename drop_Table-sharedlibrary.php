<?php
error_reporting(-1);
ini_set('display_errors', 'On');

require_once "database.php";
$db = new Db();
if($db->dropTablesharedlibrary())
    echo "<h3>Table Droped!.</h3>";
?>