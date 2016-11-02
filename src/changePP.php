<?php

include_once "getImageData.php";

session_start();
$user = $_SESSION['logged_on_user'];
if ($user == "")
    die();
$pdo = connect();
$pdo->query("USE db_matcha");
$stmt = $pdo->prepare("UPDATE images SET is_main='N' WHERE user = :username");
$stmt->bindParam(":username", $user);
$stmt->execute();
$stmt = $pdo->prepare("UPDATE images SET is_main='Y' WHERE user = :username AND image_id = :image_id");
$stmt->bindParam(":username", $user);
$stmt->bindParam(":image_id", $_POST['image']);
$stmt->execute();
