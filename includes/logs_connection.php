<?php
// Параметры подключения к базе данных логов
define('LOGS_DB_HOST', 'localhost');
define('LOGS_DB_NAME', 'mainlogs');
define('LOGS_DB_USER', 'root');
define('LOGS_DB_PASS', 'root');

// Установка часового пояса
date_default_timezone_set('Europe/Moscow');

// Создаем подключение к базе логов
try {
    $logs_con = mysqli_connect(LOGS_DB_HOST, LOGS_DB_USER, LOGS_DB_PASS, LOGS_DB_NAME);
    
    // Проверяем подключение
    if (!$logs_con) {
        throw new Exception("Ошибка подключения к базе логов: " . mysqli_connect_error());
    }
    
    // Устанавливаем кодировку
    mysqli_set_charset($logs_con, "utf8");
    
} catch (Exception $e) {
    die("Ошибка подключения к базе логов: " . $e->getMessage());
}

// Создаем PDO подключение для более современного способа работы с БД
try {
    $logs_pdo = new PDO(
        "mysql:host=" . LOGS_DB_HOST . ";dbname=" . LOGS_DB_NAME . ";charset=utf8",
        LOGS_DB_USER,
        LOGS_DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        ]
    );
} catch (PDOException $e) {
    die("Ошибка подключения к базе логов (PDO): " . $e->getMessage());
}

/**
 * Функция для безопасного получения логов с пагинацией
 * @param int $page Номер страницы
 * @param int $perPage Количество записей на странице
 * @param string|null $search Строка поиска
 * @return array Массив с логами и информацией о пагинации
 */
function getLogs($page = 1, $perPage = 50, $search = null) {
    global $logs_pdo;
    
    try {
        $params = [];
        $where = "";
        
        if ($search) {
            $where = " WHERE admin LIKE :search 
                      OR action LIKE :search 
                      OR player LIKE :search";
            $params[':search'] = "%$search%";
        }
        
        // Получаем общее количество записей
        $countQuery = $logs_pdo->prepare("SELECT COUNT(*) FROM adminlog" . $where);
        if (!empty($params)) {
            $countQuery->execute($params);
        } else {
            $countQuery->execute();
        }
        
        $total = $countQuery->fetchColumn();
        $totalPages = ceil($total / $perPage);
        
        // Получаем записи для текущей страницы
        $offset = ($page - 1) * $perPage;
        $query = $logs_pdo->prepare("
            SELECT * FROM adminlog
            $where
            ORDER BY time DESC 
            LIMIT :limit OFFSET :offset
        ");
        
        $query->bindValue(':limit', $perPage, PDO::PARAM_INT);
        $query->bindValue(':offset', $offset, PDO::PARAM_INT);
        
        if (!empty($params)) {
            foreach($params as $key => $value) {
                $query->bindValue($key, $value);
            }
        }
        
        $query->execute();
        $logs = $query->fetchAll();
        
        return [
            'logs' => $logs,
            'total' => $total,
            'totalPages' => $totalPages,
            'currentPage' => $page,
            'perPage' => $perPage
        ];
        
    } catch (PDOException $e) {
        throw new Exception("Ошибка при получении логов: " . $e->getMessage());
    }
}

/**
 * Функция для форматирования даты из логов
 * @param string $date Дата в формате из базы
 * @return string Отформатированная дата
 */
function formatLogDate($date) {
    return date('d.m.Y H:i:s', strtotime($date));
} 