<?php
session_start();
require_once 'includes/connection.php';
require_once 'includes/logs_connection.php';

// Проверка авторизации
if(!isset($_SESSION["session_username"])) {
    header("location:login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Админ действия</title>
    <link href="assets/styles.css" rel="stylesheet" type="text/css">

</head>
<body>
    <div class="menu">
        <table width="100%">
            <tr>
                <td>
                    <ul>
                        <a href="main.php"><li>Главная</li></a>
                        <a href="admin_logs.php"><li>Админ действия</li></a>
                        <a href="admins.php"><li>Админы</li></a>
                        <a href="leaders.php"><li>Фракции</li></a>
                        <a href="houses.php"><li>Дома</li></a>
                        <a href="biz.php"><li>Бизнесы</li></a>
                        <a href="characters.php"><li>Аккаунты</li></a>
                        <a href="acc.php"><li>Логины</li></a>
                    </ul>
                </td>
                <td valign="top" align="right">
                    <a href="#"><li><?php echo htmlspecialchars($_SESSION['session_username']); ?></li></a>
                    <a href="logout.php"><li>Выйти</li></a>
                </td>
            </tr>
        </table>
    </div>

    <div class="top">
        <div class="box">
            <div class="boxtitle">Действия администраторов</div>

            <?php
            try {
                // Получение параметров
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $search = isset($_GET['search']) ? trim($_GET['search']) : '';
                
                // Получение логов администраторов
                $data = getLogs($page, 50, $search);
                ?>

                <!-- Поиск -->
                <div class="filter-box">
                    <form method="GET" action="">
                        <input type="text" name="search" placeholder="Поиск по действиям администраторов..." 
                               value="<?php echo htmlspecialchars($search); ?>">
                        <button type="submit">Поиск</button>
                    </form>
                </div>

                <!-- Таблица логов -->
                <div class="logs-table">
                    <table width="100%">
                        <thead>
                            <tr>
                                <th>Дата и время</th>
                                <th>Администратор</th>
                                <th>Действие</th>
                                <th>Игрок</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['logs'] as $log): ?>
                            <tr>
                                <td><?php echo formatLogDate($log['time']); ?></td>
                                <td><?php echo htmlspecialchars($log['admin']); ?></td>
                                <td><?php echo htmlspecialchars($log['action']); ?></td>
                                <td><?php echo htmlspecialchars($log['player']); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Пагинация -->
                <?php if ($data['totalPages'] > 1): ?>
                <div class="pagination">
                    <?php if ($page > 1): ?>
                        <a href="?page=<?php echo ($page-1); ?><?php echo !empty($search) ? '&search='.urlencode($search) : ''; ?>" 
                           class="nav-btn">←</a>
                    <?php endif; ?>

                    <?php
                    $range = 2;
                    $showDots = false;
                    
                    for ($i = 1; $i <= $data['totalPages']; $i++) {
                        if ($i == 1 || $i == $data['totalPages'] || ($i >= $page - $range && $i <= $page + $range)) {
                            echo '<a href="?page=' . $i . (!empty($search) ? '&search='.urlencode($search) : '') . '"'
                                . ($page === $i ? ' class="active"' : '') . '>'
                                . $i . '</a>';
                            $showDots = true;
                        } elseif ($showDots) {
                            echo '<span class="dots">...</span>';
                            $showDots = false;
                        }
                    }
                    ?>

                    <?php if ($page < $data['totalPages']): ?>
                        <a href="?page=<?php echo ($page+1); ?><?php echo !empty($search) ? '&search='.urlencode($search) : ''; ?>" 
                           class="nav-btn">→</a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

            <?php
            } catch (Exception $e) {
                echo '<div class="error-message">' . htmlspecialchars($e->getMessage()) . '</div>';
            }
            ?>
        </div>
    </div>
</body>
</html>