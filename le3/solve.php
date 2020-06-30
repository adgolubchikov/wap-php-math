<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/xhtml+xml; charset=utf-8" />
<title>Система из 3 линейных уравнений</title>
</head>
<body>
<p align="center">
<a href="/">На главную</a><br/>
<a href="/le3/">Решить еще</a><br/>
<?php
function sys_ur_3($x1, $y1, $z1, $r1, $x2, $y2, $z2, $r2, $x3, $y3, $z3, $r3)
  {
  $matrix[0] = array($x1, $y1, $z1);
  $matrix[1] = array($x2, $y2, $z2);
  $matrix[2] = array($x3, $y3, $z3);
  $b[0] = $r1;
  $b[1] = $r2;
  $b[2] = $r3;
  
  list($x, $y, $z) = sys_ur_3_solve($matrix, $b);
  
  return 'X = '.$x.'; Y = '.$y.'; Z = '.$z.'.<br/>';
  }

function sys_ur_3_solve($matrix, $b)
  {
  $determinant = sys_ur_3_determinant($matrix);
  for($i = 0; $i < 3; $i++)
    {
    $xd[$i] = $matrix[$i];
    $xd[$i][0] = $b[$i];
    $yd[$i] = $matrix[$i];
    $yd[$i][1] = $b[$i];
    $zd[$i] = $matrix[$i];
    $zd[$i][2] = $b[$i];
    }
  $x = sys_ur_3_determinant($xd) / $determinant;
  $y = sys_ur_3_determinant($yd) / $determinant;
  $z = sys_ur_3_determinant($zd) / $determinant;
  
  return array($x, $y, $z);
  }

function sys_ur_3_determinant($m)
  {
  return $m[0][0] * ($m[1][1] * $m[2][2] - $m[2][1] * $m[1][2]) - 
         $m[0][1] * ($m[1][0] * $m[2][2] - $m[2][0] * $m[1][2]) + 
         $m[0][2] * ($m[1][0] * $m[2][1] - $m[2][0] * $m[1][1]); 
  }

echo sys_ur_3($_POST['x1'],$_POST['y1'],$_POST['z1'],$_POST['r1'],$_POST['x2'],$_POST['y2'],$_POST['z2'],$_POST['r2'],$_POST['x3'],$_POST['y3'],$_POST['z3'],$_POST['r3']);

?>
</p>
</body>
</html>