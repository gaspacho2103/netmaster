<?php
    class Journal {

        public function createObject(string $admin, string $name, string $type) : void {
            require '../server/config.php';

            $time = date("Y-m-d H:i:s");
            $admin = ip2long($admin);
    
            $sql = 'INSERT INTO `journal` (user, description, time) VALUE(?, ?, ?)';
            $query = $pdo->prepare($sql);
            $query->execute(["$admin", "создал $type $name", "$time"]);
            
        }

        public function connectObject(string $admin, string $name1, string $name2, string $type1, string $type2) {
            require '../server/config.php';

            $time = date("Y-m-d H:i:s");
            $admin = ip2long($admin);

            $sql = 'INSERT INTO `journal` (user, description, time) VALUE(?, ?, ?)';
            $query = $pdo->prepare($sql);
            $query->execute(["$admin", "подключил $type1 $name1 к $type2 $name2", "$time"]);
        }

        public function unconnectObject(string $admin, string $name1, string $name2, string $type1, string $type2) {
            require '../server/config.php';

            $time = date("Y-m-d H:i:s");
            $admin = ip2long($admin);

            $sql = 'INSERT INTO `journal` (user, description, time) VALUE(?, ?, ?)';
            $query = $pdo->prepare($sql);
            $query->execute(["$admin", "отключил $type1 $name1 от $type2 $name2", "$time"]);
        }

        public function deleteObject(string $admin, string $name, string $type) : void {
            require '../server/config.php';

            $time = date("Y-m-d H:i:s");
            $admin = ip2long($admin);
    
            $sql = 'INSERT INTO `journal` (user, description, time) VALUE(?, ?, ?)';
            $query = $pdo->prepare($sql);
            $query->execute(["$admin", "удалил $type $name", "$time"]);
        }

        public function updateUserPrava(string $admin, string $name, string $prava) : void {
            require '../server/config.php';

            $time = date("Y-m-d H:i:s");
            $admin = ip2long($admin);
    
            $sql = 'INSERT INTO `journal` (user, description, time) VALUE(?, ?, ?)';
            $query = $pdo->prepare($sql);
            $query->execute(["$admin", "изменил права доступа $name на $prava", "$time"]);
        }

        public function pingTo(string $name1, string $name2) {
            require '../server/config.php';

            $time = date("Y-m-d H:i:s");
            $name1 = ip2long($name1);
    
            $sql = 'INSERT INTO `journal` (user, description, time) VALUE(?, ?, ?)';
            $query = $pdo->prepare($sql);
            $query->execute(["$name1", "отправил пакеты данных пользователю $name2", "$time"]);
        }

        public function authorize(string $name) {
            require '../server/config.php';

            $time = date("Y-m-d H:i:s");
            $name = ip2long($name);
    
            $sql = 'INSERT INTO `journal` (user, description, time) VALUE(?, ?, ?)';
            $query = $pdo->prepare($sql);
            $query->execute(["$name", "авторизовался в системе", "$time"]);
        }

    }
?>