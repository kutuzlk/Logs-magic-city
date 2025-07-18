<?php 
require_once("includes/logs.php");
?>
<div class="menu"><table width="100%"><tr><td><ul>
<a href=logsindex.php><li>Главная</li></a>

<a href=logsall.php><li>Все логи</li></a>
<a href=admin_logs.php><li>Админ действия</li></a>
<a href=admins.php><li>Админы</li></a>
<a href=leaders.php><li>Фракции</li></a>
<a href=logsdbtype2.php><li>Бизнесы</li></a>
 

<a href=logsdb.php><li>Поиск в бд сервера</li></a></script>
<a><ul><td valign="top" align="right"></td><td valign="top" align="right">
<a href rel=no><li><?php echo $_SESSION['session_username'];?></li></a>
<a href=logout.php><li>Выйти</li></a></td></tr></table></div>