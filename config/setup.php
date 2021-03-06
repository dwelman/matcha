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
		age INT NOT NULL,
		gender ENUM( 'M', 'F' ) NOT NULL,
		bio VARCHAR( 500 ),
		preference ENUM ( 'M', 'F', 'B' ) NOT NULL DEFAULT 'B',
		date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		fame INT NOT NULL DEFAULT 0,
		last_online TIMESTAMP DEFAULT NOW()
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

	$query = "CREATE TABLE `user_interests` (
		id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		interest VARCHAR( 56 ) NOT NULL,
		user VARCHAR( 24 ) NOT NULL
		)";
	$sql_retval = $pdo->query($query);
	if (!$sql_retval)
		die ("Error: user_interests table could not be created\n");
	echo "user_interests table created\n";

	$query = "CREATE TABLE `likes` (
		id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		user VARCHAR( 24 ) NOT NULL,
		liked_user VARCHAR( 24 ) NOT NULL
		)";
	$sql_retval = $pdo->query($query);
	if (!$sql_retval)
		die ("Error: likes table could not be created\n");
	echo "likes table created\n";

	$query = "CREATE TABLE `blocks` (
		id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		user VARCHAR( 24 ) NOT NULL,
		blocked_user VARCHAR( 24 ) NOT NULL
		)";
	$sql_retval = $pdo->query($query);
	if (!$sql_retval)
		die ("Error: blocks table could not be created\n");
	echo "blocks table created\n";

	$query = "CREATE TABLE `reports` (
		id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		user VARCHAR( 24 ) NOT NULL,
		reported_user VARCHAR( 24 ) NOT NULL,
		reason VARCHAR( 500 )
		)";
	$sql_retval = $pdo->query($query);
	if (!$sql_retval)
		die ("Error: reports table could not be created\n");
	echo "reports table created\n";

	$query = "CREATE TABLE `notifications` (
		id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		user VARCHAR( 24 ) NOT NULL,
		date_created TIMESTAMP NOT NULL,
		message VARCHAR( 500 ),
		link VARCHAR( 64 ) NOT NULL
		)";
	$sql_retval = $pdo->query($query);
	if (!$sql_retval)
		die ("Error: notifications table could not be created\n");
	echo "notification table created\n";

	$query = "CREATE TABLE `chat` (
		id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		user VARCHAR( 24 ) NOT NULL,
		user_to VARCHAR( 24 ) NOT NULL,
		date_created TIMESTAMP NOT NULL,
		message VARCHAR( 500 ),
		has_read ENUM ( 'Y', 'N' ) NOT NULL DEFAULT 'N'
		)";
	$sql_retval = $pdo->query($query);
	if (!$sql_retval)
		die ("Error: chat table could not be created\n");
	echo "chat table created\n";

	$query = "CREATE TABLE `view_history` (
		id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		user VARCHAR( 24 ) NOT NULL,
		user_viewed VARCHAR( 24 ) NOT NULL,
		time_viewed TIMESTAMP NOT NULL
		)";
	$sql_retval = $pdo->query($query);
	if (!$sql_retval)
		die ("Error: view_history table could not be created\n");
	echo "view_history table created\n";

	//Create directories
	shell_exec("rm -rf ../images");
	mkdir("../images", 0777);
	echo "images directory created\n";
?>