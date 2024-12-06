<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Network Master</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="assets/icons/fav.ico">
</head>
<body>
    <?php
        require('elements/header.php');
    ?>
    <main class="main">
        <section class="configure">
            <div class="window">
                <div class="container">
                    <div class="elements">
                    <?php
						require_once('server/config.php');

						$sql = 'SELECT ip, image, connection FROM `users`';
    					$query = $pdo->query($sql);
    					while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                            $ip = long2ip($row->ip);
							echo "<div class='card' id='$row->ip'>
                            <img src='assets/icons/$row->image.png' alt='' class='card-image'>
                            <h4 class='card-text'>$ip<h4>
                        </div>";
						}
					?>
                    </div>
                    <div class="elements">
                    <?php
						require_once('server/config.php');

						$sql = 'SELECT ip, image FROM `switches`';
    					$query = $pdo->query($sql);
    					while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                            $ip = long2ip($row->ip);
							echo "<div class='card' id='$row->ip'>
                            <img src='assets/icons/$row->image.png' alt='' class='card-image'>
                            <h4 class='card-text'>$ip<h4>
                        </div>";
						}
					?>
                    </div>
                    <div class="elements">
                        <?php
                            require_once('server/config.php');

                            $sql = 'SELECT ip, image FROM `routers`';
                            $query = $pdo->query($sql);
                            while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                                $ip = long2ip($row->ip);
                                echo "<div class='card' id='$row->ip'>
                                <img src='assets/icons/$row->image.png' alt='' class='card-image'>
                                <h4 class='card-text'>$ip<h4>
                            </div>";
                            }
                        ?>
                    </div>
                </div>
                <script src="libs/leader-line/leader-line.min.js"></script>
                <?php
                        require('script/window.php');
                ?>
            </div>
            <div class="panel">
                <?php
                    session_start();
                    if (isset($_SESSION['user'])) {
                        $user = unserialize($_SESSION['user']);
                        if($user->prava == 'admin') {
                            echo '<div class="moves">
                                    <button class="move-button" onclick="openConnectForm();" id="connectButton">Подключение</button>
                                    <button class="move-button" onclick="openUnconnectForm();" id="unconnect">Отключение</button>
                                    <button class="move-button" onclick="openRemoveForm();" id="remove">Удаление</button>
                                <script src="script/popup.js"></script>
                            </div>
                            <div class="items">
                                <button class="item-card" onclick="openCreateUserForm();">
                                    <img src="assets/icons/computer.png" alt="" class="item-img">
                                    <h3 class="item-title">Computer</h3>
                                </button>
                                <button class="item-card" onclick="openCreateSwitchForm();">
                                    <img src="assets/icons/switch.png" alt="" class="item-img">
                                    <h3 class="item-title">Switch</h3>
                                </button>
                                <button class="item-card" onclick="openCreateRouterForm();">
                                    <img src="assets/icons/router.png" alt="" class="item-img">
                                    <h3 class="item-title">Router</h3>
                                </button>
                            </div>';
                        }
                    } else {
                        header('location: /authorize.php');
                    }
                ?>
                
            </div>
        </section>
        <?php
            require('elements/journal.php');
        ?>
    </main>
    <?php
        require('elements/popup.php');
    ?>
    <script src="script/popup.js"></script>
</body>
</html>