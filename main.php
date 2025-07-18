<?php 
session_start();
if(!isset($_SESSION["session_username"])) {
  header("location:login.php");
} else {
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>name Logs</title>
<link href="assets/styles.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>
</head>
</html>
<div class="menu"><table width="100%"><tr><td><ul>
<a href=main.php><li>Главная</li></a>

<a href=admin_logs.php><li>Админ действия</li></a>
<a href=admins.php><li>Админы</li></a>
<a href=leaders.php><li>Фракции</li></a>
<a href=houses.php><li>Дома</li></a>
<a href=biz.php><li>Бизнесы</li></a>
<a href=сharacters.php><li>Аккаунты</li></a>
<a href=acc.php><li>Логины</li></a>
 
 
<a><ul><td valign="top" align="right"></td><td valign="top" align="right">
<a href rel=no><li><?php echo $_SESSION['session_username'];?></li></a>
<a href=logout.php><li>Выйти</li></a></td></tr></table></div>
<html>

	</script></td></a></td></tr></table></div>
    <div class="right"><div id="content">
    <table width="100%" border="0">
  <tbody>
    <tr>
      <td class="top"><h1>Логи</h1></td>
    </tr>
    <tr>
      <td class="middel"><div class="box">
        <div class="boxtitle">Приветствую.</div><big>Сайт логов <font color="B22222">Name Project</big></font></a>.<br/><hr><?php require_once("includes/connection.php"); $result = mysqli_query($con, "Select COUNT(id) as count FROM `user`");

if(!$result) {
    die('Error: ' . mysqli_error($con));
} else {
    $num_rows = mysqli_fetch_assoc($result);

    echo "Количество зарегистрированных аккаунтов в базе данных: " . $num_rows['count'];
} ?></div></td>
    </tr>
  </tbody>
</table>

</html>
<?php
}
?>