<?php
	session_start();
	unset($_SESSION['session_username']);
	session_destroy();
	?>

<?php require_once("includes/connection.php"); ?>
<script>setTimeout('location="/"', 2000)</script>
<html>
<head>
<meta charset="utf-8">
<title>name Logs</title>
<link href="assets/styles.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>
</head>

<body><div class="menu"><table width="100%"><tr><td valign="top" align="left"><script>


	</script>
	<a></a><ul><a></a>
	<a href="/"><li>Главная</li></a>

	<td valign="top" align="right"></td>
	<td valign="top" align="right">
	<a href="/login.php"><li>Войти</li></a></td></tr></tbody></table></div>
    
    <div class="right"><div id="content">
    <table width="100%" border="0">
  <tbody>
    <tr>
      <td class="top"><h1>Выход</h1></td>
    </tr>
    <tr>
      <td class="middel"><div class="box">
        <div id="login" class="boxtitle">Выход</div>
		<big>Вы успешно вышли!</big></p></pre>
		</div></td>
    </tr>
  </tbody>
</table>
</div></div></body>
</html>

