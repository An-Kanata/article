<?php

include 'db.php';
/**@var $connection_loc*/

function rand_str()
{
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $strength = rand(10, 16);
    $input_length = strlen($permitted_chars);
    $random_string = '';
    for ($i = 0; $i < $strength; $i++) {
        $random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
    $random_string = md5(md5($random_string));
    return $random_string;
}

if ($_POST and $_POST['login'] and $_POST['pass']) {
    $login = $_POST['login'];
    $pass = md5(md5($_POST['pass']));
    $hash = rand_str();
    setcookie('hash', $hash, time()+(60*60*12));
    setcookie('login', $login, time()+(60*60*12));
    $command = "INSERT INTO users (login, password,hash) VALUES ('$login','$pass','$hash')";
    mysqli_query($connection_loc, $command);
    $res = array();
    if ($connection_loc->errno == 0) {
        $res['res'] = '1';
    } else {
        $res['res'] = '0';
    }
}


echo json_encode($res);