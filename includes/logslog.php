<?php
require("logcon.php");
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS) or die(mysqli_error());
    mysqli_select_db($con,DB_NAME) or die("Нет подключения к базе");
	
    ?>