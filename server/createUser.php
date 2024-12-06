<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'authorize.php';
    session_start();
    $user = unserialize($_SESSION['user']);

    $name = trim(filter_var($_POST['name']));
	$password = trim(filter_var($_POST['password']));
    $enableStatus = trim(filter_var('on'));
    $image = trim(filter_var('computer'));;
	$prava = trim(filter_var($_POST['prava']));

    if(strlen($name) < 5) {
        $error = "Доменное имя слишком короткое";
        echo $error;
    } else if (strlen($password) < 8) {
        $error = "Пароль слишком короткий";
        echo $error;
    } else if (strlen($prava) < 4) {
        $error = "Введите уровень доступа";
        echo $error;
    } else {

        $user->createUser($name, $password, $enableStatus, $image, $prava);

        $journal->createObject($user->ip, $name, 'computer');

        header('Location: ../index.php');
    }
} else {
    exit();
}


?>