<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/xhtml+xml; charset=utf-8" />
<title>Калькулятор</title>
</head>
<body>
<p align="center">
<a href="/">На главную</a><br/>
<a href="calc.html">Посчитать еще</a><br/>
<?php
require 'core.php';

$num1=$_GET['num1'];
$num2=$_GET['num2'];
$base1=$_GET['base1'];
$base2=$_GET['base2'];
$baser=$_GET['baser'];
$act=$_GET['act'];

if ($act=='plus')
{
echo $num1.'<sub>'.$base1.'</sub> + '.$num2.'<sub>'.$base2.'</sub> = '.plus($num1,$base1,$num2,$base2,$baser).'<sub>'.$baser.'</sub>';
}
if ($act=='minus')
{
echo $num1.'<sub>'.$base1.'</sub> - '.$num2.'<sub>'.$base2.'</sub> = '.minus($num1,$base1,$num2,$base2,$baser).'<sub>'.$baser.'</sub>';
}
if ($act=='umn')
{
echo $num1.'<sub>'.$base1.'</sub> * '.$num2.'<sub>'.$base2.'</sub> = '.umn($num1,$base1,$num2,$base2,$baser).'<sub>'.$baser.'</sub>';
}
if ($act=='del')
{
echo $num1.'<sub>'.$base1.'</sub> / '.$num2.'<sub>'.$base2.'</sub> = '.del($num1,$base1,$num2,$base2,$baser).'<sub>'.$baser.'</sub>';
}
?>
</p>
</body>
</html>