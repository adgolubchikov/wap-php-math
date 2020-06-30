<?php

$inp_width=(integer)$_GET['width']; if ($inp_width<100 || $inp_width>1000) $inp_width=500;
$inp_height=(integer)$_GET['height']; if ($inp_height<100 || $inp_height>1000) $inp_height=500;
$inp_xmin=(float)$_GET['xmin'];
$inp_xmax=(float)$_GET['xmax'];
$inp_ymin=(float)$_GET['ymin'];
$inp_ymax=(float)$_GET['ymax'];
$inp_zmin=(float)$_GET['zmin'];
$inp_zmax=(float)$_GET['zmax'];
$inp_steps=(integer)$_GET['steps']; if ($inp_steps<5 || $inp_steps>50) $inp_steps=20;
error_reporting(E_ALL);

$width=$inp_width;
$height=$inp_height;
$canvas=imagecreatetruecolor($width,$height);
$white=imagecolorallocate($canvas,255,255,255);
$black=imagecolorallocate($canvas,0,0,0);
$red=imagecolorallocate($canvas,255,0,0);
$green=imagecolorallocate($canvas,0,255,0);
$blue=imagecolorallocate($canvas,0,0,255);
if ($_GET['format']=='wbmp')
{
$red=$black;
$green=$black;
$blue=$black;
}
imagefill($canvas,0,0,$white);

$jxmin=$inp_xmin;$jxmax=$inp_xmax;$jymin=$inp_ymin;$jymax=$inp_ymax;$jzmin=$inp_zmin;$jzmax=$inp_zmax;$jxsteps=$inp_steps;$jysteps=$inp_steps;

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

$xmin=-3;
$xmax=3;
$ymin=-3*$height/$width;
$ymax=3*$height/$width;
$dragging=false;
$dragx=null;$dragy=null;
$dobj=null;
$oxmin=null;$oxmax=null;$oymin=null;$oymax=null;
$currenttool=0;
$resizerect=null;
$oloc=null;$oori=null;$oorio=null;$loc=Array();

$q=null;

$swidth=$width;
$sheight=$height;

if (!check($_GET['f'])) exit ('Неверно введена формула!');
$ez0=parse($_GET['f']);

$txmin;
$txmax;
$tymin;
$tymax;
$txsteps;
$tysteps;
$gridlines=1;
$s;$x;$y;$sx;$sy;$lsx;$lsy;$asx;$asy;
$sxpoints = Array();
$sypoints = Array();

function resetzoom()
{
global $txmin;
global $jxmin;
global $txmax;
global $jxmax;
global $tymin;
global $jymin;
global $tymax;
global $jymax;
global $txsteps;
global $jxsteps;
global $tysteps;
global $jysteps;

$txmin=$jxmin;$txmax=$jxmax;
$tymin=$jymin;$tymax=$jymax;
$txsteps=$jxsteps;
$tysteps=$jysteps;
setcameralocation(Array(1,2,1,-10));
setcameraorientation(Array(0,0,1));

do3d(1);
}

function do3d($recalc)
{
  if($recalc) { build3d(); }
  draw3daxes();
  draw3drender();
}

function draw3daxes() {
global $canvas;
global $red;
global $green;
global $blue;

 $sorigin=getscreencoords(getprojection(Array(0,0,0)));
 $sxvector=getscreencoords(getprojection(Array(3,0,0)));
 $syvector=getscreencoords(getprojection(Array(0,3,0)));
 $szvector=getscreencoords(getprojection(Array(0,0,3)));
 imageline($canvas,$sorigin[0],$sorigin[1],$sxvector[0],$sxvector[1],$red);
 imagestring($canvas,2,$sxvector[0],$sxvector[1],'x',$red);
 imageline($canvas,$sorigin[0],$sorigin[1],$syvector[0],$syvector[1],$green);
 imagestring($canvas,2,$syvector[0],$syvector[1],'y',$green);
 imageline($canvas,$sorigin[0],$sorigin[1],$szvector[0],$szvector[1],$blue);
 imagestring($canvas,2,$szvector[0],$szvector[1],'z',$blue);
}

function getscreencoords($p) {
global $xmin; global $xmax; global $ymin; global $ymax; global $height; global $width;
  $sx=floor(($p[0]-$xmin)/($xmax-$xmin)*$width);
  $sy=floor((1-($p[1]-$ymin)/($ymax-$ymin))*$height);
  return Array($sx,$sy);
}
function draw3drender() {
global $jxsteps;
global $jysteps;
global $xpoints;
global $ypoints;
global $zpoints;
  $s=null;$ls=null;$xi=null;$yi=null;
  $xp;$yp;
  for($xi=0;$xi<$jxsteps;$xi++) {
  $ls=null;
  $xp=Array();
  $yp=Array();
  for($yi=0;$yi<$jysteps;$yi++) {
    if(isset($zpoints[$xi+$jxsteps*$yi]) && !is_nan($zpoints[$xi+$jxsteps*$yi]) && is_finite($zpoints[$xi+$jxsteps*$yi])) 
	{
      $s=getscreencoords(getprojection(Array($xpoints[$xi+$jxsteps*$yi],$ypoints[$xi+$jxsteps*$yi],$zpoints[$xi+$jxsteps*$yi])));
    } else {
      $s=null;
    }
    if($s) { $xp[]=$s[0]; $yp[]=$s[1]; }
    $ls=$s;
  }
  polyline($xp,$yp);
  }
  for($xi=0;$xi<$jxsteps;$xi++) {
  $ls=null;
  $xp=Array();
  $yp=Array();
  for($yi=0;$yi<$jysteps;$yi++) {
    if(isset($zpoints[$yi+$jysteps*$xi]) && !is_nan($zpoints[$yi+$jysteps*$xi]) && is_finite($zpoints[$yi+$jysteps*$xi])) {
      $s=getscreencoords(getprojection(Array($xpoints[$yi+$jysteps*$xi],$ypoints[$yi+$jysteps*$xi],$zpoints[$yi+$jysteps*$xi])));
    } else {
      $s=null;
    }
    if($s) { $xp[]=$s[0]; $yp[]=$s[1]; }
    $ls=$s;
  }
  polyline($xp,$yp);
  }
}

$xpoints=Array();
$ypoints=Array();
$zpoints=Array();

function build3d() {
global $xpoints;
global $ypoints;
global $zpoints;

global $jxsteps;
global $jysteps;
global $jxmin;
global $jxmax;
global $jymin;
global $jymax;
global $jzmin;
global $jzmax;
global $ez0;
$z=null;
  $incr=0;$xi;$yi;
  $xpoints=Array();
  $ypoints=Array();
  $zpoints=Array();
  for($xi=0;$xi<$jxsteps;$xi++) {
  for($yi=0;$yi<$jysteps;$yi++) {
    $x=$jxmin+$xi*($jxmax-$jxmin)/($jxsteps-1);
    $y=$jymin+$yi*($jymax-$jymin)/($jysteps-1);
    eval('$z='.$ez0.';');
    $xpoints[]=(3*($x-$jxmin)/($jxmax-$jxmin));
    $ypoints[]=(3*($y-$jymin)/($jymax-$jymin));
    $zpoints[]=(3*($z-$jzmin)/($jzmax-$jzmin));
  }
  }
}





function setcameralocation($abcdv) {
global $pa;
global $pb;
global $pc;
global $pd;
global $hx;
global $hy;
global $hz;
global $hp;

$pa=$abcdv[0];
$pb=$abcdv[1];
$pc=$abcdv[2];
$pd=$abcdv[3];

$hx=$pa/sqrt($pa*$pa+$pb*$pb+$pc*$pc);
$hy=$pb/sqrt($pa*$pa+$pb*$pb+$pc*$pc);
$hz=$pc/sqrt($pa*$pa+$pb*$pb+$pc*$pc);
$hp=$pd/sqrt($pa*$pa+$pb*$pb+$pc*$pc);
}


function setcameraorientation($v)
{
global $cxx;
global $cxy;
global $cxz;
global $po;
global $cyx;
global $cyy;
global $cyz;
global $hx;
global $hy;
global $hz;

$icyx=-$v[0];
$icyy=-$v[1];
$icyz=-$v[2];

$cxx=$icyy*$hz-$icyz*$hy;
$cxy=$icyz*$hx-$icyx*$hz;
$cxz=$icyx*$hy-$icyy*$hx;

$cxn=sqrt($cxx*$cxx+$cxy*$cxy+$cxz*$cxz);
$cxx=$cxx/$cxn;
$cxy=$cxy/$cxn;
$cxz=$cxz/$cxn;
$cyx=$cxy*$hz-$cxz*$hy;
$cyy=$cxz*$hx-$cxx*$hz;
$cyz=$cxx*$hy-$cxy*$hx;

$po=getsmack(Array(0,0,0));
}

function getsmack($qv)
{
global $pa;
global $pb;
global $pc;
global $pd;
global $hx;
global $hy;
global $hz;

$u=($pa*$qv[0]+$pb*$qv[1]+$pc*$qv[2]+$pd)/($pa*$hx+$pb*$hy+$pc*$hz);
$ix=$qv[0]-$u*$hx;
$iy=$qv[1]-$u*$hy;
$iz=$qv[2]-$u*$hz;
return Array($ix,$iy,$iz);
}

function getprojection($qv)
{
global $pa;
global $pb;
global $pc;
global $pd;
global $hx;
global $hy;
global $hz;
global $cxx;
global $cxy;
global $cxz;
global $po;
global $cyx;
global $cyy;
global $cyz;

$u=($pa*$qv[0]+$pb*$qv[1]+$pc*$qv[2]+$pd)/($pa*$hx+$pb*$hy+$pc*$hz);
$ix=$qv[0]-$u*$hx-$po[0];
$iy=$qv[1]-$u*$hy-$po[1];
$iz=$qv[2]-$u*$hz-$po[2];
$projx=-($ix*$cxx+$iy*$cxy+$iz*$cxz);
$projy=$ix*$cyx+$iy*$cyy+$iz*$cyz;
return Array($projx,$projy);
}

function polyline($xpoints,$ypoints)
{
global $canvas;
global $black;

$points="";
for($i=0;$i<count($xpoints);$i++) {
if ($i!=0)
{
imageline($canvas,$xpoints[$i-1],$ypoints[$i-1],$xpoints[$i],$ypoints[$i],$black);
}
}
}

$pa;$pb;$pc;$pd;$hx;$hy;$hz;$hp;
$cxx;$cxy;$cxz;$po;$cyx;$cyy;$cyz;

resetzoom();
do3d(1);

if ($_GET['format']=='gif')
{
header('Content-type: image/gif');
imagegif($canvas);
}
else
{
if ($_GET['format']=='jpeg')
{
header('Content-type: image/jpeg');
imagejpeg($canvas);
}
else
{
if ($_GET['format']=='wbmp')
{
header('Content-type: image/vnd.wap.wbmp');
imagewbmp($canvas);
}
else
{
header('Content-type: image/png');
imagepng($canvas);
}
}
}
?>
