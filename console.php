<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Network Master</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/console.css">
    <link rel="icon" href="assets/icons/fav.ico">
</head>
<body>
    <?php
        require('elements/header.php');
    ?>
    <main class="main">
        <div class="background">
            <form class="console" id="console">
                <p class="consoletext" id="consoletext">
                    Non-commercial product NetworkMaster<br /> by Waldemar Tkatskiy
                    <br /><br />
                    All copyrights not reserved (c). <br /><br />
                </p>
                <textarea rows="1" class="textinput" name="command" id="command"></textarea>
            </form>
        </div>
        <?php
            require('elements/journal.php');
        ?>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
                    $(".textinput").on('keyup', function (e) {
                        if (e.key == 'Enter') {
                            var command = $('.textinput').val();
                            $.ajax ({
                                url: '/server/command.php',
                                type: 'POST',
                                cache: false,
                                dataType: 'html',
                                data: {
                                    'command': command
                                },
                                success: function(data) {
                                    console.log('Ответ сервера:', data);
                                    $('#consoletext').append(data);
                                    $('.textinput').val('');
                                },
                                error: function(xhr, status, error) {
                                    console.error('Ошибка:', error);
                                    console.error('Ответ:', xhr.responseText);
                                }
                                
                            });
                        }
                    });
    </script>
</body>
</html>