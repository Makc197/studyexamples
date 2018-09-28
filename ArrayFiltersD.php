<?php
$arr = [[],[]];
$arrayData = ["name", "contact", "product","retail_point_ids"];
$f = function($var) use (&$arr)
{
    $index = preg_match('/(ids)/', $var) ? 0: 1;
    $arr[$index][]=array_push($arr[$index], $var);
};
array_filter($arrayData, $f);
echo '<pre>';
var_dump($arr);
