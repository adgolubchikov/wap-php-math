<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/xhtml+xml; charset=utf-8" />
<title>Сумма членов геометрической прогрессии с N-ного по M-ный</title>
</head>
<body>
<p align="center">
<a href="/">На главную</a><br/>
<a href="/progr/">В прогрессии</a><br/>
<a href="/progr/g_ntom.html">Посчитать еще</a><br/>
<?php
echo ($_POST['b1']*(1-pow($_POST['q'],$_POST['m'])))/(1-$_POST['q'])-($_POST['b1']*(1-pow($_POST['q'],$_POST['n'])))/(1-$_POST['q']);
?>
</p>
</body>
</html>