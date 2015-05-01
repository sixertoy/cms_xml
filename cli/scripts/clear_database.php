<?php
$db_passwd = "";
$db_name = "pure";
$db_username = "root";
$db_host = "localhost";

$pdo_options = array();
$dsn = "mysql:host=".$db_host.";dbname=".$db_name;
$conn = new PDO( $dsn, $db_username, $db_passwd, $pdo_options );
$conn->exec( "DROP DATABASE `".$db_name."`" );
$conn->exec( "CREATE DATABASE `".$db_name."`" );