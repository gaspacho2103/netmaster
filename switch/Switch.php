<?php
    class Switchh {
        public string $ip;
        public string $enableStatus;
        public string $image;

        public function __construct(string $ip, string $enableStatus, string $image)
        {
            $this->ip = $ip;
            $this->enableStatus = $enableStatus;
            $this->image = $image;
        }

        public function selectSwitch(string $ip) {
            require '../server/config.php';

            $ip = ip2long($ip);

            $sql = "SELECT `ip` FROM `switches` WHERE `ip` = $ip";
            $query = $pdo->query($sql);
            $result = $query->fetch(PDO::FETCH_OBJ);

            return $result->ip;
        }

        public function selectSwitchLan(string $ip) {
            require '../server/config.php';

            $ip = ip2long($ip);

            $sql = "SELECT `lanPort` FROM `switches` WHERE `ip` = $ip";
            $query = $pdo->query($sql);
            $result = $query->fetch(PDO::FETCH_OBJ);

            return $result->lanPort;
        }

        public function selectSwitchWan(string $ip) {
            require '../server/config.php';

            $ip = ip2long($ip);

            $sql = "SELECT `wanPort` FROM `switches` WHERE `ip` = $ip";
            $query = $pdo->query($sql);
            $result = $query->fetch(PDO::FETCH_OBJ);

            return $result->wanPort;
        }

        public function createSwtich(string $ip, string $enableStatus, string $image) : void {
            require '../server/config.php';

            $ip = ip2long($ip);

            $sql = 'INSERT INTO `switches` (ip, enableStatus, image) VALUE(?, ?, ?)';
	        $query = $pdo->prepare($sql);
	        $query->execute([$ip, "$enableStatus", "$image"]);
        }

        public function connectSwitchToSwitch(string $ip, string $lanPort) : void {
            require '../server/config.php';

            $ip = ip2long($ip);
            $lanPort = ip2long($lanPort);

            $sql = "UPDATE `switches` SET `lanPort` = :lanPort WHERE `ip` = $ip";
	        $query = $pdo->prepare($sql);
	        $query->execute(['lanPort' => $lanPort]);

            $sql = "UPDATE `switches` SET `lanPort` = :lanPort WHERE `ip` = $lanPort";
	        $query = $pdo->prepare($sql);
	        $query->execute(['lanPort' => $ip]);
        }

        public function connectSwitchToRouter(string $ip, string $wanPort) : void {
            require '../server/config.php';

            $ip = ip2long($ip);
            $wanPort = ip2long($wanPort);

            $sql = "UPDATE `switches` SET `wanPort` = :wanPort WHERE `ip` = $ip";
	        $query = $pdo->prepare($sql);
	        $query->execute(['wanPort' => $wanPort]);
        }

        public function unconnectSwitchToSwitch(string $ip, string $lanPort) : void {
            require '../server/config.php';

            $ip = ip2long($ip);
            $lanPort = ip2long($lanPort);

            $sql = "UPDATE `switches` SET `lanPort` = :lanPort WHERE `ip` = $ip";
	        $query = $pdo->prepare($sql);
	        $query->execute(['lanPort' => null]);

            $sql = "UPDATE `switches` SET `lanPort` = :lanPort WHERE `ip` = $lanPort";
	        $query = $pdo->prepare($sql);
	        $query->execute(['lanPort' => null]);
        }

        public function unconnectSwitchToRouter(string $ip) : void {
            require '../server/config.php';

            $ip = ip2long($ip);

            $sql = "UPDATE `switches` SET `wanPort` = :wanPort WHERE `ip` = $ip";
	        $query = $pdo->prepare($sql);
	        $query->execute(['wanPort' => null]);
        }

        public function deleteSwitch(string $ip) : void {
            require '../server/config.php';

            $ip = ip2long($ip);

            $sql = "DELETE FROM `switches` WHERE `ip` = $ip";
            $query = $pdo->prepare($sql);
            $query->execute();
        }
    }
?>