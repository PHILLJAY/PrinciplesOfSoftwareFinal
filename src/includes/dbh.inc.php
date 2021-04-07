<?php

$serverName = "localhost";
$dBUsername = "root";
$dBPass = "";
$dBName = "gamble";
$db = mysqli_connect($serverName,$dBUsername,$dBPass,$dBName)or die("connection to database failed");