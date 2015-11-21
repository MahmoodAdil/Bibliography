<?php
error_reporting(-1);
ini_set('display_errors', 'On');

require_once "database.php";
$db = new Db();
if($db->createLibraryTable())
    echo "<h3>Table created.</h3>";
?>