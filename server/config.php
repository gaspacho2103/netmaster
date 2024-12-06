<?php
	$user = 'root';
	$password = '';
	$db = 'siscodb';
	$host = '127.127.126.26';

	$dsn = 'mysql:host='.$host.';dbname='.$db;
	$pdo = new PDO($dsn, $user, $password);
?>