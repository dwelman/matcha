<?php

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    file_put_contents("log.txt", print_r($_POST, true));

    if ($_POST['gender'] != "M" && $_POST['gender'] != "F" && $_POST['gender'] != "B")
        die("Error : Unknown Gender");

    if ($_POST['gender'] != "M" && $_POST['gender'] != "F" && $_POST['gender'] != "B")
        $gender = "B";

    if (!preg_match('/^[A-Za-z -]+$/', trim($_POST["name"])) || !(strlen(trim($_POST["name"])) <= 24))
        die("ERROR : Invalid name");

    if (!preg_match('/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/', $_POST["email"]))
        die("ERROR : Invalid name");

    $_POST['bio'] = preg_replace("/>/", "&lt;", $_POST['bio']);
    $_POST['bio'] = preg_replace("/</", "&gt;", $_POST['bio']);

    file_put_contents("log.txt", $_POST['bio']);