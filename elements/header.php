<link rel="stylesheet" href="css/style.css">
<header class="header"> 
        <div class="container header-container">
            <div class="logo">
                <img src="assets/icons/logo.png" alt="" class="header__logo">
            </div>
            <nav class="navigation">
                <a href="/index.php" class="header__link">Конфигуратор</a>
                <a href="/console.php" class="header__link">CLI</a>
                <?php
                    require_once ('user/User.php');
                    session_start();
                    if (isset($_SESSION['user'])) {
                        $user = unserialize($_SESSION['user']);
                        if($user->prava == 'admin') {
                            echo '<a href="/users.php" class="header__link">Пользователи</a>';
                        }
                    } else {
                        header('location: /authorize.php');
                    }
                ?>
                <a href="server/exit.php" class="header__link" id="exit">Выйти</a>
            </nav>
        </div>
</header>

<style>
@import url('https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap');

* {
    margin: 0 auto;
    padding: 0;

    font-family: 'Noto Sans', sans-serif;
}

a {
    text-decoration: none;
    color: #333;
}


.header {
    background: #fff;

    box-shadow: 0px 0px 8px rgba(33, 201, 219, 0.2);
}

.container {
    width: 100%;
    max-width: 1200px;
}

.header-container {
    display: flex;
    justify-content: space-between;
}

.logo {
    padding: 10px;
}

.header__logo {
    width: 60px;
    height: 60px;
    /* padding: 10px; */
}

.navigation {
    display: flex;
    justify-content: space-around;

    width: 60%;
    padding: 28px;
}

.header__link {
    font-size: 20px;
    font-weight: 700;

    letter-spacing: 2px;

    text-transform: uppercase;

    transition: .3s;
}

.header__link:hover {
    color: #21C9DB;
}

#exit {
    color: #21C9DB;

    transition: .3s;
}

#exit:hover {
    color: #d11144;
}
</style>