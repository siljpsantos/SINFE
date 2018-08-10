<?php

//$timezone = -3;
//$timestamp = mktime(date("H")-2, date("i"), date("s"), date("m"), date("d"), date("Y"));

/*
  date_default_timezone_set('America/Sao_Paulo');
  $bool = date('I');

  if($bool){
  $timestamp = mktime(date("H")-2, date("i"), date("s"), date("m"), date("d"), date("Y"));
  echo gmdate("Y-m-d\TH:i:s", $timestamp);
  }else{
  $timestamp = mktime(date("H")-3, date("i"), date("s"), date("m"), date("d"), date("Y"));
  echo gmdate("Y-m-d\TH:i:s", $timestamp);
  }

  define('MPDF_PATH', '');
  include(MPDF_PATH.'ola.pdf');
  $mpdf=new mPDF();
  $mpdf->WriteHTML('ola');
  $mpdf->Output();
 */

$config['uppercase'] = true;

$lambda = function ($x){
    return $x*$x;
};

//$resultado = $lambda(5);
//echo $resultado;

$closure = function ($txt) use ($config){
    if(isset($config['uppercase']) && $config['uppercase'] == true) {
        $txt = strtoupper($txt);
    }
    return $txt;
};

//$resultado = $closure('silvio');
//echo $resultado;

// Using as a callback
function firstWord($message, $callback) {
    $parts = explode(' ', $message);
 
    return $callback($parts[0]);
}
 
$result_callback = firstWord('Hello World', $closure);
echo $result_callback;

//function fatorial($x){
//    return ($x) ? $x * fatorial($x - 1) : 1;
//}
//
//echo fatorial(5);
//
//echo ($x) ? "sim" : "nao";

?>

