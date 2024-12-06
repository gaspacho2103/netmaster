<link rel="stylesheet" href="css/style.css">
<aside class="journal">
            <h3 class="journal-title">Журнал действий</h3>
            <div class="journal-desc">
                <?php
                    require_once('server/config.php');

                    $sql = "SELECT user, description, time FROM `journal` WHERE `user` IS NOT NULL";
                    $query = $pdo->query($sql);
                    while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                        $user = long2ip($row->user);
                        echo "<strong>$user</strong> $row->description , $row->time. <br /><br />";
                    }
                    
                ?>   
            </div>
</aside>

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

.journal {
    width: 30%;
    
    margin-top: 12.5px;

    border: 2px solid #cfcfcf;

    width: 28%;

    height: 829px;

    border-radius: 12px;
}

.journal-title {
    text-align: center;

    font-size: 22px;

    letter-spacing: 2px;

    text-transform: uppercase;

    font-weight: 700;

    padding: 15px;

    color: #333;

    border-bottom: 2px solid #cfcfcf;

}

.journal-desc {
    flex-wrap: wrap;

    font-size: 16px;

    padding: 15px;

    height: 750px;

    color: #5c5c5c;

    overflow-y: scroll;
}

</style>