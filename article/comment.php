<?php

include 'db.php';
/**@var $connection_loc*/

if (array_key_exists('hash', $_COOKIE) and array_key_exists('login', $_COOKIE)) {
    $hash = $_COOKIE['hash'];
    $login = $_COOKIE['login'];
    $command = "select * from users where hash ='$hash' and login = '$login'";
    $rows = mysqli_query($connection_loc, $command);
    $row = mysqli_fetch_array($rows);
}

$res = array('res'=>0);

if ($_POST) {
    if (array_key_exists('comm', $_POST)) {
        $comm = $_POST['comm'];
        $user = $row['id'];
        $time = time();
        $command = "INSERT INTO comments (text, user, time) VALUES ('$comm','$user','$time')";
        mysqli_query($connection_loc, $command);
        if ($connection_loc->errno == 0) {
            $res['res'] = '1';
        }
    }
    if (array_key_exists('text', $_POST)) {
        $comm = $_POST['text'];
        $user = $row['id'];
        $id_comm = $_POST['id'];
        $time = time();
        $command = "UPDATE comments SET text = '$comm', time = '$time' WHERE id='$id_comm'";
        mysqli_query($connection_loc, $command);
        if ($connection_loc->errno == 0) {
            $res['res'] = '1';
        }
    }
    if (array_key_exists('parent', $_POST)) {
        $comm = $_POST['text'];
        if ($comm) {
            $parent = $_POST['parent'];
            $user = $row['id'];
            $command = "select * from comments where id = '$parent'";
            $rows = mysqli_query($connection_loc, $command);
            $row = mysqli_fetch_array($rows);
            if ($row['levl'] == 0) {
                $m_parent = $parent;
                $levl = 1;
            } else{
                $m_parent = $row['main_parent'];
                $levl = 1+$row['levl'];
            }
            $time = time();
            $command = "INSERT INTO comments (text, user, parent, main_parent,levl,time) VALUES ('$comm','$user', '$parent', '$m_parent', '$levl', '$time')";
            mysqli_query($connection_loc, $command);
            if ($connection_loc->errno == 0) {
                $res['res'] = '2';
            }
        } else{
            $res['res'] = '1';
        }
    }
}
echo json_encode($res);