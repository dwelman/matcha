<?php
	include "../config/connect.php";

	session_start();
	if ($_SESSION["logged_on_user"] != "")
	{
		$pdo = connect();
		$sql = $pdo->query("USE db_matcha");
		$stmt = $pdo->prepare("UPDATE users
				SET last_online = NOW()
				WHERE username = :name");
		$stmt->bindParam(':name', $_SESSION["logged_on_user"]);
		$stmt->execute();
	}
	return ;
?>