<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/xhtml+xml; charset=utf-8" />
<title>Член арифметической прогрессии</title>
</head>
<body>
<p align="center">
<a href="/">На главную</a><br/>
<a href="/progr/">В прогрессии</a><br/>
<a href="/progr/a_num.html">Посчитать еще</a><br/>
<?php
echo $_POST['a1']+$_POST['d']*($_POST['n']-1);
?>
</p>
</body>
</html>