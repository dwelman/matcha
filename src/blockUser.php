<?php
	include "userBlock.php";
	session_start();
	if ($_POST["submit"] === "submit" || $_SESSION["logged_on_user"] != "")
	{
		blockUser($_SESSION["logged_on_user"], $_POST["user"]);
	}
	header("Location: ../memberLanding.php");
?>