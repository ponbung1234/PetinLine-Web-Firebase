<?php
$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$cleardb_server = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db = substr($cleardb_url["path"],1);

// $servername = "localhost";
// $username = "pon";
// $password = "ilockpon1234";
// $dbname = "shd";
$servername = $cleardb_server ;
$username = $cleardb_username;
$password = $cleardb_password;
$dbname = $cleardb_db ;

// Create connection
$connect = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($connect, "utf8");
// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}