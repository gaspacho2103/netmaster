<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Network Master</title>
        <link rel="stylesheet" href="css/reset.css">
        <link rel="icon" href="assets/icons/fav.ico">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    </head>
    <body>
        <div class="row">
            <div class="container w-50 mx-auto mt-5">
                <h2 class="mb-5">Изменение уровня доступа</h2>
                <form method="post" class="mt-2">
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Права доступа:</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="prava">
                        </div>
                    </div>
                    <div class="row mb-3 mt-5">
                        <div class="col-sm-5 d-grid">
                            <button type="submit" class="btn btn-primary">Изменить</button>
                        </div>
                        <div class="col-sm-4 d-grid">
                            <a class="btn btn-outline-primary" href="../users.php" role="button">Выйти</a>
                        </div>
                    </div>
                </div>
        </div>
    </body>
</html>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require 'authorize.php';
        session_start();
        $user = unserialize($_SESSION['user']);

        $name = $_GET['name'];
        $prava = $_POST['prava'];

        $user->updateUserPrava($name, $prava);
        $journal->updateUserPrava($user->ip, $name, $prava);
        
    } else {
        exit();
    }
?>