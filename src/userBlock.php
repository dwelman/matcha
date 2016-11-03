<?php
	function blockUser($user, $blockUser)
	{
		include "../config/connect.php";

		$pdo = connect();
		$sql = $pdo->query("USE db_matcha");
		$stmt = $pdo->prepare("INSERT INTO blocks (user, blocked_user)
				VALUES (:user, :user_blocked)");
		$stmt->bindParam(":user", $user);
		$stmt->bindParam(":user_blocked", $blockUser);
		$stmt->execute();
		$pdo = NULL;
	}
?>