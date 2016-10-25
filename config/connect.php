<?php
	function connect()
	{
		include "database.php";

		try
		{
			$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch (PDOException $e)
		{
			print "Error: " . $e->getMessage();
			die();
		}
	//	print "Connected to database successfully\n";
		return ($pdo);
	}
?>