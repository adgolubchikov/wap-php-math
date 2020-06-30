<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/xhtml+xml; charset=utf-8" />
<title>Конвертер</title>
</head>
<body>
<p align="center">
<a href="/">На главную</a><br/>
<a href="convert.html">Посчитать еще</a><br/>
<?php
require 'core.php';

$num=$_GET['num'];
$from=(integer)$_GET['from'];
$to=(integer)$_GET['to'];

echo $num.'<sub>'.$from.'</sub> = '.base_convert_float($num,$from,$to).'<sub>'.$to.'</sub>';
?>
</p>
</body>
</html>