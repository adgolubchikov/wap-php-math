<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/xhtml+xml; charset=utf-8" />
<title>Квадратные уравнения</title>
</head>
<body>
<p align="center">
<a href="/">На главную</a><br/>
<?php
$errormessage='Вы должны задать все три коэффициента в формате ax^2(+/-)bx(+/-)c=p,<br/>где a, b, c и p - некоторые числа, а (+/-) - один из следующих знаков: + или -.<br/>Если один из коэффициентов a или b равен 1 или -1, то это число можно не указывать, а писать так: 2x^2+x-2=6.<br/>Если один из коэффициентов равен 0, то следует писать так: x^2+0x-2=0';
$htmlend='
<br/><br/><a href="index.html">Вернуться назад</a>
</p> 
</body>
</html>';

//(1+sin(9t))(1+sin(t))(1+0.03sin(45t))(1+0.04sin(297t))

if (!isset($_POST['eq'])) { exit ($errormessage.$htmlend); }
$eq=$_POST['eq'];
$eq=str_replace(' ','',$eq);
$eq=str_replace('+','%+',$eq);
$eq=str_replace('-','%-',$eq);
$eq=str_replace('=','%=',$eq);

$coefs=explode('%',$eq);

if (isset($coefs[3]))
{
$a=$coefs[0];
$a=substr($a,0,strlen($a)-3);
if ($a=='') { $a=1;} else {$a=(float)$a;}

$b=$coefs[1];
$b=substr($b,0,strlen($b)-1);
if ($b=='') { $b=1;}
if (substr($b,0,1)=='+') {$b=substr($b,1,strlen($b)-1); $b=(float)$b; } else { $b=(float)$b; }

$c=$coefs[2];
if ($c=='') { $c=1;}
if (substr($c,0,1)=='+') {$c=substr($c,1,strlen($c)-1); $c=(float)$c; } else { $c=(float)$c; }

$m=$coefs[3];
$m=(float)substr($m,1,strlen($m));
}
else
{
exit ($errormessage.$htmlend);
}

$c=$c-$m;

$entered_eq=str_replace('^2','<sup>2</sup>',$_POST['eq']);
$entered_eq=str_replace(' ','',$entered_eq);

$generated_eq='';
if ($a==1) {$generated_eq.='';}
else
{
if ($a>0) {$generated_eq.=$a; }
if ($a<0) {$generated_eq.=$a; }
}

$generated_eq.='x<sup>2</sup>';

if ($b==1) {$generated_eq.='+x';}
else
{
if ($b>0) {$generated_eq.='+'.$b.'x'; }
if ($b<0) {$generated_eq.=$b.'x'; }
}

//$generated_eq.='x';

if ($c==1) {$generated_eq.='';}
else
{
if ($c>0) {$generated_eq.='+'.$c; }
if ($c<0) {$generated_eq.=$c; }
}

$generated_eq.='=0';

if ($generated_eq==$entered_eq)
{
echo 'Вы ввели уравнение: '.$entered_eq.'<br/>';
}
else
{
echo 'Вы ввели уравнение: '.$entered_eq.'<br/>';
echo 'После преобразования: '.$generated_eq.'<br/>';
}

echo '<br/><br/>';
echo '<b>Решение через дискриминант ("по первой формуле"):</b><br/>';
echo 'Коэффициенты уравнения: a = '.$a.'; b = '.$b.', c = '.$c.'.<br/>';
$d=$b*$b-4*$a*$c;
echo 'D = b<sup>2</sup>-4ac = '.$d.'<br/>';
if ($d>0)
{
echo 'Т. к. D>0, то уравнение имеет 2 различных действительных корня:<br/>';
$x1=(-$b+sqrt($d))/(2*$a);
$x2=(-$b-sqrt($d))/(2*$a);
echo 'X<sub>1</sub> = (-b+sqrt(D))/2a = '.$x1.'<br/>';
echo 'X<sub>2</sub> = (-b-sqrt(D))/2a = '.$x2.'<br/>';
echo '<b>Ответ:</b> X<sub>1</sub> = '.$x1.'; X<sub>2</sub> = '.$x2.'.<br/>';
}

if ($d==0)
{
echo 'Т. к. D=0, то уравнение имеет 1 действительный корень:<br/>';
$x1=(-$b+sqrt($d))/(2*$a);
$x2=(-$b-sqrt($d))/(2*$a);
echo 'X = (-b)/2a = '.$x1.'<br/>';
echo '<b>Ответ:</b> X = '.$x1.'.<br/>';
}

if ($d<0)
{
echo 'Т. к. D<0, то уравнение не имеет действительных корней:<br/>';
$x1=2.5;
$x2=2.5;
echo '<b>Ответ:</b>Корней нет.<br/>';
}

if (round($b/2)==$b/2)
{
$k=$b/2;
echo '<br/><br/>';
echo '<b>Решение через четверть дискриминанта ("по второй формуле"):</b><br/>';
echo 'Коэффициенты уравнения: a = '.$a.'; b = '.$b.', c = '.$c.'; k = '.$k.'.<br/>';
$d=$k*$k-$a*$c;
echo 'D<sub>1</sub> = D/4 = k<sup>2</sup>-ac = '.$d.'<br/>';
if ($d>0)
{
echo 'Т. к. D<sub>1</sub>>0, то уравнение имеет 2 различных действительных корня:<br/>';
$x1=(-$k+sqrt($d))/($a);
$x2=(-$k-sqrt($d))/($a);
echo 'X<sub>1</sub> = (-k+sqrt(D<sub>1</sub>))/a = '.$x1.'<br/>';
echo 'X<sub>2</sub> = (-k-sqrt(D<sub>1</sub>))/a = '.$x2.'<br/>';
echo '<b>Ответ:</b> X<sub>1</sub> = '.$x1.'; X<sub>2</sub> = '.$x2.'.<br/>';
}

if ($d==0)
{
echo 'Т. к. D<sub>1</sub>=0, то уравнение имеет 1 действительный корень:<br/>';
$x1=(-$k+sqrt($d))/($a);
$x2=(-$k-sqrt($d))/($a);
echo 'X = (-k)/a = '.$x1.'<br/>';
echo '<b>Ответ:</b> X = '.$x1.'.<br/>';
}

if ($d<0)
{
echo 'Т. к. D<sub>1</sub><0, то уравнение не имеет действительных корней:<br/>';
$x1=2.5;
$x2=2.5;
echo '<b>Ответ:</b>Корней нет.<br/>';
}
}

if ($a==1 && round($x1)==$x1 && round($x2)==$x2)
{
echo '<br/><br/>';
echo '<b>Решение через теорему Виета:</b><br/>';
echo 'Коэффициенты уравнения: a = '.$a.'; b = '.$b.', c = '.$c.'.<br/>';
echo 'X<sub>1</sub>+X<sub>2</sub> = -b<br/>';
echo 'X<sub>1</sub>*X<sub>2</sub> = c<br/>';

echo 'X<sub>1</sub>+X<sub>2</sub> = '.(-1*$b).'<br/>';
echo 'X<sub>1</sub>*X<sub>2</sub> = '.$c.'<br/>';

echo 'Путем подбора устанавливаем, что X<sub>1</sub> = '.$x1.' и X<sub>2</sub> = '.$x2.'.<br/>';

echo '<b>Ответ:</b> X<sub>1</sub> = '.$x1.'; X<sub>2</sub> = '.$x2.'.<br/>';
}



echo $htmlend;

?>
