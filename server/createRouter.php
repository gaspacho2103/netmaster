<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'authorize.php';
    session_start();
    $user = unserialize($_SESSION['user']);

    $name = trim(filter_var($_POST['name']));
    $enableStatus = trim(filter_var('on'));
    $image = trim(filter_var('router'));

    if(strlen($name) < 5) {
        $error = "Доменное имя слишком короткое";
        echo $error;
        exit();
    } else {

        $router->createRouter($name, $enableStatus, $image);

        $journal->createObject($user->ip, $name, 'router');
        
	    header('Location: ../index.php');
    }
} else {
    exit();
}
?>