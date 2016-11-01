<?php
include "../config/connect.php";
session_start();

file_put_contents("log3.txt", print_r($_POST, true));

$user = $_SESSION["logged_on_user"];
$pdo = connect();
$sql = $pdo->query("USE db_matcha");
$stmt = $pdo->prepare("SELECT interest FROM user_interests WHERE interest = :interest AND user = :user");
$stmt->bindParam(':interest', $_POST["interest"]);
$stmt->bindParam(':user', $user);
$stmt->execute();
if ($stmt->rowCount() > 0)
{
    $stmt = $pdo->prepare("DELETE FROM user_interests WHERE interest = :interest AND user = :user");
    $stmt->bindParam(':interest', $_POST["interest"]);
    $stmt->bindParam(':user', $user);
    $stmt->execute();
}
else
{
    $stmt = $pdo->prepare("INSERT INTO user_interests (interest, user)
			VALUES (:interest, :user)");
    $stmt->bindParam(':interest', $_POST["interest"]);
    $stmt->bindParam(':user', $user);
    $stmt->execute();
}
$pdo = null;
