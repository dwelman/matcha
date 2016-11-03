<?php
	session_start();
	if ($_POST["submit"] === "submit" || $_SESSION["logged_on_user"] != "")
	{
		include "../config/connect.php";	

		$pdo = connect();
		$sql = $pdo->query("USE db_matcha");
		$stmt = $pdo->prepare("INSERT INTO reports (user, reported_user, reason)
				VALUES (:user, :report, :reason)");
		$stmt->bindParam(":user", $_SESSION["logged_on_user"]);
		$stmt->bindParam(":report", $_POST["user"]);
		$stmt->bindParam(":reason", $_POST["report"]);
		$stmt->execute();
		$stmt = $pdo->prepare("INSERT INTO blocks (user, blocked_user)
				VALUES (:user, :user_blocked)");
		$stmt->bindParam(":user", $_SESSION["logged_on_user"]);
		$stmt->bindParam(":user_blocked", $_POST["user"]);
		$stmt->execute();
		$pdo = NULL;
	}
	header("Location: ../memberLanding.php");
?>