<?php
include "../config/connect.php";

session_start();
$user = $_SESSION['logged_on_user'];
$id = $_POST['id'];
if ($user == "")
    die();
$pdo = connect();
$sql = $pdo->query("USE db_matcha");
$stmt = $pdo->prepare("DELETE FROM `notifications` WHERE user = :user AND `id` = :id");
$stmt->bindParam(':user', $user);
$stmt->bindParam(':id', $_POST['id']);
$stmt->execute();
$pdo = NULL;
