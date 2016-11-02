<?php

include "../config/connect.php";

session_start();
$user = $_SESSION['logged_on_user'];
$liked = $_POST['like'];
if ($user == "")
    die();
$pdo = connect();
$sql = $pdo->query("USE db_matcha");
$stmt = $pdo->prepare("SELECT user, liked_user FROM likes WHERE user = :username AND liked_user = :liked_user");
$stmt->bindParam(":username", $user);
$stmt->bindParam(":liked_user", $liked);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
file_put_contents("log.txt", print_r($data, true));
echo json_encode($data);

