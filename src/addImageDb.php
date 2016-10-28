<?php
	include "../config/connect.php";

	function addImageDb($path, $name, $user, $is_main)
	{
		$pdo = connect();
		$sql = $pdo->query("USE db_matcha");
		$stmt = $pdo->prepare("INSERT INTO images (image_id, image_path , user, is_main ) 
								VALUES (:image_id, :image_path, :user, :is_main)");
		$path = substr($path, 3);
		$stmt->bindParam(':image_id', $name);
		$stmt->bindParam(':image_path',$path);
		$stmt->bindParam(':user', $user);
        $stmt->bindParam(':is_main', $is_main);
        $stmt->execute();
		$pdo = null;
	}
?>