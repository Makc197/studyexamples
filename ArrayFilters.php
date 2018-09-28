
<?php
$arr = [[],[]];
$arrayData = ["name", "contact", "product","retail_point_ids"];

$f = function($var) use (&$arr)
{
   if (preg_match('/(ids)/', $var)) {
       $arr[0][] = array_push($arr[0], $var);
   } else {
       $arr[1][] = array_push($arr[1], $var);
   }
};
array_filter($arrayData, $f);
echo '<pre>';
var_dump($arr);