<?php
	include "connect.php";

	$pdo = connect();
	$sql = $pdo->query("USE db_matcha");

	$var = "fem_user1";
	$var1 = hash("whirlpool", "123456");
	$var2 = "1@email.com";
	$var3 = "Roxy";
	$var4 = "Example";
	$var5 = 19;
	$var6 = "F";
	$var7 = "B";
	$var8 = "Your parents will love me";
	$var9 = 75;

	$stmt = $pdo->prepare("INSERT INTO users (username, password, email, name, surname, age, gender, preference, bio, fame)
		VALUES (:username, :password, :email, :name, :surname, :age, :gender, :preference, :bio, :fame)");
	$stmt->bindParam(":username", $var);
	$stmt->bindParam(":password", $var1);
	$stmt->bindParam(":email", $var2);
	$stmt->bindParam("name", $var3);
	$stmt->bindParam(":surname", $var4);
	$stmt->bindParam(":age", $var5);
	$stmt->bindParam(":gender", $var6);
	$stmt->bindParam(":preference", $var7);
	$stmt->bindParam(":bio", $var8);
	$stmt->bindParam(":fame", $var9);
	$stmt->execute();

	$pdo->query('INSERT INTO user_interests (interest, user)
			VALUES ("Programming", "fem_user1")');
	$pdo->query('INSERT INTO user_interests (interest, user)
			VALUES ("Gaming", "fem_user1")');
	$pdo->query('INSERT INTO user_interests (interest, user)
			VALUES ("Anime", "fem_user1")');
	$pdo->query('INSERT INTO user_interests (interest, user)
			VALUES ("Cooking", "fem_user1")');
	$pdo->query('INSERT INTO user_interests (interest, user)
			VALUES ("Fitness", "fem_user1")');

	$var = "fem_user2";
	$var1 = hash("whirlpool", "123456");
	$var2 = "2@email.com";
	$var3 = "Gertrude";
	$var4 = "Example";
	$var5 = 45;
	$var6 = "F";
	$var7 = "M";
	$var8 = "You'll love my 13 cats";
	$var9 = 2;

	$stmt = $pdo->prepare("INSERT INTO users (username, password, email, name, surname, age, gender, preference, bio, fame)
		VALUES (:username, :password, :email, :name, :surname, :age, :gender, :preference, :bio, :fame)");
	$stmt->bindParam(":username", $var);
	$stmt->bindParam(":password", $var1);
	$stmt->bindParam(":email", $var2);
	$stmt->bindParam("name", $var3);
	$stmt->bindParam(":surname", $var4);
	$stmt->bindParam(":age", $var5);
	$stmt->bindParam(":gender", $var6);
	$stmt->bindParam(":preference", $var7);
	$stmt->bindParam(":bio", $var8);
	$stmt->bindParam(":fame", $var9);
	$stmt->execute();

	$pdo->query('INSERT INTO user_interests (interest, user)
			VALUES ("Cats", "fem_user2")');
	$pdo->query('INSERT INTO user_interests (interest, user)
			VALUES ("Smoking", "fem_user2")');
	$pdo->query('INSERT INTO user_interests (interest, user)
			VALUES ("Knitting", "fem_user2")');
	$pdo->query('INSERT INTO user_interests (interest, user)
			VALUES ("Cabbage", "fem_user2")');

	$var = "fem_user3";
	$var1 = hash("whirlpool", "123456");
	$var2 = "6@email.com";
	$var3 = "Tiffany";
	$var4 = "Example";
	$var5 = 22;
	$var6 = "F";
	$var7 = "F";
	$var8 = "Let's get freaky";
	$var9 = 60;

	$stmt = $pdo->prepare("INSERT INTO users (username, password, email, name, surname, age, gender, preference, bio, fame)
		VALUES (:username, :password, :email, :name, :surname, :age, :gender, :preference, :bio, :fame)");
	$stmt->bindParam(":username", $var);
	$stmt->bindParam(":password", $var1);
	$stmt->bindParam(":email", $var2);
	$stmt->bindParam("name", $var3);
	$stmt->bindParam(":surname", $var4);
	$stmt->bindParam(":age", $var5);
	$stmt->bindParam(":gender", $var6);
	$stmt->bindParam(":preference", $var7);
	$stmt->bindParam(":bio", $var8);
	$stmt->bindParam(":fame", $var9);
	$stmt->execute();

	$pdo->query('INSERT INTO user_interests (interest, user)
			VALUES ("Anime", "fem_user3")');
	$pdo->query('INSERT INTO user_interests (interest, user)
			VALUES ("Women", "fem_user3")');
	$pdo->query('INSERT INTO user_interests (interest, user)
			VALUES ("Cats", "fem_user3")');
	$pdo->query('INSERT INTO user_interests (interest, user)
			VALUES ("Cooking", "fem_user3")');
	$pdo->query('INSERT INTO user_interests (interest, user)
			VALUES ("Fitness", "fem_user3")');

	$var = "male_user1";
	$var1 = hash("whirlpool", "123456");
	$var2 = "3@email.com";
	$var3 = "John";
	$var4 = "Example";
	$var5 = 27;
	$var6 = "M";
	$var7 = "F";
	$var8 = "I care for the sick and needy";
	$var9 = 56;

	$stmt = $pdo->prepare("INSERT INTO users (username, password, email, name, surname, age, gender, preference, bio, fame)
		VALUES (:username, :password, :email, :name, :surname, :age, :gender, :preference, :bio, :fame)");
	$stmt->bindParam(":username", $var);
	$stmt->bindParam(":password", $var1);
	$stmt->bindParam(":email", $var2);
	$stmt->bindParam("name", $var3);
	$stmt->bindParam(":surname", $var4);
	$stmt->bindParam(":age", $var5);
	$stmt->bindParam(":gender", $var6);
	$stmt->bindParam(":preference", $var7);
	$stmt->bindParam(":bio", $var8);
	$stmt->bindParam(":fame", $var9);
	$stmt->execute();

	$pdo->query('INSERT INTO user_interests (interest, user)
			VALUES ("Fitness", "male_user1")');
	$pdo->query('INSERT INTO user_interests (interest, user)
			VALUES ("Community", "male_user1")');
	$pdo->query('INSERT INTO user_interests (interest, user)
			VALUES ("Cooking", "male_user1")');
	$pdo->query('INSERT INTO user_interests (interest, user)
			VALUES ("Lifting", "male_user1")');

	$var = "male_user2";
	$var1 = hash("whirlpool", "123456");
	$var2 = "4@email.com";
	$var3 = "Steve";
	$var4 = "Example";
	$var5 = 25;
	$var6 = "M";
	$var7 = "M";
	$var8 = "I love my sweaters";
	$var9 = 35;

	$stmt = $pdo->prepare("INSERT INTO users (username, password, email, name, surname, age, gender, preference, bio, fame)
		VALUES (:username, :password, :email, :name, :surname, :age, :gender, :preference, :bio, :fame)");
	$stmt->bindParam(":username", $var);
	$stmt->bindParam(":password", $var1);
	$stmt->bindParam(":email", $var2);
	$stmt->bindParam("name", $var3);
	$stmt->bindParam(":surname", $var4);
	$stmt->bindParam(":age", $var5);
	$stmt->bindParam(":gender", $var6);
	$stmt->bindParam(":preference", $var7);
	$stmt->bindParam(":bio", $var8);
	$stmt->bindParam(":fame", $var9);
	$stmt->execute();

	$pdo->query('INSERT INTO user_interests (interest, user)
			VALUES ("Fitness", "male_user2")');
	$pdo->query('INSERT INTO user_interests (interest, user)
			VALUES ("Knitting", "male_user2")');
	$pdo->query('INSERT INTO user_interests (interest, user)
			VALUES ("Soup", "male_user2")');
	$pdo->query('INSERT INTO user_interests (interest, user)
			VALUES ("Cats", "male_user2")');

	$var = "male_user3";
	$var1 = hash("whirlpool", "123456");
	$var2 = "5@email.com";
	$var3 = "Chan";
	$var4 = "Example";
	$var5 = 92;
	$var6 = "M";
	$var7 = "F";
	$var8 = "I very old";
	$var9 = 3;

	$stmt = $pdo->prepare("INSERT INTO users (username, password, email, name, surname, age, gender, preference, bio, fame)
		VALUES (:username, :password, :email, :name, :surname, :age, :gender, :preference, :bio, :fame)");
	$stmt->bindParam(":username", $var);
	$stmt->bindParam(":password", $var1);
	$stmt->bindParam(":email", $var2);
	$stmt->bindParam("name", $var3);
	$stmt->bindParam(":surname", $var4);
	$stmt->bindParam(":age", $var5);
	$stmt->bindParam(":gender", $var6);
	$stmt->bindParam(":preference", $var7);
	$stmt->bindParam(":bio", $var8);
	$stmt->bindParam(":fame", $var9);
	$stmt->execute();

	$pdo->query('INSERT INTO user_interests (interest, user)
			VALUES ("Smoking", "male_user3")');
	$pdo->query('INSERT INTO user_interests (interest, user)
			VALUES ("Cabbage", "male_user3")');
	$pdo->query('INSERT INTO user_interests (interest, user)
			VALUES ("Cats", "male_user3")');

	$pdo->query('INSERT INTO images (image_id, image_path, user, is_main)
			VALUES (1, "TestImages/fem_user1.jpg", "fem_user1", "Y")');
	$pdo->query('INSERT INTO images (image_id, image_path, user, is_main)
			VALUES (2, "TestImages/fem_user2.jpg", "fem_user2", "Y")');
	$pdo->query('INSERT INTO images (image_id, image_path, user, is_main)
			VALUES (3, "TestImages/fem_user3.jpg", "fem_user3", "Y")');
	$pdo->query('INSERT INTO images (image_id, image_path, user, is_main)
			VALUES (4, "TestImages/male_user1.jpeg", "male_user1", "Y")');
	$pdo->query('INSERT INTO images (image_id, image_path, user, is_main)
			VALUES (5, "TestImages/male_user2.jpeg", "male_user2", "Y")');
	$pdo->query('INSERT INTO images (image_id, image_path, user, is_main)
			VALUES (6, "TestImages/male_user3.jpeg", "male_user3", "Y")');
	echo "Test profiles made\n";
?>