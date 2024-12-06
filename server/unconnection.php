<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	require 'authorize.php';
	session_start();
    $user = unserialize($_SESSION['user']);

    $name1 = trim(filter_var($_POST['firstName']));
	$type1 = trim(filter_var($_POST['firstType']));
	$name2 = trim(filter_var($_POST['secondName']));
	$type2 = trim(filter_var($_POST['secondType']));

	$error = null;

	if (strlen($name1) < 5)
        $error = "Доменное имя слишком короткое";
	else if (strlen($type1) <= 5)
		$error = 'Введите тип устройства';
	else if (strlen($name2) < 5)
        $error = "Доменное имя слишком короткое";
	else if (strlen($type2) <= 5)
		$error = 'Введите тип устройства';

	if($error != null) {
		echo $error;
		exit();
	}

    if ($type1 == 'computer' && $type2 == 'switch') {

        $user->unconnectUser($name1, $name2);

		$journal->unconnectObject($user->ip, $name1, $name2, $type1, $type2);

        header('Location: ../index.php');
    } else if ($type1 == 'switch' && $type2 == 'computer') {
		
		$user->unconnectUser($name2, $name1);

		$journal->unconnectObject($user->ip, $name2, $name1, $type1, $type2);

		header('Location: ../index.php');
	} else if ($type1 == 'switch' && $type2 == 'switch') {
		
		$switch->unconnectSwitchToSwitch($name1, $name2);

		$journal->unconnectObject($user->ip, $name1, $name2, $type1, $type2);

		header('Location: ../index.php');
	} else if ($type1 == 'switch' && $type2 == 'router') {

        if($router->selectRouterPort1($name2)) {

			$switch->unconnectSwitchToRouter($name1);
			$router->unconnectRouterToPort1($name2);

			$journal->unconnectObject($user->ip, $name1, $name2, $type1, $type2);

			header('Location: ../index.php');
        } else if($router->selectRouterPort2($name2)) {
			
			$switch->unconnectSwitchToRouter($name1);
			$router->unconnectRouterToPort2($name2);

			$journal->unconnectObject($user->ip, $name1, $name2, $type1, $type2);

			header('Location: ../index.php');
        }

	} else if ($type1 == 'router' && $type2 == 'switch') {
		if($router->selectRouterPort1($name1)) {
			
			$switch->unconnectSwitchToRouter($name2);
			$router->unconnectRouterToPort1($name1);

			$journal->unconnectObject($user->ip, $name2, $name1, $type1, $type2);

			header('Location: ../index.php');
        } else if($router->selectRouterPort2($name1)) {
			
			$switch->unconnectSwitchToRouter($name2);
			$router->unconnectRouterToPort2($name1);

			$journal->unconnectObject($user->ip, $name2, $name1, $type1, $type2);

			header('Location: ../index.php');
        }
	}
} else {
	exit();
}
?>