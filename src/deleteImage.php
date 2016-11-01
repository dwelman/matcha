<?php
include "../config/connect.php";
include "getImageData.php";

session_start();
$pdo = connect();
$sql = $pdo->query("USE db_matcha");
$stmt = $pdo->prepare("SELECT `image_path` FROM `images` WHERE user = :name AND `image_id` = :image");
$stmt->bindParam(':name', $_SESSION['logged_on_user']);
$stmt->bindParam(':image', $_POST["image"]);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_COLUMN);
unlink("../" . $data[0]);
$stmt = $pdo->prepare("DELETE FROM `images` WHERE user = :name AND `image_id` = :image");
$stmt->bindParam(':name', $_SESSION['logged_on_user']);
$stmt->bindParam(':image', $_POST["image"]);
$stmt->execute();
$images = getImageData($_SESSION['logged_on_user']);
$stmt = $pdo->prepare("SELECT `image_path` FROM `images` WHERE `is_main` = 'Y'");
$stmt->execute();
$check = $stmt->fetchAll(PDO::FETCH_COLUMN);
if (count($check) != 1)
{
    $newpfp = $images[0]['image_id'];
    $stmt = $pdo->prepare("UPDATE `images` SET `is_main` = 'Y' WHERE `image_id` = :image");
    $stmt->bindParam(':image', $newpfp);
    $stmt->execute();
}
$pdo = NULL;
exit;