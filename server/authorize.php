<?php
    require 'config.php';
    require __DIR__ . '/../user/User.php';
    require __DIR__ . '/../switch/Switch.php';
    require __DIR__ . '/../router/Router.php';
    require __DIR__ . '/../journal/Journal.php';

    $switch = new Switchh('ip', 'on', 'switch');
    
    $router = new Router('ip', 'on', 'router');
    
    $journal = new Journal();

    $name = trim(filter_var($_POST['name'])) ?? '';
    $password = trim(filter_var($_POST['password'])) ?? '';
    $dblpassword = trim(filter_var($_POST['dblpassword'])) ?? '';

    if (!empty($name) && !empty($password)) {
        $name = ip2long($name);
        $sql = "SELECT `ip`, `password`, `enableStatus`, `image`, `prava` FROM `users` WHERE `ip` = $name AND `password` = '$password'";
        $query = $pdo->query($sql);
        $result = $query->fetch(PDO::FETCH_OBJ);
        
        if ($result) {
            session_start();
            $user = new User(long2ip($result->ip), $result->password, $result->enableStatus, $result->image, $result->prava);
            $_SESSION['user'] = serialize($user);
            $journal->authorize(long2ip($result->ip));
            
            header('location: ../index.php');
        } else {
            echo "Пользователь не найден или неверные данные.";
        }
    }
?>