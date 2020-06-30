<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/xhtml+xml; charset=utf-8" />
<title>Graph Mobile</title>
</head>
<body>
<p align="center">
<a href="/">На главную</a><br/>
</p>
<form action="graph.php">
<p align="center">
<?php
$p=(integer)$_GET['p'];
$f=(integer)$_GET['f'];
$y=(integer)$_GET['y'];
$pol=(integer)$_GET['pol'];
if (($f<0) || ($f>10))
{
echo '<p>Введено неверное число функций. Введите число от 0 до 10.</p>';
exit;
}
if (($y<0) || ($y>10))
{
echo '<p>Введено неверное число полярных функций. Введите число от 0 до 10.</p>';
exit;
}
if (($pol<0) || ($pol>10))
{
echo '<p>Введено неверное число полярных функций. Введите число от 0 до 10.</p>';
exit;
}
if (($p<0) || ($p>10))
{
echo '<p>Введено неверное число параметров. Введите число от 0 до 10.</p>';
exit;
}

echo 'Формат катринки: <select name="format">
<option value="gif" selected="selected">GIF</option>
<option value="jpeg">JPEG</option>
<option value="png">PNG</option>
<option value="wbmp">WBMP</option>
</select><br/>
Высота: <input type="text" name="height" value="500" /><br/>
Ширина: <input type="text" name="width" value="500" /><br/>
Xmin:<input type="text" name="xmin" value="-5" />
Xmax:<input type="text" name="xmax" value="5" /><br/>
Ymin:<input type="text" name="ymin" value="-5" />
Ymax:<input type="text" name="ymax" value="5" /><br/>';

for ($i=1;$i<=$f;$i++)
{
echo '<b>Функция y'.$i.'(x):</b><br/>
Цвет: 
<select name="fcolor[]">
<option value="red">Красный</option>
<option value="green">Зеленый</option>
<option value="blue">Синий</option>
<option value="white">Белый</option>
<option value="grey">Серый</option>
<option value="black">Черный</option>
<option value="purple">Фиолетовый</option>
<option value="orange">Оранжевый</option>
</select>
<br/>
f'.$i.'(x)=<input type="text" name="f[]" /><br/><br/>';
}

for ($i=1;$i<=$y;$i++)
{
echo '<b>Функция x'.$i.'(y):</b><br/>
Цвет: 
<select name="ycolor[]">
<option value="red">Красный</option>
<option value="green">Зеленый</option>
<option value="blue">Синий</option>
<option value="white">Белый</option>
<option value="grey">Серый</option>
<option value="black">Черный</option>
<option value="purple">Фиолетовый</option>
<option value="orange">Оранжевый</option>
</select>
<br/>
f'.$i.'(x)=<input type="text" name="y[]" /><br/><br/>';
}

for ($i=1;$i<=$pol;$i++)
{
echo '<b>Полярная функция '.$i.':</b><br/>
Цвет: 
<select name="polcolor[]">
<option value="red">Красный</option>
<option value="green">Зеленый</option>
<option value="blue">Синий</option>
<option value="white">Белый</option>
<option value="grey">Серый</option>
<option value="black">Черный</option>
<option value="purple">Фиолетовый</option>
<option value="orange">Оранжевый</option>
</select>
<br/>
r'.$i.'(t)=<input type="text" name="pol[]" /><br/>
t= от <input type="text" name="polmin[]" value="0" size="3" /> до <input type="text" name="polmax[]" value="10" size="3" /> с шагом <input type="text" value="0.01" name="polstep[]" size="3" /><br/><br/>';
}

for ($i=1;$i<=$p;$i++)
{
echo '<b>Параметр '.$i.':</b><br/>
Цвет: 
<select name="pcolor[]">
<option value="red">Красный</option>
<option value="green">Зеленый</option>
<option value="blue">Синий</option>
<option value="white">Белый</option>
<option value="grey">Серый</option>
<option value="black">Черный</option>
<option value="purple">Фиолетовый</option>
<option value="orange">Оранжевый</option>
</select>
<br/>
x'.$i.'(t)=<input type="text" name="px[]" /><br/>
y'.$i.'(t)=<input type="text" name="py[]" /><br/>
t= от <input type="text" name="pmin[]" value="0" size="3" /> до <input type="text" name="pmax[]" value="10" size="3" /> с шагом <input type="text" value="0.01" name="pstep[]" size="3" /><br/><br/>';
}
echo '<input type="submit" value="Построить" />';
?>
</p>
</form>
</body>
</html>