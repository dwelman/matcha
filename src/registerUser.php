<?php
	include "../config/connect.php";

	if ($_POST["submit"] === "Register")
	{
		if (!preg_match('/^[A-Za-z0-9_-]+$/', $_POST["username"]) || !(strlen($_POST["username"]) >= 6 && strlen($_POST["username"]) <= 24))
		{
			header("Location: ../index.php?error=1");
			return ;
		}
		if (!preg_match('/^[A-Za-z -]+$/', trim($_POST["name"])) || !(strlen(trim($_POST["name"])) <= 24))
		{
			header("Location: ../index.php?error=6");
			return ;
		}
		if (!preg_match('/^[A-Za-z -]+$/', trim($_POST["surname"])) || !(strlen(trim($_POST["surname"])) <= 24))
		{
			header("Location: ../index.php?error=6");
			return ;
		}
		if (!preg_match('/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/', $_POST["email"]))
		{
			header("Location: ../index.php?error=2");
			return ;
		}
		if (strlen($_POST["password"]) < 6 || $_POST["password"] != $_POST["confpsw"])
		{
			header("Location: ../index.php?error=3");
			return ;
		}
		if (intval($_POST["age"]) < 18)
		{
			header("Location: ../index.php?error=7");
			return ;
		}
		$pdo = connect();
		$sql = $pdo->query("USE db_matcha");
		$stmt = $pdo->prepare("SELECT username FROM users WHERE username = :name");
		$stmt->bindParam(':name', $_POST["username"]);
		$stmt->execute();
		if ($stmt->rowCount() > 0)
		{
			header("Location: ../index.php?error=4");
			return ;
		}
		$stmt = $pdo->prepare("SELECT email FROM users WHERE email = :email");
		$stmt->bindParam(':email', $_POST["email"]);
		$stmt->execute();
		if ($stmt->rowCount() > 0)
		{
			header("Location: ../index.php?error=5");
			return ;
		}
		$stmt = $pdo->prepare("INSERT INTO users (username, password, email, name, surname, age, gender, preference)
			VALUES (:username, :pass, :email, :name, :surname, :age, :gender, :prefer)");
		$stmt->bindParam(':username', $_POST["username"]);
		$stmt->bindParam(':email', $_POST["email"]);
		$stmt->bindParam(':pass', hash("whirlpool", $_POST["password"]));
		$stmt->bindParam(':name', $_POST["name"]);
		$stmt->bindParam(':surname', $_POST["surname"]);
		$age = intval($_POST["age"]);
		$stmt->bindParam(':age', $age);
		$stmt->bindParam(':gender', $_POST["gender"]);
		$stmt->bindParam(':prefer', $_POST["preference"]);
		$stmt->execute();
		$pdo = null;
	}
	header("Location: ../index.php");
	return ;
?>