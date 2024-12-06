<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Network Master</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/authorize.css">
    <link rel="icon" href="assets/icons/fav.ico">
</head>
<body>
        <form class="authorize" action="server/authorize.php" method="post">
                    <h2 class="form-title">Авторизация</h2>
                    <div class="form__group">
                        <input class="form__input" type="text" name="name" id="name" placeholder=" ">
                        <label class="form__label">Доменное имя</label>
                    </div>
                    <div class="form__group">
                        <input class="form__input" type="password" name="password" id="password" placeholder=" ">
                        <label class="form__label">Пароль</label>
                    </div>
                    <div class="form__group">
                        <input class="form__input" type="password" name="dblpassword" id="dblpassword" placeholder=" ">
                        <label class="form__label">Повторите пароль</label>
                    </div>
                    <button type="submit" class="send-button">Войти</button><br>
        </form>
</body>
</html>