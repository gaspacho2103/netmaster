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

		$user->connectUser($name1, $name2);

		$journal->connectObject($user->ip, $name1, $name2, $type1, $type2);

        header('Location: ../index.php');
    } else if ($type1 == 'switch' && $type2 == 'computer') {
		
		$user->connectUser($name2, $name1);

		$journal->connectObject($user->ip, $name2, $name1, $type1, $type2);

		header('Location: ../index.php');
	} else if ($type1 == 'switch' && $type2 == 'switch') {
		
		$switch->connectSwitchToSwitch($name1, $name2);

		$journal->connectObject($user->ip, $name1, $name2, $type1, $type2);
		
		header('Location: ../index.php');
	} else if ($type1 == 'switch' && $type2 == 'router') {
		
		if(is_null($router->selectRouterPort1($name2))) {
			$switch->connectSwitchToRouter($name1, $name2);
			$router->connectRouterToPort1($name2, $name1);

			$journal->connectObject($user->ip, $name1, $name2, $type1, $type2);

			header('Location: ../index.php');
		} else if(!is_null($router->selectRouterPort1($name2))) {
			if(is_null($router->selectRouterPort2($name2))) {
				$switch->connectSwitchToRouter($name1, $name2);
				$router->connectRouterToPort2($name2, $name1);

				$journal->connectObject($user->ip, $name1, $name2, $type1, $type2);

				header('Location: ../index.php');
			} else if(!is_null($router->selectRouterPort2($name2))) {
				$error = "Все порты роутера заняты";
				echo $error;
				exit();
			}
		}
	} else if ($type1 == 'router' && $type2 == 'switch') {
		if(is_null($router->selectRouterPort1($name1))) {
			$switch->connectSwitchToRouter($name2, $name1);
			$router->connectRouterToPort1($name1, $name2);

			$journal->connectObject($user->ip, $name2, $name1, $type1, $type2);

			header('Location: ../index.php');
		} else if(!is_null($router->selectRouterPort1($name1))) {
			if(is_null($router->selectRouterPort2($name1))) {
				$switch->connectSwitchToRouter($name2, $name1);
				$router->connectRouterToPort2($name1, $name2);

				$journal->connectObject($user->ip, $name2, $name1, $type1, $type2);

				header('Location: ../index.php');
			} else if(!is_null($router->selectRouterPort2($name1))) {
				$error = "Все порты роутера заняты";
				echo $error;
				exit();
			}
		}
	}
} else {
	exit();
}
?>