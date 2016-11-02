<?php
include "getImageData.php";

file_put_contents("log3.txt", print_r($_POST, true));
session_start();
$user = $_SESSION['logged_on_user'];
$liked = $_POST['like'];

if ($user == "")
    die();

$data = getImageData($liked);
if (count($data) <= 0)
    die("Liked user does not have any photos");
$data = getImageData($user);
if (count($data) <= 0)
    die("User does not have any photos");
$data = NULL;

$pdo = connect();
$sql = $pdo->query("USE db_matcha");
$stmt = $pdo->prepare("SELECT * FROM likes WHERE user = :username AND liked_user = :liked_user");
$stmt->bindParam(":username", $user);
$stmt->bindParam(":liked_user", $liked);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($stmt->rowCount() == 0)
{
    $stmt = $pdo->prepare("INSERT INTO likes (liked_user, user)
                            VALUES (:liked_user, :username)");
    $stmt->bindParam(":username", $user);
    $stmt->bindParam(":liked_user", $liked);
    $stmt->execute();
    $sql = $pdo->query("USE db_matcha");
    $stmt = $pdo->prepare("UPDATE users SET fame = fame + 10 WHERE username = :name");
    $stmt->bindParam(':name', $liked);
    $stmt->execute();
}
else
{
    $stmt = $pdo->prepare("DELETE FROM likes WHERE user = :username AND liked_user = :liked_user");
    $stmt->bindParam(":username", $user);
    $stmt->bindParam(":liked_user", $liked);
    $stmt->execute();
    $sql = $pdo->query("USE db_matcha");
    $stmt = $pdo->prepare("UPDATE users SET fame = fame - 10 WHERE username = :name");
    $stmt->bindParam(':name', $liked);
    $stmt->execute();
}