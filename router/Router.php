<?php
    class Router {
        public string $ip;
        public string $enableStatus;
        public string $image;

        public function __construct(string $ip, string $enableStatus, string $image)
        {
            $this->ip = $ip;
            $this->enableStatus = $enableStatus;
            $this->image = $image;
        }

        public function selectRouter(string $ip) {
            require '../server/config.php';

            $ip = ip2long($ip);

            $sql = "SELECT `ip`, `enableStatus`, `image`, `port1`, `port2` FROM `routers` WHERE `ip` = $ip";
            $query = $pdo->query($sql);
            $result = $query->fetch(PDO::FETCH_OBJ);

            return $result->ip;
        }

        public function selectRouterPort1(string $ip) {
            require '../server/config.php';

            $ip = ip2long($ip);

            $sql = "SELECT `port1` FROM `routers` WHERE `ip` = $ip";
            $query = $pdo->query($sql);
            $result = $query->fetch(PDO::FETCH_OBJ);

            return $result->port1;
        }

        public function selectRouterPort2(string $ip) {
            require '../server/config.php';

            $ip = ip2long($ip);

            $sql = "SELECT `port2` FROM `routers` WHERE `ip` = $ip";
            $query = $pdo->query($sql);
            $result = $query->fetch(PDO::FETCH_OBJ);

            return $result->port2;
        }

        public function createRouter(string $ip, string $enableStatus, string $image) : void {
            require '../server/config.php';

            $ip = ip2long($ip);

            $sql = 'INSERT INTO `routers` (ip, enableStatus, image) VALUE(?, ?, ?)';
	        $query = $pdo->prepare($sql);
	        $query->execute([$ip, "$enableStatus", "$image"]);
        }

        public function connectRouterToPort1(string $ip, string $port1) : void {
            require '../server/config.php';

            $ip = ip2long($ip);
            $port1 = ip2long($port1);

            $sql = "UPDATE `routers` SET `port1` = :port1 WHERE `ip` = $ip";
	        $query = $pdo->prepare($sql);
	        $query->execute(['port1' => $port1]);
        }

        public function connectRouterToPort2(string $ip, string $port2) : void {
            require '../server/config.php';

            $ip = ip2long($ip);
            $port2 = ip2long($port2);

            $sql = "UPDATE `routers` SET `port2` = :port2 WHERE `ip` = $ip";
	        $query = $pdo->prepare($sql);
	        $query->execute(['port2' => $port2]);
        }

        public function unconnectRouterToPort1(string $ip) : void {
            require '../server/config.php';

            $ip = ip2long($ip);

            $sql = "UPDATE `routers` SET `port1` = :port1 WHERE `ip` = $ip";
	        $query = $pdo->prepare($sql);
	        $query->execute(['port1' => null]);
        }

        public function unconnectRouterToPort2(string $ip) : void {
            require '../server/config.php';

            $ip = ip2long($ip);

            $sql = "UPDATE `routers` SET `port2` = :port2 WHERE `ip` = $ip";
	        $query = $pdo->prepare($sql);
	        $query->execute(['port2' => null]);
        }

        public function deleteRouter(string $ip) : void {
            require '../server/config.php';

            $ip = ip2long($ip);

            $sql = "DELETE FROM `routers` WHERE `ip` = $ip";
            $query = $pdo->prepare($sql);
            $query->execute();
        }
    }
?>