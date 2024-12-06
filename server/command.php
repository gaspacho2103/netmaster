<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'authorize.php';
    
    session_start();
    $user = unserialize($_SESSION['user']);
    
    $data= $_POST['command'];

    if ($data) {
        $command = strtolower(trim($data));
        $command = explode(' ', $command);
        switch($command[0]) {
            case 'manual':
                echo htmlspecialchars($data) . '<br /><p class="consoletext">
                manual - выводит список возможных команд <br />
                ipconfig - выводит информацию о текущей сети <br />
                ping (name) - отправляет тестовые пакеты данных по указанному адресу <br />
                connection (type1) (name1) (type2) (name2) - подключает два устройства друг к другу <br />
                unconnection (type1) (name1) (type2) (name2) - отключает устройства друг от друга <br />
                newuser (name) (password) (role) - создает нового пользователя в системе <br />
                createobject (type) (name) - создает новый объект в системе <br />
                remove (name) - удаляет устройство из сети <br />
                </p><br />';
            break;
            case 'ipconfig':
                echo htmlspecialchars($data) . "<br /><p class='consoletext'>
                192.168.0.0 - основной шлюз <br />
                255.255.255.0 - маска подсети <br />" 
                . htmlspecialchars($user->ip) . " - IPv4-адрес <br />"
                . htmlspecialchars($user->enableStatus) . " - статус работы устройства  <br />"
                . htmlspecialchars($user->image) . " - тип устройства <br />"
                . htmlspecialchars($user->prava) . " - права доступа <br />

                </p><br />";
            break;
            case 'ping':
                echo htmlspecialchars($data) . "<br />";
                
                usleep(999999);
                if(($user->selectUserConnection($user->ip) == null) || ($user->selectUserConnection($command[1]) == null)) {
                    echo "<br /><p class='consoletext'>Отправка пакетов на адрес " . $command[1] . "<br />Успешно : 0 | Потеряно : 4</p><br />";
                } else {
                    if($user->selectUserConnection($user->ip) == $user->selectUserConnection($command[1])) {
                    echo "<br /><p class='consoletext'>Отправка пакетов на адрес " . $command[1] . "<br />Успешно : 4 | Потеряно : 0</p><br />";
                    } else if ($user->selectUserConnection($user->ip) != $user->selectUserConnection($command[1])) {
                        if ($switch->selectSwitchLan(long2ip($user->selectUserConnection($user->ip))) == $switch->selectSwitch(long2ip($user->selectUserConnection($command[1])))) {
                            echo "<br /><p class='consoletext'>Отправка пакетов на адрес " . $command[1] . "<br />Успешно : 4 | Потеряно : 0</p><br />";
                        } else if($switch->selectSwitchLan(long2ip($user->selectUserConnection($user->ip))) != $switch->selectSwitch(long2ip($user->selectUserConnection($command[1])))) {
                            if ($switch->selectSwitchWan(long2ip($user->selectUserConnection($user->ip))) == $switch->selectSwitchWan(long2ip($user->selectUserConnection($command[1])))) {
                                echo "<br /><p class='consoletext'>Отправка пакетов на адрес " . $command[1] . "<br />Успешно : 4 | Потеряно : 0</p><br />";
                            } else {
                                echo "<br /><p class='consoletext'>Отправка пакетов на адрес " . $command[1] . "<br />Успешно : 0 | Потеряно : 4</p><br />";
                            }
                        }
                    }
                    $journal->pingTo($user->ip, $command[1]);
                }
            break;
            case 'connection':
                if($user->prava != 'admin') {
                    echo htmlspecialchars($data);
                    echo "<p class='consoletext'>Вы не являетесь администратором</p><br />";
                    break;
                }
                $name1 = $command[2];
                $name2 = $command[4];
                $type1 = $command[1];
                $type2 = $command[3];

                if ($command[1] == 'computer' && $command[3] == 'switch') {

                    $user->connectUser($name1, $name2);
            
                    $journal->connectObject($user->ip, $name1, $name2, $type1, $type2);

                    echo htmlspecialchars($data) . '<br /><p class="consoletext">' . $type1 . ' ' . $name1 . ' был подключен к ' . $type2 . ' ' . $name2 . '</p><br />';
            
                } else if ($type1 == 'switch' && $type2 == 'computer') {
                    
                    $user->connectUser($name2, $name1);
            
                    $journal->connectObject($user->ip, $name2, $name1, $type1, $type2);

                    echo htmlspecialchars($data) . '<br /><p class="consoletext">' . $type2 . ' ' . $name2 . ' был подключен к ' . $type1 . ' ' . $name1 . '</p><br />';
            
                } else if ($type1 == 'switch' && $type2 == 'switch') {
                    
                    $switch->connectSwitchToSwitch($name1, $name2);
            
                    $journal->connectObject($user->ip, $name1, $name2, $type1, $type2);

                    echo htmlspecialchars($data) . '<br /><p class="consoletext">' . $type1 . ' ' . $name1 . ' был подключен к ' . $type2 . ' ' . $name2 . '</p><br />';
                    
                } else if ($type1 == 'switch' && $type2 == 'router') {
                    
                    if(is_null($router->selectRouterPort1($name2))) {
                        $switch->connectSwitchToRouter($name1, $name2);
                        $router->connectRouterToPort1($name2, $name1);
            
                        $journal->connectObject($user->ip, $name1, $name2, $type1, $type2);

                        echo htmlspecialchars($data) . '<br /><p class="consoletext">' . $type1 . ' ' . $name1 . ' был подключен к ' . $type2 . ' ' . $name2 . '</p><br />';
            
                    } else if(!is_null($router->selectRouterPort1($name2))) {
                        if(is_null($router->selectRouterPort2($name2))) {
                            $switch->connectSwitchToRouter($name1, $name2);
                            $router->connectRouterToPort2($name2, $name1);
            
                            $journal->connectObject($user->ip, $name1, $name2, $type1, $type2);
            
                            echo htmlspecialchars($data) . '<br /><p class="consoletext">' . $type1 . ' ' . $name1 . ' был подключен к ' . $type2 . ' ' . $name2 . '</p><br />';
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
            
                        echo htmlspecialchars($data) . '<br /><p class="consoletext">' . $type2 . ' ' . $name2 . ' был подключен к ' . $type1 . ' ' . $name1 . '</p><br />';
                    } else if(!is_null($router->selectRouterPort1($name1))) {
                        if(is_null($router->selectRouterPort2($name1))) {
                            $switch->connectSwitchToRouter($name2, $name1);
                            $router->connectRouterToPort2($name1, $name2);
            
                            $journal->connectObject($user->ip, $name2, $name1, $type1, $type2);
            
                            echo htmlspecialchars($data) . '<br /><p class="consoletext">' . $type2 . ' ' . $name2 . ' был подключен к ' . $type1 . ' ' . $name1 . '</p><br />';
                        } else if(!is_null($router->selectRouterPort2($name1))) {
                            $error = "Все порты роутера заняты";
                            echo $error;
                            exit();
                        }
                    }
                }
            break;
            case 'unconnection':
                if($user->prava != 'admin') {
                    echo htmlspecialchars($data);
                    echo "<p class='consoletext'>Вы не являетесь администратором</p><br />";
                    break;
                }
                $name1 = $command[2];
                $name2 = $command[4];
                $type1 = $command[1];
                $type2 = $command[3];
                if ($type1 == 'computer' && $type2 == 'switch') {

                    $user->unconnectUser($name1, $name2);
            
                    $journal->unconnectObject($user->ip, $name1, $name2, $type1, $type2);

                    echo htmlspecialchars($data) . '<br /><p class="consoletext">' . $type1 . ' ' . $name1 . ' был отключен от ' . $type2 . ' ' . $name2 . '</p><br />';

                } else if ($type1 == 'switch' && $type2 == 'computer') {
                    
                    $user->unconnectUser($name2, $name1);
            
                    $journal->unconnectObject($user->ip, $name2, $name1, $type1, $type2);

                    echo htmlspecialchars($data) . '<br /><p class="consoletext">' . $type2 . ' ' . $name2 . ' был отключен от ' . $type1 . ' ' . $name1 . '</p><br />';
            
                } else if ($type1 == 'switch' && $type2 == 'switch') {
                    
                    $switch->unconnectSwitchToSwitch($name1, $name2);
            
                    $journal->unconnectObject($user->ip, $name1, $name2, $type1, $type2);

                    echo htmlspecialchars($data) . '<br /><p class="consoletext">' . $type1 . ' ' . $name1 . ' был отключен от ' . $type2 . ' ' . $name2 . '</p><br />';
            
                } else if ($type1 == 'switch' && $type2 == 'router') {
            
                    if($router->selectRouterPort1($name2)) {
            
                        $switch->unconnectSwitchToRouter($name1);
                        $router->unconnectRouterToPort1($name2);
            
                        $journal->unconnectObject($user->ip, $name1, $name2, $type1, $type2);

                        echo htmlspecialchars($data) . '<br /><p class="consoletext">' . $type1 . ' ' . $name1 . ' был отключен от ' . $type2 . ' ' . $name2 . '</p><br />';
            
                    } else if($router->selectRouterPort2($name2)) {
                        
                        $switch->unconnectSwitchToRouter($name1);
                        $router->unconnectRouterToPort2($name2);
            
                        $journal->unconnectObject($user->ip, $name1, $name2, $type1, $type2);

                        echo htmlspecialchars($data) . '<br /><p class="consoletext">' . $type1 . ' ' . $name1 . ' был отключен от ' . $type2 . ' ' . $name2 . '</p><br />';
            
                    }
            
                } else if ($type1 == 'router' && $type2 == 'switch') {
                    if($router->selectRouterPort1($name1)) {
                        
                        $switch->unconnectSwitchToRouter($name2);
                        $router->unconnectRouterToPort1($name1);
            
                        $journal->unconnectObject($user->ip, $name2, $name1, $type1, $type2);

                        echo htmlspecialchars($data) . '<br /><p class="consoletext">' . $type2 . ' ' . $name2 . ' был отключен от ' . $type1 . ' ' . $name1 . '</p><br />';
            
                    } else if($router->selectRouterPort2($name1)) {
                        
                        $switch->unconnectSwitchToRouter($name2);
                        $router->unconnectRouterToPort2($name1);
            
                        $journal->unconnectObject($user->ip, $name2, $name1, $type1, $type2);

                        echo htmlspecialchars($data) . '<br /><p class="consoletext">' . $type2 . ' ' . $name2 . ' был отключен от ' . $type1 . ' ' . $name1 . '</p><br />';
            
                    }
                }
            break;
            case 'newuser':
                if($user->prava != 'admin') {
                    echo htmlspecialchars($data);
                    echo "<p class='consoletext'>Вы не являетесь администратором</p><br />";
                    break;
                }
                $user->createUser($command[1], $command[2], 'on', 'computer', $command[3]);

                $journal->createObject($user->ip, $command[1], 'computer');

                echo htmlspecialchars($data) . '<br /><p class="consoletext">' . $command[1] . ' был создан</p><br />';
            break;
            case 'createobject':
                if($user->prava != 'admin') {
                    echo htmlspecialchars($data);
                    echo "<p class='consoletext'>Вы не являетесь администратором</p><br />";
                    break;
                }
                if($command[1] == 'switch') {
                    $switch->createSwtich($command[2], 'on', 'switch');
                    $journal->createObject($user->ip, $command[2], 'switch');
                    echo htmlspecialchars($data) . '<br /><p class="consoletext">' . $command[2] . ' был создан</p><br />';
                } else if ($command[1] == 'router') {
                    $router->createRouter($command[2], 'on', 'router');
                    $journal->createObject($user->ip, $command[2], 'router');
                    echo htmlspecialchars($data) . '<br /><p class="consoletext">' . $command[2] . ' был создан</p><br />';
                } else {
                    echo "Данного класса не существует";
                }
            break;
            case 'remove':
                if($user->prava != 'admin') {
                    echo htmlspecialchars($data);
                    echo "<br /><p class='consoletext'>Вы не являетесь администратором</p><br />";
                    break;
                }
                if (ip2long($command[1]) == $user->selectUser($command[1])) {
                    $user->deleteUser($command[1]);
                    $journal->deleteObject($user->ip, $command[1], 'computer');
                    echo htmlspecialchars($data) . '<br /><p class="consoletext">' . $command[1] . ' был удален</p><br />';
                } else if (ip2long($command[1]) == $switch->selectSwitch($command[1])) {
                    $switch->deleteSwitch($command[1]);
                    $journal->deleteObject($user->ip, $command[1], 'switch');
                    echo htmlspecialchars($data) . '<br /><p class="consoletext">' . $command[1] . ' был удален</p><br />';
                } else if (ip2long($command[1]) == $router->selectRouter($command[1])) {
                    $router->deleteRouter($command[1]);
                    $journal->deleteObject($user->ip, $command[1], 'router');
                    echo htmlspecialchars($data) . '<br /><p class="consoletext">' . $command[1] . ' был удален</p><br />';
                }
            break;
            default:
                echo '<p class="consoletext">Неизвестная команда: ' . htmlspecialchars($data) . '</p><br />';
        }
    } else {
        echo '<p class="consoletext">Команда не передана.</p><br />';
    }
} else {
    exit();
}

?>