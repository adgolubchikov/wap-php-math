<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/xhtml+xml; charset=utf-8" />
<title>Интегралы</title>
</head>
<body>
<p align="center">
<a href="/">На главную</a><br/>
<?php
$f=$_GET['f'];
$a=$_GET['a'];
$b=$_GET['b'];

if (!check($f))
{
echo 'Неверно введена формула!';
}
else
{
echo 'Интеграл для '.$f.' на отрезке ['.$a.','.$b.'] = '.integral(parse($f),(float)$a,(float)$b);
}

function integral($f,$a,$b)
{
$r=0; $y=0;
$step=($b-$a)/10000;
for ($x=$a;$x<=$b;$x+=$step)
  {
  eval('$y='.$f);
  if (!is_nan($y)) $r+=($y*$step);
  }
return round($r*10000)/10000;
}


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
?>
</p>
</form>
</body>
</html>