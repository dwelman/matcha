<?php
    include "../config/connect.php";

    function getImageData($user)
    {
        if (!function_exists("connect"))
            file_put_contents("log.txt","Cant find connect function, aborting");
        $pdo = connect();
        if ($user == "null")
        {
            die(">>>BREACH<<< : User not logged on!");
        }
        $sql = $pdo->query("USE db_matcha");
        $stmt = $pdo->prepare("SELECT image_path , is_main FROM images WHERE user = :username");
        $stmt->bindParam(":username", $user);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
    }
    session_start();
    $user = $_SESSION['logged_on_user'];
    $user = "deandt";
    getImageData($user);
?>