<?php 
session_start();
if(!isset($_SESSION["session_username"])) {
	header("location:login.php");
} else {
?>
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
<a href=logout.php><li>Выйти</li></a></td></tr></table></div><html>
	<head>
		<title>name Logs</title>
	<link href="assets/styles.css" rel="stylesheet" type="text/css">
	<tr>
	<h1 style="text-align: center;"><font color="1168a6"><font size="6"><font face="Tahoma, Geneva, sans-serif"> </font></font></font></h1>

	
	<tbody>
	

    </form>
	
</html>
<tr>
<td class="middel"><div class="box">
<div class="boxtitle">Аккаунты:</div></td><p>
<?php
require_once("includes/logs.php");

echo '
<table width="100%">
<tr>
<td><b>StaticID</b></td>
<td><b>Дата удаление?</b></td>
<td><b>Имя</b></td>
<td><b>Фамилия</b></td>
<td><b>Уровень</b></td>
<td><b>EXP</b></td>
<td><b>Деньги</b></td>
<td><b>Номер банка</b></td>
<td><b>Розыск</b></td>
<td><b>Бизнес</b></td>
<td><b>Номер Телефона</b></td>
<td><b>Дата создание</b></td>
<td><b>Смертей</b></td>
<td><b>Убийств</b></td>
</tr>';

$result = mysqli_query($con, "SELECT * FROM characters");

// берем результаты из каждой строки
while($row=mysqli_fetch_array($result))

    echo '<tr>
    <td>' . $row['uuid'] . '</td>
    <td>' . $row['IsDelete'] . '</td>
    <td>' . $row['firstname'] . '</td>
    <td>' . $row['lastname'] . '</td>
    <td>' . $row['lvl'] . '</td>
    <td>' . $row['exp'] . '</td>
    <td>' . $row['money'] . '</td>
    <td>' . $row['bank'] . '</td>
    <td>' . $row['wanted'] . '</td>
    <td>' . $row['biz'] . '</td>
    <td>' . $row['sim'] . '</td>
    <td>' . $row['createdate'] . '</td>
    <td>' . $row['deaths'] . '</td>
    <td>' . $row['kills'] . '</td>
    </tr>';
}
echo '</table>';


?>
</div>

<html>
<footer class="main-footer">
    </footer>
</html>
<?php

?>