<?php

define('MIN_NUM_BASE', 2);
define('MAX_NUM_BASE', 36);

function stepen($a, $b)
  {
  if ($b==0) return 1;
  $r=$a;
  for ($i=1; $i<abs($b); $i++)
    {
    $r*=$a;
    }
  if ($b>0) return $r; else return 1/$r;
  }

function stepen_float($a, $b)
  {
  if ($b<0) return 1/exp(log(abs($a))*abs($b));
  return exp(log(abs($a))*abs($b));
  }

function base_convert_float($num, $from, $to)
  {
  if (!strstr($num, '.')) return base_convert($num, $from, $to);
  $h=explode('.',strtoupper($num));
  $hl=strlen($h[1]);
  $dec=base_convert($h[1],$from,10)/stepen($from,$hl);
  
  $res_str='';
  for ($i=0; $i<8; $i++)
    {
    $dec*=$to;
    $res_str.=base_convert(floor($dec),10,$to);
    $dec-=floor($dec);
    }
  $pre = base_convert($h[0],$from,$to).'.'.$res_str;
  for ($i=0;$i<strlen($pre);$i++)
  {
  if (substr($pre,strlen($pre)-1,1)=='0') { $pre=substr($pre,0,strlen($pre)-1); }
  }
  return $pre;
  }
function tonum($inp)
  {
  switch ($inp)
    {
    case '0':
    return 0;
    break; 
    case '1':
    return 1;
    break; 
    case '2':
    return 2;
    break; 
    case '3':
    return 3;
    break; 
    case '4':
    return 4;
    break; 
    case '5':
    return 5;
    break; 
    case '6':
    return 6;
    break; 
    case '7':
    return 7;
    break; 
    case '8':
    return 8;
    break; 
    case '9':
    return 9;
    break; 
    case 'A':
    case 'a':
    return 10;
    break; 
    case 'B':
    case 'b':
    return 11;
    break; 
    case 'C':
    case 'c':
    return 12;
    break; 
    case 'D':
    case 'd':
    return 13;
    break; 
    case 'E':
    case 'e':
    return 14;
    break; 
    case 'F':
    case 'f':
    return 15;
    break; 
    case 'G':
    case 'g':
    return 16;
    break; 
    case 'H':
    case 'h':
    return 17;
    break; 
    case 'I':
    case 'i':
    return 18;
    break; 
    case 'J':
    case 'j':
    return 19;
    break; 
    case 'K':
    case 'k':
    return 20;
    break; 
    case 'L':
    case 'l':
    return 21;
    break; 
    case 'M':
    case 'm':
    return 22;
    break; 
    case 'N':
    case 'n':
    return 23;
    break; 
    case 'O':
    case 'o':
    return 24;
    break; 
    case 'P':
    case 'p':
    return 25;
    break; 
    case 'Q':
    case 'q':
    return 26;
    break; 
    case 'R':
    case 'r':
    return 27;
    break; 
    case 'S':
    case 's':
    return 28;
    break; 
    case 'T':
    case 't':
    return 29;
    break; 
    case 'U':
    case 'u':
    return 30;
    break; 
    case 'V':
    case 'v':
    return 31;
    break; 
    case 'W':
    case 'w':
    return 32;
    break; 
    case 'X':
    case 'x':
    return 33;
    break; 
    case 'Y':
    case 'y':
    return 34;
    break; 
    case 'Z':
    case 'z':
    return 35;
    default:
	return 99;
	}
  }
  
function tosym($inp)
  {
  switch ($inp)
    {
    case 0:
    return '0';
    break; 
    case 1:
    return '1';
    break; 
    case 2:
    return '2';
    break; 
    case 3:
    return '3';
    break; 
    case 4:
    return '4';
    break; 
    case 5:
    return '5';
    break; 
    case 6:
    return '6';
    break; 
    case 7:
    return '7';
    break; 
    case 8:
    return '8';
    break; 
    case 9:
    return '9';
    break; 
    case 10:
    return 'a';
    break; 
    case 11:
    return 'b';
    break; 
    case 12:
    return 'c';
    break; 
    case 13:
    return 'd';
    break; 
    case 14:
    return 'e';
    break; 
    case 15:
    return 'f';
    break; 
    case 16:
    return 'g';
    break; 
    case 17:
    return 'h';
    break; 
    case 18:
    return 'i';
    break; 
    case 19:
    return 'j';
    break; 
    case 20:
    return 'k';
    break; 
    case 21:
    return 'l';
    break; 
    case 22:
    return 'm';
    break; 
    case 23:
    return 'n';
    break; 
    case 24:
    return 'o';
    break; 
    case 25:
    return 'p';
    break; 
    case 26:
    return 'q';
    break; 
    case 27:
    return 'r';
    break; 
    case 28:
    return 's';
    break; 
    case 29:
    return 't';
    break; 
    case 30:
    return 'u';
    break; 
    case 31:
    return 'v';
    break; 
    case 32:
    return 'w';
    break; 
    case 33:
    return 'x';
    break; 
    case 34:
    return 'y';
    break; 
    case 35:
    return 'z';
    default:
	return '.';
	}
  }
function checkbase($num, $base)
  {
  $dec_ar=preg_split('//', $num, -1, PREG_SPLIT_NO_EMPTY);
  for ($i=0; $i<count($dec_ar); $i++)
    {
	if (tonum($dec_ar[$i])>=$base) return false;
	}
  return true;
  }

function plus($a, $sys_a, $b, $sys_b, $sys_result)
  {
  $a10=base_convert_float($a, $sys_a, 10);
  $b10=base_convert_float($b, $sys_b, 10);
  $res=$a10+$b10;
  
  return base_convert_float($res, 10, $sys_result);
  }

function minus($a, $sys_a, $b, $sys_b, $sys_result)
  {
  $a10=base_convert_float($a, $sys_a, 10);
  $b10=base_convert_float($b, $sys_b, 10);
  $res=$a10-$b10;
  
  return base_convert_float($res, 10, $sys_result);
  }

function umn($a, $sys_a, $b, $sys_b, $sys_result)
  {
  $a10=base_convert_float($a, $sys_a, 10);
  $b10=base_convert_float($b, $sys_b, 10);
  $res=$a10*$b10;
  
  return base_convert_float($res, 10, $sys_result);
  }

function del($a, $sys_a, $b, $sys_b, $sys_result)
  {
  $a10=base_convert_float($a, $sys_a, 10);
  $b10=base_convert_float($b, $sys_b, 10);
  $res=$a10/$b10;
  
  return base_convert_float($res, 10, $sys_result);
  }

?>