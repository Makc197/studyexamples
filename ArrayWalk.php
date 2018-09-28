<?php

$arr1 = [
    1=>[1,2,3,4,5,6,7],
    2=>[8,9,10,11]
];

$arr2=[];

array_walk ( $arr1 , function ($el1, $arkey) use (&$arr2)  {
    array_walk ( $el1, function ($el2, $key) use (&$arr2) {
        array_push($arr2, $el2);
    });
});


var_dump($arr2);