<?php

include_once "getImageData.php";

session_start();
$images = getImageData($_SESSION['logged_on_user']);
file_put_contents("log2.txt", print_r($images, true));
foreach ($images as $img)
{

}
