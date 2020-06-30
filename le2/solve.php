<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/xhtml+xml; charset=utf-8" />
<title>Система из 2 линейных уравнений</title>
</head>
<body>
<p align="center">
<a href="/">На главную</a><br/>
<a href="/le2/">Решить еще</a><br/>
<?php
function sys_ur_2($x1, $y1, $r1, $x2, $y2, $r2)
  {
  $x=($r1*$y2-$y1*$r2)/($x1*$y2-$y1*$x2);
  $y=($x1*$r2-$r1*$x2)/($x1*$y2-$y1*$x2);
  
  return 'X = '.$x.'; Y = '.$y.'.<br/>';
  }

echo sys_ur_2($_POST['x1'],$_POST['y1'],$_POST['r1'],$_POST['x2'],$_POST['y2'],$_POST['r2']);
?>
</p>
</body>
</html>