<?php
    include "getImageData.php";

    session_start();
    $user = $_SESSION['logged_on_user'];
    if ($user == "")
        exit;
    echo json_encode(getImageData($user));

