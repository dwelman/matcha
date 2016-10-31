<?php
	include "../config/connect.php";

	if (!preg_match('/^[A-Za-z0-9_-]+$/', $_POST["interest"]))
	{
		header("Location: ../editProfile.php?error=1");
		return ;
	}
	$pdo = connect();
	$sql = $pdo->query("USE db_matcha");
	$stmt = $pdo->prepare("INSERT INTO user_interests (interest, user)
			VALUES (:interest, :user)");
	$stmt->bindParam(':interest', $_POST["interest"]);
	$stmt->bindParam(':user', $_POST["user"]);
	$stmt->execute();
	$pdo = null;
	header("Location: ../editProfile.php");
	return ;
?>