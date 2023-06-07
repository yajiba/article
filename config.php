<?php
date_default_timezone_set("Asia/Bangkok");
$servername = "localhost";
$username = "root";
$password = "";
$database = "articles" ;

$mysqli = new mysqli($servername,$username,$password,$database);

// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}else {
    session_start();
    $_SESSION["db"] = $mysqli;

}
?>