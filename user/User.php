<?php
    class User {
        public string $ip;
        public string $password;
        public string $enableStatus;
        public string $image;
        public string $prava;

        public function __construct(string $ip, string $password, string $enableStatus, string $image, string $prava)
        {
            $this->ip = $ip;
            $this->password = $password;
            $this->enableStatus = $enableStatus;
            $this->image = $image;
            $this->prava = $prava;
        }

        public function selectUser(string $ip) {
            require '../server/config.php';

            $ip = ip2long($ip);

            $sql = "SELECT `ip` FROM `users` WHERE `ip` = $ip";
            $query = $pdo->query($sql);
            $result = $query->fetch(PDO::FETCH_OBJ);

            return $result->ip;
        }

        public function selectUserConnection(string $ip) {
            require '../server/config.php';

            $ip = ip2long($ip);

            $sql = "SELECT `connection` FROM `users` WHERE `ip` = $ip";
            $query = $pdo->query($sql);
            $result = $query->fetch(PDO::FETCH_OBJ);

            return $result->connection;
        }

        public function createUser(string $ip, string $pass, string $enableStatus, string $image, string $prava) : void {
            require '../server/config.php';

            $ip = ip2long($ip);

            $sql = 'INSERT INTO `users` (ip, password, enableStatus, image, prava) VALUE(?, ?, ?, ?, ?)';
	        $query = $pdo->prepare($sql);
	        $query->execute([$ip, "$pass", "$enableStatus", "$image", "$prava"]);
        }

        public function updateUserPrava(string $ip, string $prava) : void {
            require '../server/config.php';

            $ip = ip2long($ip);

            $sql = "UPDATE `users` SET `prava` = :prava WHERE `ip` = $ip";
	        $query = $pdo->prepare($sql);
	        $query->execute(['prava' => $prava]);
        }

        public function connectUser(string $ip, string $connection) : void {
            require '../server/config.php';

            $ip = ip2long($ip);
            $connection = ip2long($connection);

            $sql = "UPDATE `users` SET `connection` = :connection WHERE `ip` = $ip";
	        $query = $pdo->prepare($sql);
	        $query->execute(['connection' => $connection]);
        }

        public function unconnectUser(string $ip) : void {
            require '../server/config.php';

            $ip = ip2long($ip);

            $sql = "UPDATE `users` SET `connection` = :connection WHERE `ip` = $ip";
	        $query = $pdo->prepare($sql);
	        $query->execute(['connection' => null]);
        }

        public function deleteUser(string $ip) : void {
            require '../server/config.php';

            $ip = ip2long($ip);

            $sql = "DELETE FROM `users` WHERE `ip` = $ip";
            $query = $pdo->prepare($sql);
            $query->execute();
        }
    }
?>