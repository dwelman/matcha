<?php
	include "connect.php";

	$pdo = connect();
	//Create Database
	$sql_retval = $pdo->query("DROP DATABASE IF EXISTS db_matcha");
	$sql_retval = $pdo->query("CREATE DATABASE db_matcha");
	if (!$sql_retval)
		die ("Error: Database could not be created\n");
	echo "Datatbase created!\n";

	$sql_retval = $pdo->query("USE db_matcha");
	//Create tables
	$query = "CREATE TABLE `users` (
		username VARCHAR( 24 ) NOT NULL PRIMARY KEY,
		password VARCHAR( 128 ) NOT NULL,
		email VARCHAR( 128 ) NOT NULL,
		name VARCHAR( 24 ) NOT NULL,
		surname VARCHAR ( 24 ) NOT NULL,
		gender ENUM( 'M', 'F' ) NOT NULL,
		bio VARCHAR( 500 ),
		preference ENUM ( 'M', 'F', 'B' ) NOT NULL DEFAULT 'B',
		date_created TIMESTAMP NOT NULL,
		fame INT NOT NULL DEFAULT 0
		)";
	$sql_retval = $pdo->query($query);

	if (!$sql_retval)
		die ("Error: users table could not be created\n");
	echo "users table created\n";

	$query = "CREATE TABLE `images` (
		image_id VARCHAR( 24 ) NOT NULL PRIMARY KEY,
		image_path VARCHAR( 128 ) NOT NULL,
		user VARCHAR( 24 ) NOT NULL,
		is_main ENUM ( 'Y', 'N' ) NOT NULL DEFAULT 'N'
		)";
	$sql_retval = $pdo->query($query);
	if (!$sql_retval)
		die ("Error: images table could not be created\n");
	echo "images table created\n";

	$query = "CREATE TABLE `interests` (
		interest VARCHAR( 56 ) NOT NULL PRIMARY KEY
		)";
	$sql_retval = $pdo->query($query);
	if (!$sql_retval)
		die ("Error: interests table could not be created\n");
	echo "interests table created\n";

	$query = "CREATE TABLE `user_interests` (
		interest VARCHAR( 56 ) NOT NULL PRIMARY KEY,
		user VARCHAR( 24 ) NOT NULL
		)";
	$sql_retval = $pdo->query($query);
	if (!$sql_retval)
		die ("Error: user_interests table could not be created\n");
	echo "user_interests table created\n";

	//Create directories
	shell_exec("rm -rf ../images");
	mkdir("../images", 0777);
	echo "images directory created\n";
?>