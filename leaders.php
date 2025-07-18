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
<div class="boxtitle">Список людей во фракции</div></td><p>
<?php
require_once("includes/logs.php");
$factions = array(
    1 => 'Families',
    2 => 'Ballas',
    3 => 'Vagos',
    4 => 'Marabunta',
    5 => 'Bloods',
    6 => 'Government',
    7 => 'LSPD',
    8 => 'EMS',
    9 => 'FBI',
    11 => 'RM',
    12 => 'MM',
    13 => 'LCN',
    14 => 'SANG',
    15 => 'WN',
    18 => 'SHERIFF'
);

echo '
<table width="100%">
<tr>
<td><b>StaticID</b></td>
<td><b>NickName</b></td>
<td><b>Фракция</b></td>
<td><b>Ранг</b></td>
</tr>';

$result = mysqli_query($con, "SELECT * FROM fracranks");

// берем результаты из каждой строки
while ($row = mysqli_fetch_array($result)) {
    $faction_id = $row['id'];
    $faction_name = isset($factions[$faction_id]) ? $factions[$faction_id] : 'Unknown';

    echo '<tr>
    <td>' . $row['uuid'] . '</td>
    <td>' . $row['name'] . '</td>
    <td>' . $faction_name . '</td>
    <td>' . $row['rank'] . '</td>
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
}
?>