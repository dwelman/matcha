<?php
include_once "addImageDb.php";
include_once "getImageData.php";

function getImageName()
{
	$name = uniqid("IMG-") . ".png";
	return $name;
}

function uploadUserImage($over_id, $user)
{

    $name = $_FILES['user']['name'];
	$tmpLoc = $_FILES['user']['tmp_name'];
	$type = $_FILES['user']['type'];
	$size = $_FILES['user']['size'];
	$err = $_FILES['user']['error'];
	if (empty($name))
	{
		echo "ERROR: Please browse for a file before clicking the upload button.";
		exit;
	}
	$extpos = strrpos($name, ".", 0);
	$ext = strtolower(substr($name, $extpos));
	$newName = getImageName();
	$path = "../images/" . $newName;
	if ($ext != ".jpg" && $ext != ".jpeg" && $ext != ".png")
	{
		echo "ERROR: Only jpeg and png images are supported.";
		if (file_exists($tmpLoc))
			unlink($tmpLoc);
		exit;
	}
	if(move_uploaded_file($tmpLoc, $path))
	{
		addImageDb($path, $newName, $user, "N");
	}
   	else
	{
		echo "move_uploaded_file function failed";
		exit;
	}
}
	session_start();
	$user = $_SESSION['logged_on_user'];	
	if ($user == "")
		exit;
    //$images = getImageData($user);
    if (count($images) >= 5)
    {
        echo "Image limit reached, aborting";
        exit;
    }
	if (file_exists('../images') == false)
	{
		echo "Directory not made, creating";
		mkdir('../images');
	}
	if (isset($_FILES['user']))
	{
		uploadUserImage($over, $user);	
	}
	else
	{
		echo "ERROR: Please browse for a file before clicking the upload button.";
		exit;
	}
?>