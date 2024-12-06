<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Network Master</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/users.css">
    <link rel="icon" href="assets/icons/fav.ico">
</head>
<body>
    <?php
        require('elements/header.php');

        session_start();
        if (isset($_SESSION['user'])) {
            $user = unserialize($_SESSION['user']);
            if($user->prava != 'admin') {
                header('location: /index.php');
            }
        } else {
            header('location: /authorize.php');
        }
    ?>
    <main class="main">
        <section class="users">
            <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
            <table class="table">
                <h3 class='tableTitle'>Таблица 'Users'</h3>
                                <br><button class='btn btn-success text-light mt-1 mb-3' onclick="openCreateUserForm();">Новый пользователь</button><table class='table'>
                                <thead>
                                    <tr>
                                        <th>Ip</th>
                                        <th>Password</th>
                                        <th>EnableStatus</th>
                                        <th>Type</th>
                                        <th>Connection</th>
                                        <th>Prava</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        require_once('server/config.php');

                                        $sql = 'SELECT ip, password, enableStatus, image, connection, prava FROM `users`';
                                        $query = $pdo->query($sql);
                                        while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                                            $ip = long2ip($row->ip);
                                            $connection = long2ip($row->connection);
                                            echo "<tr>
                                                <td>$ip</td>
                                                <td>$row->password</td>
                                                <td>$row->enableStatus</td>
                                                <td>$row->image</td>
                                                <td>$connection</td>
                                                <td>$row->prava</td>
                                                <td>
                                                    <a class='btn btn-primary btn-sm text-light' href='server/updatePrava.php?name=$ip'>Редактирование</a>
                                                    <a class='btn btn-danger btn-sm text-light' href='server/deleteObject.php?name=$ip'>Удаление</a>
                                                </td>
                                            </tr>";
                                        }
                                    ?>
                                </tbody>
            </table>
    </section>

    <style>
        .users {
            width: 68%;

            margin: 25px 15px 0px 22px;
        }

    </style>
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