<?php
require 'lib.php';

$xmin=(float)$_GET['xmin'];
$xmax=(float)$_GET['xmax'];
if ($xmin>=$xmax) { $xmin=-5; $xmax=5; }

$ymin=(float)$_GET['ymin'];
$ymax=(float)$_GET['ymax'];
if ($ymin>=$ymax) { $ymin=-5; $ymax=5; }

$width=(integer)$_GET['width'];
if ($width<100 || $width>1000) $width=500;

$height=(integer)$_GET['height'];
if ($height<100 || $height>1000) $height=500;


$graph=@imagecreatetruecolor($width,$height);

$black=imagecolorallocate($graph, 0, 0, 0);
$white=imagecolorallocate($graph, 255, 255, 255);
$red=imagecolorallocate($graph, 255, 0, 0);
$blue=imagecolorallocate($graph, 0, 0, 255);
$orange=imagecolorallocate($graph, 210, 90, 0);
$green=imagecolorallocate($graph, 0, 128, 0);
$purple=imagecolorallocate($graph, 128, 0, 128);
$grey=imagecolorallocate($graph, 204, 204, 204);

if ($_GET['format']=='wbmp')
{
$red=$black;
$green=$black;
$blue=$black;
$orange=$black;
$purple=$black;
$grey=$black;
}

pre();

function color($inp)
{
global $graph;
global $black;
global $white;
global $red;
global $blue;
global $orange;
global $green;
global $purple;
global $grey;

switch($inp)
{
case 'red':
return $red;
break;
case 'black':
return $black;
break;
case 'white':
return $white;
break;
case 'blue':
return $blue;
break;
case 'orange':
return $orange;
break;
case 'green':
return $green;
break;
case 'purple':
return $purple;
break;
case 'grey':
return $grey;
break;
default:
return $red;
}
}

if (isset($_GET['f']))
{
for ($i=0;$i<count($_GET['f']);$i++)
{
if(!check($_GET['f'][$i])) exit('Неверно введена формула!');
yfromx($_GET['f'][$i],color($_GET['fcolor'][$i]));
}
}

if (isset($_GET['y']))
{
for ($i=0;$i<count($_GET['y']);$i++)
{
if(!check($_GET['y'][$i])) exit('Неверно введена формула!');
xfromy($_GET['y'][$i],color($_GET['ycolor'][$i]));
}
}

if (isset($_GET['pol']))
{
for ($i=0;$i<count($_GET['pol']);$i++)
{
if(!check($_GET['pol'][$i])) exit('Неверно введена формула!');
polar($_GET['pol'][$i],(float)$_GET['polmin'][$i],(float)$_GET['polmax'][$i],(float)$_GET['polstep'][$i],color($_GET['polcolor'][$i]));
}
}

if (isset($_GET['px']))
{
for ($i=0;$i<count($_GET['px']);$i++)
{
if(!check($_GET['px'][$i])) exit('Неверно введена формула!');
if(!check($_GET['py'][$i])) exit('Неверно введена формула!');
polar($_GET['px'][$i],$_GET['py'][$i],(float)$_GET['pmin'][$i],(float)$_GET['pmax'][$i],(float)$_GET['pstep'][$i],color($_GET['pcolor'][$i]));
}
}


if ($_GET['format']=='gif')
{
header('Content-type: image/gif');
imagegif($graph);
}
else
{
if ($_GET['format']=='jpeg')
{
header('Content-type: image/jpeg');
imagejpeg($graph);
}
else
{
if ($_GET['format']=='wbmp')
{
header('Content-type: image/vnd.wap.wbmp');
imagewbmp($graph);
}
else
{
header('Content-type: image/png');
imagepng($graph);
}
}
}
?>