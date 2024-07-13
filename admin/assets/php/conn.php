<?php

$hostname = 'localhost';
$uname = 'root';
$pass = '';
$database = 'minor_project';

$conn = new mysqli($hostname, $uname, $pass, $database);

if ($conn->connect_error) {
    die('connnection failed' . $conn->connect_error);
}