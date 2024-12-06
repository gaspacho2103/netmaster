<?php
require 'authorize.php';
session_start();
$user = unserialize($_SESSION['user']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim(filter_var($_POST['name']));

    if(strlen($name) < 5) {
        $error = "Доменное имя слишком короткое";
        echo $error;
        exit();
    } else {   

        if (ip2long($name) == $user->selectUser($name)) {
            $user->deleteUser($name);
            $journal->deleteObject($user->ip, $name, 'computer');
            header('location: ../index.php');
        } else if (ip2long($name) == $switch->selectSwitch($name)) {
            $switch->deleteSwitch($name);
            $journal->deleteObject($user->ip, $name, 'switch');
            header('location: ../index.php');
        } else if (ip2long($name) == $router->selectRouter($name)) {
            $router->deleteRouter($name);
            $journal->deleteObject($user->ip, $name, 'router');
            header('location: ../index.php');
        }
        
    }
} else if($_SERVER['REQUEST_METHOD'] === 'GET') {
    $name = trim(filter_var($_GET['name']));

    if (ip2long($name) == $user->selectUser($name)) {
        $user->deleteUser($name);
        $journal->deleteObject($user->ip, $name, 'computer');
        header('location: ../index.php');
    } else if (ip2long($name) == $switch->selectSwitch($name)) {
        $switch->deleteSwitch($name);
        $journal->deleteObject($user->ip, $name, 'switch');
        header('location: ../index.php');
    } else if (ip2long($name) == $router->selectRouter($name)) {
        $router->deleteRouter($name);
        $journal->deleteObject($user->ip, $name, 'router');
        header('location: ../index.php');
    }
} else {
    exit();
}
?>