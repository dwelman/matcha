<?php
include "../config/connect.php";

session_start();
$user = $_SESSION['logged_on_user'];
if ($user == "")
    die();
$pdo = connect();
$sql = $pdo->query("USE db_matcha");
$stmt = $pdo->prepare("SELECT message, link, id FROM notifications
                        WHERE user = :user");
$stmt->bindParam(':user', $user);
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
    $data[] = $row;
}
echo json_encode($data);