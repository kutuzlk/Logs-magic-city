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
		<title>Name Logs</title>
	<link href="assets/styles.css" rel="stylesheet" type="text/css">

	<tr>
	<h1 style="text-align: center;"><font color="1168a6"><font size="6"><font face="Tahoma, Geneva, sans-serif"> </font></font></font></h1>

	
	<tbody>
	

    </form>
	
</html>
<tr>
<td class="middel"><div class="box">
<div class="boxtitle">Логи бизнесов:</div></td><p>
<?php
require_once("includes/logs.php");

echo '
<table width="100%">
<tr>
<td><b>ID</b></td>
<td><b>Владелец</b></td>
<td><b>Цена</b></td>
<td><b>Тип</b></td>
<td><b>Деньги</b></td>
<td><b>Мафия</b></td>
</tr>';

$result = mysqli_query($con, "SELECT * FROM businesses");

// берем результаты из каждой строки
while($row=mysqli_fetch_array($result))

    echo '<tr>
    <td>' . $row['id'] . '</td>
    <td>' . $row['owner'] . '</td>
    <td>' . $row['sellprice'] . '</td>
    <td>' . $row['type'] . '</td>
    <td>' . $row['money'] . '</td>
    <td>' . $row['mafia'] . '</td>
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