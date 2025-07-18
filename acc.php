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
<div class="boxtitle">Аккаунты:</div></td><p>
<?php
require_once("includes/logs.php");

echo '
<table width="100%">
<tr>
<td><b>Логин</b></td>
<td><b>Почта</b></td>
<td><b>IP</b></td>
<td><b>SocialClub</b></td>
<td><b>R-Coin</b></td>
<td><b>VIP</b></td>
<td><b>Окончание VIP</b></td>
<td><b>Аккаунт 1</b></td>
<td><b>Аккаунт 2</b></td>
<td><b>Аккаунт 3</b></td>
</tr>';

$result = mysqli_query($con, "SELECT * FROM accounts");

// берем результаты из каждой строки
while($row=mysqli_fetch_array($result))

    echo '<tr>
    <td>' . $row['login'] . '</td>
    <td>' . $row['email'] . '</td>
    <td>' . $row['ip'] . '</td>
    <td>' . $row['socialclub'] . '</td>
    <td>' . $row['redbucks'] . '</td>
    <td>' . $row['viplvl'] . '</td>
    <td>' . $row['vipdate'] . '</td>
    <td>' . $row['character1'] . '</td>
    <td>' . $row['character2'] . '</td>
    <td>' . $row['character3'] . '</td>
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