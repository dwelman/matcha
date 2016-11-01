<?php
    include "../config/connect.php";

    session_start();
    $user = $_SESSION['logged_on_user'];
    $pdo = connect();
    if ($user == "")
    {
        die(">>>BREACH<<< : User not logged on!");
    }
    $sql = $pdo->query("USE db_matcha");
    $stmt = $pdo->prepare("SELECT interest FROM user_interests WHERE user = :username");
    $stmt->bindParam(":username", $user);
    $stmt->execute();
	while ($row = $stmt->fetch(PDO::FETCH_COLUMN))
	{
		$data[] = $row;
	}
    echo json_encode($data);
?>