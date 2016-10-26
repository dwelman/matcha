<?php
    include "../config/connect.php";
    session_start();
    $user = $_SESSION['logged_on_user'];

    $wd = getcwd();
    if (!function_exists("connect"))
        file_put_contents("log.txt","Cant find connect function, aborting");
    $pdo = connect();
    if ($user == "null")
    {
        die(">>>BREACH<<< : User not logged on!");
    }
    $sql = $pdo->query("USE db_matcha");
    $stmt = $pdo->prepare("SELECT username, email, name, surname, gender, bio, preference, fame FROM users WHERE username = :username");
    $stmt->bindParam(":username", $user);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($data) != 1)
    {
        die(">>>BREACH<<< : User not found!");
    }
    echo json_encode($data);
