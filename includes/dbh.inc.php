<?php
ob_start(); //Turns on output buffering


$timezone = date_default_timezone_set('Asia/Colombo');

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dbName = "fyp";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dbName);

if(!$conn){
    die("Connection failed: ".mysqli_connect_error());
}
