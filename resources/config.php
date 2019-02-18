<?php

//send request to php server
ob_start();

session_start();
//session_destroy();

//get the file path, which is absolute path of file

define("DS") ? null: define("DS", DIRECTORY_SEPARATOR);

//get front file path
define("TEMPLATE_FRONT") ? null: define("TEMPLATE_FRONT", __DIR__ . DS ."templates/front");

//get back file path
define("TEMPLATE_BACK") ? null: define("TEMPLATE_BACK", __DIR__ . DS ."templates/back");

//set database
define("DB_HOST", "localhost");

define("DB_USER", "root");

define("DB_PASS", "root");

define("DB_NAME", "ecom_db");

//connect to database
$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

require_once("function.php");
require_once("cart.php");


?>