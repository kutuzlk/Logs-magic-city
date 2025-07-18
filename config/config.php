<?php
$servername = "localhost";
$username = "root";
$password = "root";
$database = "main"; // замените на имя вашей базы

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");
?>
