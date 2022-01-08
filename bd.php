<?php

$host="localhost";
$port=3306;
$socket="";
$user="rafael";
$password="rafaeladao2004";
$dbname="crud";

$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());
