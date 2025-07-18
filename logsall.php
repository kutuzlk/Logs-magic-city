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
<div class="boxtitle">Логи сервера:</div></td><p>
<?php
require_once("includes/logs.php");
mysqli_query("SET NAMES cp1251");
mysqli_query("SET CHARACTER SET cp1251");
mysqli_query("SET character_set_client = cp1251");
mysqli_query("SET character_set_connection = cp1251");
mysqli_query("SET character_set_results = utf8");
$result=mysqli_query($con,'SELECT * FROM  logsall ORDER BY date DESC LIMIT 0,200');
// берем результаты из каждой строки
while($row=mysqli_fetch_array($result))
	
 echo '<p>'.$row['date'].' - '.$row['action'].'</p></pre>';
 ?>
</div>


<html>
<footer class="main-footer">
    </footer>
</html>
<?php
}
?>