<?php
session_start();
require_once("includes/connection.php");

if(isset($_SESSION["session_username"])) {
    header("Location: main.php");
    exit();
}

$error_message = '';

if(isset($_POST["login"])) {
    if(!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        
        try {
            // Проверяем пользователя в таблице user базы ra3_main
            $query = "SELECT * FROM user WHERE username = ? AND password = ? AND admin > 0";
            if($stmt = mysqli_prepare($con, $query)) {
                mysqli_stmt_bind_param($stmt, "ss", $username, $password);
                
                if(mysqli_stmt_execute($stmt)) {
                    $result = mysqli_stmt_get_result($stmt);
                    
                    if($result && mysqli_num_rows($result) > 0) {
                        $user = mysqli_fetch_assoc($result);
                        // Проверяем, что пользователь имеет права администратора
                        if($user['admin'] > 0) {
                            $_SESSION['session_username'] = $user['username'];
                            $_SESSION['user_id'] = $user['id'];
                            $_SESSION['user_role'] = $user['admin'];
                            $_SESSION['authorized'] = true;
                            header("Location: main.php");
                            exit();
                        } else {
                            $error_message = "У вас нет прав доступа к системе!";
                        }
                    } else {
                        $error_message = "Неверный логин или пароль!";
                    }
                } else {
                    throw new Exception("Ошибка выполнения запроса: " . mysqli_error($con));
                }
                
                mysqli_stmt_close($stmt);
            } else {
                throw new Exception("Ошибка подготовки запроса: " . mysqli_error($con));
            }
        } catch (Exception $e) {
            $error_message = "Ошибка системы: " . $e->getMessage();
        }
    } else {
        $error_message = "Все поля обязательны для заполнения!";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация | Панель администратора</title>
    <link href="assets/styles.css" rel="stylesheet" type="text/css">
</head>
<body class="login-page">
    <div class="login-container">
        <div class="login-box">
            <div class="login-header">
                <h2>Авторизация</h2>
                <div class="login-subtitle">Панель администратора</div>
            </div>
            
            <?php if(!empty($error_message)): ?>
            <div class="error-message">
                <?php echo htmlspecialchars($error_message); ?>
            </div>
            <?php endif; ?>
            
            <form method="post" action="" class="login-form">
                <div class="form-group">
                    <label for="username">Логин</label>
                    <input type="text" name="username" id="username" 
                           placeholder="Введите логин" autocomplete="off"
                           value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                </div>
                
                <div class="form-group">
                    <label for="password">Пароль</label>
                    <input type="password" name="password" id="password" 
                           placeholder="Введите пароль">
                </div>
                
                <button type="submit" name="login" class="login-button">
                    Войти в систему
                </button>
            </form>
        </div>
    </div>
</body>
</html>
