<?php
$width=500;
$height=500;
$xmin=-5;
$xmax=5;
$ymin=-5;
$ymax=5;
$legend_y=25;

function check($str)
{
$valid=Array('sin','cos','tan','cot','sec','csc',
             'asin','acos','atan','acot','asec','acsc',
			 
			 'sinh','cosh','tanh','coth','sech','csch',
             'asinh','acosh','atanh','acoth','asech','acsch',
			 
			 'tg','ctg','cosec','atg','actg','acosec',
			 'arcsin','arccos','arctan','arccot','arcsec','arccsc',
             'arcsinh','arccosh','arctanh','arccoth','arcsech','arccsch',
			 'arctg','arcctg','arccosec',
			 
			 'sqrt','cbrt','root',
			 
			 '+','-','*','/','^','(',')','[',']','{','}','.',',',
			 
			 '1','2','3','4','5','6','7','8','9','0',
			 
			 'log','lg','ln','lb','sign',
			 'ceil','floor','round',
			 ' ',
			 'x','y','t');

for ($i=0; $i<count($valid); $i++)
  {
  $str=str_replace($valid[$i],'',$str);
  }

if ($str=='')
  {
  return true;
  }
else
  {
  return false;
  }
}

function parse($f)
{
$f=str_replace('[','int_part(',$f);
$f=str_replace(']',')',$f);
$f=str_replace('{','float_part(',$f);
$f=str_replace('}',')',$f);

$f=str_replace('ctg','cot',$f);
$f=str_replace('tg','tan',$f);
$f=str_replace('cosec','csc',$f);
$f=str_replace('arc','a',$f);

$f=preg_replace('/([0-9a-z\.]+)\^([0-9a-z\.]+)/',"pow($1,$2)",$f);
$f=preg_replace('/([0-9a-z\.]+)\^([\(]+)([0-9a-z\.\-\+\*\/]+)([\)]+)/',"pow($1,$3)",$f);
$f=preg_replace('/([\(]+)([0-9a-z\.\-\+\*\/]+)([\)]+)\^([0-9a-z\.]+)/',"pow($2,$4)",$f);
$f=preg_replace('/([\(]+)([0-9a-z\.\-\+\*\/]+)([\)]+)\^([\(]+)([0-9a-z\.\-\+\*\/]+)([\)]+)/',"pow($2,$5)",$f);

$f=preg_replace('/([\d\)])([\$\(a-z])/',"$1*$2",$f);

$f=str_replace('x','$x',$f);
$f=str_replace('y','$y',$f);
$f=str_replace('t','$t',$f);

$f=str_replace('sqr$t','sqrt',$f);
$f=str_replace('cbr$t','cbrt',$f);
$f=str_replace('roo$t','root',$f);
$f=str_replace('co$t','cot',$f);
$f=str_replace('aco$t','acot',$f);
$f=str_replace('cot$th','coth',$f);
$f=str_replace('acot$th','acoth',$f);


$f.=';';

return $f;
}

function int_part($a) { return floor($a); }
function floatpart($a) { return $a-floor($a); }

function sec($x) { return 1/cos($x); }
function csc($x) { return 1/sin($x); }
function cot($x) { return 1/tan($x); }
function asec($x) { return acos(1/$x); }
function acsc($x) { return asin(1/$x); }
function acot($x) { return atan(1/$x); }
function ln($x) { return log($x,M_E); }
function lg($x) { return log($x,10); }
function lb($x) { return log($x,2); }


function sech($x) { return 2/(exp($x)+exp(-$x)); }
function csch($x) { return 2/(exp($x)-exp(-$x)); }
function coth($x) { return (exp($x)+exp(-$x))/(exp($x)-exp(-$x)); }
function asech($x) { return log(1/$x+sqrt(1/$x/$x-1)); }
function acsch($x) { return log(1/$x+sqrt(1/$x/$x+1)); }
function acoth($x) { return 0.5*log((1+$x)/(1-$x)); }


function sign($a) { if ($a>0) { return 1; } else { if ($a<0) { return -1; } else { return 0; } }}


function cbrt($a)
{
if ($a>0)
  {
  return pow($a,1/3);
  }
else
  {
  if ($a<0)
    {
    return -pow(-$a,1/3);
    }
  else
    {
    return 0;
    }
  }
}

function root($a,$base)
{
if ((round($base)==$base) && ($base>=1))
  {
  if ($base % 2 ==1)
    {
    if ($a>0)
      {
      return pow($a,1/$base);
      }
    else
    {
      if ($a<0)
        {
        return -pow(-$a,1/$base);
        }
      else
        {
        return 0;
        }
      }
    }
  else
    {
    if ($a>0)
      {
      return pow($a,1/$base);
      }
    else
      {
      if ($a<0)
        {
        return sqrt(-5);
        }
      else
        {
        return 0;
        }
      }
    }
  }
else
  {
  return sqrt(-5);
  }
}



function pre()
{
global $graph;
global $width;
global $height;
global $xmin; global $xmax;
global $ymin; global $ymax;
global $black; global $white; global $grey;
imagefill($graph,0,0,$white);

$powerx=log($xmax-$xmin,10);
$powery=log($ymax-$ymin,10);
if (($powerx-floor($powerx))<0.25) {$basex=pow(10,floor($powerx-1));} else { if (($powerx-floor($powerx))<0.5) {$basex=2*pow(10,floor($powerx-1));} else { if (($powerx-floor($powerx))<0.5) {$basex=5*pow(10,floor($powerx-1));} else {{$basex=pow(10,floor($powerx));}}}}
if (($powery-floor($powery))<0.25) {$basey=pow(10,floor($powery-1));} else { if (($powery-floor($powery))<0.5) {$basey=2*pow(10,floor($powery-1));} else { if (($powery-floor($powery))<0.5) {$basey=5*pow(10,floor($powery-1));} else {{$basey=pow(10,floor($powery));}}}}

$m=pow(10,-floor(log($basex,10)));
$n=pow(10,-floor($powery));

for ($unit_x=floor($xmin*$m)/$m+$basex;$unit_x<$xmax;$unit_x+=$basex)
  {
  $pixel_x=getpixel_x($unit_x);
  imageline($graph,$pixel_x,0,$pixel_x,$height,$grey);
  imagestring($graph,3,$pixel_x-5,10,$unit_x,$black);
  imagestring($graph,3,$pixel_x-5,$height-20,$unit_x,$black);
  }       

for ($unit_y=floor($ymin*$n)/$n+$basey;$unit_y<$ymax;$unit_y+=$basey)
{
$pixel_y=getpixel_y($unit_y);
imageline($graph, 0, $pixel_y, $width, $pixel_y, $grey);
imagestring($graph, 3, 10, $pixel_y-5, $unit_y, $black);
imagestring($graph, 3, $width-20-(8*floor($powery)), $pixel_y-5, $unit_y, $black);
}

imagerectangle($graph,0,0,$width-1,$height-1,$black);
imageline($graph,0,getpixel_y(0),$width,getpixel_y(0),$black);
imageline($graph,getpixel_x(0),0,getpixel_x(0),$height,$black);
}



function getpixel_x($unit)
{
global $xmin; global $xmax; global $width;
$pixel=($unit-$xmin)*$width/($xmax-$xmin);

return $pixel;
}



function getpixel_y($unit)
{
global $ymin; global $ymax; global $height;
$pixel=($ymax-$unit)*$height/($ymax-$ymin);

return $pixel;
}


function yfromx($f,$color)
{
global $legend_y;
global $graph;
global $xmin;
global $xmax;
global $ymin;
global $ymax;
global $width;
global $height;

$pf=parse($f);
imagefilledrectangle($graph,25,$legend_y,40,$legend_y+10,$color);

imagestring($graph, 3, 45,$legend_y, 'y='.$f, $color);

$legend_y += 15;

$x = $xmin;

@eval('$y='.$pf);

$xlast=$x;
$ylast=$y;
$xprelast=$xlast;
$yprelast=$ylast;

for($x = $xmin; $x <= $xmax; $x += ($xmax-$xmin)/$width)
{              
@eval('$y='.$pf);
if ( $x === NULL || $x === false || $y === NULL || $y === false || is_nan($y)) { continue; }
$pixel_x = getpixel_x($x);
$pixel_y = getpixel_y($y);

if ( $pixel_y < 0 || $pixel_y > $height || $pixel_x < 0 || $pixel_x > $width ) { continue; }

if (((!is_nan($y)) && (!is_nan($ylast)) && (!is_nan($yprelast))) && ((($ylast>=$y) && ($yprelast>=$ylast)) || (($ylast<=$y) && ($yprelast<=$ylast))))
{
imageline($graph,getpixel_x($xlast),getpixel_y($ylast),getpixel_x($x),getpixel_y($y),$color);
}
else
{
imagesetpixel($graph,$pixel_x,$pixel_y,$color);
}
$xprelast=$xlast;
$yprelast=$ylast;
$xlast=$x;
$ylast=$y;
}
}

function xfromy($f,$color)
{
global $legend_y;
global $graph;
global $xmin;
global $xmax;
global $ymin;
global $ymax;
global $width;
global $height;

$pf=parse($f);
imagefilledrectangle($graph,25,$legend_y,40,$legend_y+10,$color);

imagestring($graph, 3, 45,$legend_y, 'x='.$f, $color);

$legend_y += 15;

$y = $ymin;

eval('$x='.$pf);

$xlast=$x;
$ylast=$y;
$xprelast=$xlast;
$yprelast=$ylast;

for($y = $ymin; $y <= $ymax; $y += ($ymax-$ymin)/$height)
{              
eval('$x='.$pf);
if ( $x === NULL || $x === false || $y === NULL || $y === false || is_nan($x)) { continue; }
$pixel_x = getpixel_x($x);
$pixel_y = getpixel_y($y);

if ( $pixel_y < 0 || $pixel_y > $height || $pixel_x < 0 || $pixel_x > $width ) { continue; }

if (((!is_nan($x)) && (!is_nan($xlast)) && (!is_nan($xprelast))) && ((($xlast>=$x) && ($xprelast>=$xlast)) || (($xlast<=$x) && ($xprelast<=$xlast))))
{
imageline($graph,getpixel_x($xlast),getpixel_y($ylast),getpixel_x($x),getpixel_y($y),$color);
}
else
{
imagesetpixel($graph,$pixel_x,$pixel_y,$color);
}
$xprelast=$xlast;
$yprelast=$ylast;
$xlast=$x;
$ylast=$y;
}
}



function param($xt,$yt,$tmin,$tmax,$tstep,$color)
{
global $legend_y;
global $graph;
global $xmin;
global $xmax;
global $ymin;
global $ymax;
global $width;
global $height;

$pxt=parse($xt);
$pyt=parse($yt);
imagefilledrectangle($graph,25,$legend_y,40,$legend_y+10,$color);

imagestring($graph, 3, 45,$legend_y, 'x='.$xt.'; y='.$yt, $color);

$legend_y += 15;

eval('$x='.$pxt);
eval('$y='.$pyt);

$xlast=$x;
$ylast=$y;

for($t = $tmin; $t <= $tmax; $t += $tstep)
{
eval('$x='.$pxt);
eval('$y='.$pyt);
if ( $x === NULL || $x === false || $y === NULL || $y === false ) { continue; }
$pixel_x = getpixel_x($x);
$pixel_y = getpixel_y($y);

if ( $pixel_y < 0 || $pixel_y > $height || $pixel_x < 0 || $pixel_x > $width ) { continue; }

imageline($graph,getpixel_x($xlast),getpixel_y($ylast),getpixel_x($x),getpixel_y($y),$color);

$xlast=$x;
$ylast=$y;
}
}


function polar($f,$tmin,$tmax,$tstep,$color)
{
$xt=$f.'*cos(t)';
$yt=$f.'*sin(t)';
global $legend_y;
global $graph;
global $xmin;
global $xmax;
global $ymin;
global $ymax;
global $width;
global $height;

$pxt=parse($xt);
$pyt=parse($yt);
imagefilledrectangle($graph,25,$legend_y,40,$legend_y+10,$color);

imagestring($graph, 3, 45,$legend_y, 'r='.$f, $color);

$legend_y += 15;

eval('$x='.$pxt);
eval('$y='.$pyt);

$xlast=$x;
$ylast=$y;

for($t = $tmin; $t <= $tmax; $t += $tstep)
{
eval('$x='.$pxt);
eval('$y='.$pyt);
if ( $x === NULL || $x === false || $y === NULL || $y === false ) { continue; }
$pixel_x = getpixel_x($x);
$pixel_y = getpixel_y($y);

if ( $pixel_y < 0 || $pixel_y > $height || $pixel_x < 0 || $pixel_x > $width ) { continue; }

imageline($graph,getpixel_x($xlast),getpixel_y($ylast),getpixel_x($x),getpixel_y($y),$color);

$xlast=$x;
$ylast=$y;
}
}


?>
