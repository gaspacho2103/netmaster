<?php
						require_once('server/config.php');

						$sql = 'SELECT ip, connection FROM `users`';
    					$query = $pdo->query($sql);
    					while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                            for($i = 0; $i < count($row); $i++) {
                                if($row['connection'] != null) {
                                    echo "<script>new LeaderLine(
                                    LeaderLine.pointAnchor(document.getElementById('$row[ip]'), { x: 55, y: 110 }),
                                    LeaderLine.pointAnchor(document.getElementById('$row[connection]'), { x: 55, y: 0 }),
                                    {
                                    color: 'black',
                                    size: 2,
                                    startSocket: 'bottom',
                                    endSocket: 'top',
                                    
                                    startPlug: 'disc', endPlug: 'disc',
                                    dash: {animation: true},
                                    
                                    });
                                    </script>";
                                }
                            }
                            
						}

                        $sql = 'SELECT ip, wanPort FROM `switches`';
    					$query = $pdo->query($sql);
    					while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                            for($i = 0; $i < count($row); $i++) {
                                if($row['wanPort'] != null) {
                                    echo "<script>new LeaderLine(
                                    LeaderLine.pointAnchor(document.getElementById('$row[ip]'), { x: 55, y: 110 }),
                                    LeaderLine.pointAnchor(document.getElementById('$row[wanPort]'), { x: 55, y: 0 }),
                                    {
                                    color: 'black',
                                    size: 2,
                                    startSocket: 'bottom',
                                    endSocket: 'top',
                                    
                                    startPlug: 'disc', endPlug: 'disc',
                                    dash: {animation: true},
                                    
                                    });
                                    </script>";
                                }
                            }
                            
						}

                        $sql = 'SELECT ip, lanPort FROM `switches`';
    					$query = $pdo->query($sql);
    					while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                            for($i = 0; $i < count($row); $i++) {
                                if($row['lanPort'] != null) {
                                        $temp = $row['ip'];

                                        echo "<script>new LeaderLine(
                                        LeaderLine.pointAnchor(document.getElementById('$row[ip]'), { x: 55, y: 110 }),
                                        LeaderLine.pointAnchor(document.getElementById('$row[lanPort]'), { x: 55, y: 110 }),
                                        {
                                        color: 'black',
                                        size: 2,
                                        startSocket: 'bottom',
                                        endSocket: 'bottom',
                                        
                                        startPlug: 'disc', endPlug: 'disc',
                                        dash: {animation: true},
                                        
                                        });
                                        </script>";

                                        break;
                                }
                            }
                            
						}
?>
