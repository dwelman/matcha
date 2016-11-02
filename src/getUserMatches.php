<?php
include "../config/connect.php";
session_start();
$user = $_SESSION['logged_on_user'];
if (!function_exists("connect"))
    file_put_contents("log.txt","Cant find connect function, aborting");
$pdo = connect();
if ($user == "")
{
    die(">>>BREACH<<< : User not logged on!");
}

$sql = $pdo->query("USE db_matcha");
$stmt = $pdo->prepare("SELECT liked_user FROM likes WHERE user = :username");
$stmt->bindParam(":username", $user);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($data as $like)
{
    $stmt = $pdo->prepare("SELECT liked_user FROM likes WHERE user = :username AND liked_user = :liked_user");
    $stmt->bindParam(":username", $like['liked_user']);
    $stmt->bindParam(":liked_user", $user);
    $stmt->execute();
    if ($stmt->rowCount() > 0)
    {
        //get info
        $stmt = $pdo->prepare("SELECT username, name, surname FROM users WHERE username = :username");
        $stmt->bindParam(":username", $like['liked_user']);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //get profile pic
        $stmt = $pdo->prepare("SELECT image_path FROM images WHERE user = :username AND is_main = 'Y'");
        $stmt->bindParam(":username", $like['liked_user']);
        $stmt->execute();
        $imgdata = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $data[0]['profile_pic'] = $imgdata[0]['image_path'];
        $matches[] = $data[0];
    }
}
echo json_encode($matches);
