<?php
/* Compatible with TrinityCore       *
 * (c) 2011 Wheth <whethx@gmail.com> */

//session_start(); // Allows user management, not needed now
require_once("./include/config.php"); // Configuration file
//require_once("./include/functions.php"); // Functions file, not needed now
require_once("./include/classes.php"); // Classes file

$config = new Config; // Loads class Config
$config = $config->getConfig(); // Loads config data

$database = new Database();
$database->dbConnect();
//require_once("./modules/ServerUptime.php");
//echo '<br>';
//require_once("./modules/NewAccount.php");
//echo '<br>';
//require_once("./modules/RealmFirsts.php");
$database->dbClose();
?>