<?php
// Параметры подключения к базе данных
define('DB_HOST', 'localhost'); // Хост базы данных
define('DB_NAME', 'main'); // Изменено на ra3_main
define('DB_USER', 'root'); // Имя пользователя для OpenServer
define('DB_PASS', 'root'); // Пароль для OpenServer по умолчанию

// Установка часового пояса
date_default_timezone_set('Europe/Moscow');

// Создаем подключение
try {
    $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    // Проверяем подключение
    if (!$con) {
        throw new Exception("Ошибка подключения: " . mysqli_connect_error());
    }
    
    // Устанавливаем кодировку
    mysqli_set_charset($con, "utf8");
    
} catch (Exception $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}

// Создаем PDO подключение для более современного способа работы с БД
try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        ]
    );
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных (PDO): " . $e->getMessage());
}

// Функция для проверки авторизации
function checkAuth() {
    if (!isset($_SESSION['session_username'])) {
        header("Location: login.php");
        exit();
    }
}

// Функция для безопасного вывода данных
function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

    ?>