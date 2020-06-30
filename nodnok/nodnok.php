<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/xhtml+xml; charset=utf-8" />
<title>НОД и НОК</title>
</head>
<body>
<p align="center">
<a href="/">На главную</a><br/>
<?php
$a=(integer)$_GET['a'];
$b=(integer)$_GET['b'];
echo 'НОК('.$a.','.$b.')='.nok($a,$b).'<br/>НОД('.$a.','.$b.')='.nod($a,$b);
function nod($a,$b)
{
$w;
while ($b != 0) {
$w = $a % $b;
$a = $b;
$b = $w;
}
return $a;
}
function nok($a,$b)
{
$nod=nod($a,$b);
return ($a * $b) / $nod;
}
?>
</p>
</form>
</body>
</html>