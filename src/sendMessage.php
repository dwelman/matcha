<?php
include "../config/connect.php";

$_POST['message'] = htmlspecialchars($_POST['message']);
file_put_contents("log.txt", print_r($_POST,true));
session_start();
$user = $_SESSION['logged_on_user'];
if ($user == "")
    die();
$_POST['message'] = trim($_POST['message']);
if (strlen($_POST['message']) > 500 || strlen($_POST['message']) <= 0)
    die("Message too long. Aborting");
file_put_contents("log.txt", $_POST['message']);
$pdo = connect();
$sql = $pdo->query("USE db_matcha");
$stmt = $pdo->prepare("INSERT INTO chat (user, user_to, message)
                        VALUES (:user, :user_to, :message)");
$stmt->bindParam(':user', $user);
$stmt->bindParam(':user_to',$_POST['user_to']);
$stmt->bindParam(':message',$_POST['message']);
$stmt->execute();
$stmt = $pdo->prepare("INSERT INTO notifications (user, message)
                        VALUES (:user, :message)");
$stmt->bindParam(':user', $user);
$notmes = "You received a message from " . $_POST['user_to'];
$stmt->bindParam(':message', $notmes);
$stmt->execute();
