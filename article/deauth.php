<?php

include 'db.php';
/**@var $connection_loc*/

$login = $_COOKIE['login'];

$command = "select id from users where login='$login'";
$rows = mysqli_query($connection_loc, $command);

$row = mysqli_fetch_array($rows);
$id = $row['id'];

$command = "UPDATE users SET hash = '0' WHERE id='$id'";
mysqli_query($connection_loc, $command);


setcookie('hash', null, -1);
setcookie('login', null, -1);