<?php
include "../config/connect.php";

session_start();
$user = $_SESSION['logged_on_user'];
if ($user == "")
    die();
$pdo = connect();
$sql = $pdo->query("USE db_matcha");
$stmt = $pdo->prepare("SELECT user, user_to,date_created, message, has_read FROM chat
                        WHERE user = :user OR user_to = :user_to");
$stmt->bindParam(':user', $user);
$stmt->bindParam(':user_to', $user);
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
    $data[] = $row;
}
file_put_contents("log.txt", count($data));
echo json_encode($data);
