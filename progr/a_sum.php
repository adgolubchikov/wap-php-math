<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/xhtml+xml; charset=utf-8" />
<title>Сумма N членов арифметической прогрессии</title>
</head>
<body>
<p align="center">
<a href="/">На главную</a><br/>
<a href="/progr/">В прогрессии</a><br/>
<a href="/progr/a_sum.html">Посчитать еще</a><br/>
<?php
echo (2*$_POST['a1']+$_POST['d']*($_POST['n']-1))*$_POST['n']/2;
?>
</p>
</body>
</html>