<?php
	include "../config/connect.php";

	if (strlen($_POST["password"]) < 6 || $_POST["password"] != $_POST["confpsw"] || !$_POST["submit"] == "submit")
	{
		header("Location: ../changePassword.php?verif=" . $_POST["user"] . "&error=1");
		return ;
	}
	$pdo = connect();
	session_start();
	$_SESSION["logged_on_user"] = "";
	$sql = $pdo->query("USE db_matcha");
	$stmt = $pdo->prepare("SELECT * FROM users");
	$stmt->execute();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		if (hash("whirlpool", $row["username"]) == $_POST["user"])
		{
			$stmt = $pdo->prepare("UPDATE users SET password = :password WHERE username=:name");
			$stmt->bindParam(":name", $row["username"]);
			$stmt->bindParam(":password", hash("whirlpool", $_POST["password"]));
			$stmt->execute();
			header("Location: ../index.php");
			$pdo = null;
			return ;
		}
	}
	$pdo = null;
	header("Location: ../index.php?error=3");
	return ;
?>