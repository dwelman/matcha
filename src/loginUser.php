<?php
	include "../config/connect.php";

	if ($_POST["submit"] === "Login")
	{
		session_start();
		$pdo = connect();
		$sql = $pdo->query("USE db_matcha");
		$stmt = $pdo->prepare("SELECT username, password FROM users WHERE username = :name");
		$stmt->bindParam(':name', $_POST["username"]);
		$stmt->execute();
		if ($stmt->rowCount() != 1)
		{
			header("Location: ../index.php?error=1");
			return ;
		}
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if (hash("whirlpool", $_POST["password"]) != $row["password"])
		{
			header("Location: ../index.php?error=1");
			return ;
		}
		$_SESSION["logged_on_user"] = $row["username"];
		$pdo = null;
	}
	header("Location: ../memberLanding.php");
	return ;
?>