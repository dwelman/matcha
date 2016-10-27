<?php
    include "../config/connect.php";

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    file_put_contents("log.txt", print_r($_POST, true));

    if ($_POST['gender'] != "M" && $_POST['gender'] != "F" && $_POST['gender'] != "B")
        die("Error : Unknown Gender");

    if ($_POST['gender'] != "M" && $_POST['gender'] != "F" && $_POST['gender'] != "B")
        $gender = "B";

    if (!preg_match('/^[A-Za-z -]+$/', trim($_POST["name"])) || !(strlen(trim($_POST["name"])) <= 24))
        die("ERROR : Invalid name");

    if (!preg_match('/^[A-Za-z -]+$/', trim($_POST["surname"])) || !(strlen(trim($_POST["surname"])) <= 24))
        die("ERROR : Invalid surname");

    if (!preg_match('/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/', $_POST["email"]))
        die("ERROR : Invalid email");

    $_POST['bio'] = htmlspecialchars($_POST['bio']);
    $pdo = connect();
    $sql = $pdo->query("USE db_matcha");
    $stmt = $pdo->prepare("UPDATE `users` SET `bio` = :bio, `gender` = :gender, `preference` = :pref, `name` = :name, `surname` = :surname, `email` = :email");
    $stmt->bindParam(':bio', $_POST['bio']);
    $stmt->bindParam(':gender', $_POST['gender']);
    $stmt->bindParam(':pref', $_POST['preference']);
    $stmt->bindParam(':name', $_POST['name']);
    $stmt->bindParam(':surname', $_POST['surname']);
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->execute();
