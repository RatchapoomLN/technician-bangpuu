<?php
$link = mysqli_connect("localhost" , "root", "1043", "bangpu")
or die("Connect Failed! -> ".mysqli_error($link));
mysqli_query($link, "SET NAMES UTF8") or die(mysqli_error($link)); 
?>