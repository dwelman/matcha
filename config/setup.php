<?php
	include "connect.php";

	$pdo = connect();
	//Create Database
	$sql_retval = $pdo->query("DROP DATABASE IF EXISTS db_camagru");
	$sql_retval = $pdo->query("CREATE DATABASE db_camagru");
	if (!$sql_retval)
		die ("Error: Database could not be created\n");
	echo "Datatbase created!\n";

	$sql_retval = $pdo->query("USE db_camagru");
	//Create tables
	$query = "CREATE TABLE `users` (
		username VARCHAR( 24 ) NOT NULL PRIMARY KEY,
		password VARCHAR( 128 ) NOT NULL,
		email VARCHAR( 128 ) NOT NULL,
		verified ENUM( 'yes', 'no' ) NOT NULL DEFAULT 'no'
		)";
	$sql_retval = $pdo->query($query);
	if (!$sql_retval)
		die ("Error: users table could not be created\n");
	echo "users table created\n";

	$query = "CREATE TABLE `images` (
		image_id VARCHAR( 24 ) NOT NULL PRIMARY KEY,
		image_url VARCHAR( 128 ) NOT NULL,
		date_created TIMESTAMP NOT NULL,
		user VARCHAR( 24 ) NOT NULL
		)";
	$sql_retval = $pdo->query($query);
	if (!$sql_retval)
		die ("Error: images table could not be created\n");
	echo "images table created\n";

	$query = "CREATE TABLE `comments` (
		comment_id VARCHAR( 24 ) NOT NULL PRIMARY KEY,
		image_id VARCHAR( 24 ) NOT NULL,
		comment VARCHAR( 256 ) NOT NULL,
		user VARCHAR( 24 ) NOT NULL, 
		date_posted TIMESTAMP NOT NULL
		)";
	$sql_query = $pdo->query($query);
	if (!$sql_query)
		die ("Error: comments table could not be created\n");
	echo "comments table created\n";

	$query = "CREATE TABLE `likes` (
		like_id VARCHAR( 24 ) NOT NULL PRIMARY KEY,
		image_id VARCHAR( 24 ) NOT NULL,
		user VARCHAR( 24 ) NOT NULL
		)";
	$sql_query = $pdo->query($query);
	if (!$sql_query)
		die ("Error: comments table could not be created\n");
	echo "likes table created\n";

	//Create directories
	shell_exec("rm -rf ../images");
	mkdir("../images", 0777);
	echo "images directory created\n";
?>