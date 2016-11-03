<?php
include "../config/connect.php";

session_start();
$user = $_SESSION['logged_on_user'];
if ($user == "")
    die();
$pdo = connect();
$sql = $pdo->query("USE db_matcha");
$stmt = $pdo->prepare("UPDATE chat SET has_read = 'Y'
                        WHERE user = :user AND user_to = :user_to");
$stmt->bindParam(':user', $_POST['user_from']);
$stmt->bindParam(':user_to', $user);
$stmt->execute();
