<?php
//Генератор
function generate(){
	$array=[1,2,3,4,5,6,];
	foreach ($array as $val){
		yield $val;
	}
}

/*foreach (generate() as $num) {
	var_dump ($num);
}*/

//Механизм замыкания
function rangeCreator ($min=0, $max=1000) {
	//Область видимости 1
	$function = function($value) use ($min, $max) {
		//Область видимости 2
		return ($value >= $min && $value <= $max); //возвращает булево значение
	};	
	return $function;		
}

$foo1 = rangeCreator(1,6); //создаем функцию $foo1 
var_dump($foo1);

/*$res = $foo1(3); //Передаем созданной функции foo1 аргумент 3
var_dump($res);*/

$arrayData = [1,2,3,4,5,6,7,8,9];
$resultArrayMap = array_map($foo1, $arrayData);
$funcEl = function($el){
	return $el+1;
};
$resultArrayMap2 = array_map($funcEl, $arrayData); 
//Идентично строке выше - тело функции пишем как аргумент
$resultArrayMap2 = array_map(function($el){
	return $el+1;
}, $arrayData);

$resultArrayFilter = array_filter($arrayData, $foo1);

//var_dump($resultArrayMap);
//var_dump($resultArrayMap2);
//var_dump($resultArrayFilter);

//=============================================================================
//Механизм обратного вызова
function printWithTags($string, $callback1, $callback2){
	var_dump($string);
	// какие-то действия
	
	// .. .. 
	
	// обратный вызов
	if(strlen($string) < 5) $callback1($string); // tagP()
	else $callback2($string);

	return true;
}

$tagP = function($text){
	printf('<p style="color:red;">%s</p>', $text);
};

$tagB = function($text){
	printf('<b style="color:blue;">%s</b>', $text);
};

$tagDiv = function($text){
	printf('<div>%s</div>', $text);
};

//$res1 = printWithTags('Hello!', $tagP, $tagB);
//print($res);
//Прогоняем массив данных через массив функций как бы  через несколько фильтров - Перебираем функции обратного вызова - лежат в массиве $callbacks
function cust_array_filter($array, $callbacks){
	foreach($callbacks as $callback){
		$array = array_filter($array, $callback);
	}	
	return $array;
}

$arrayData = [-1, -29, 1,2,3,4,5,6,7,8,9,10];

$foo1 = rangeCreator(1,9); //создаем функцию $foo1 - отсеим от 1 до 6

//анонимная функция ?
function odd($var)
{
    // является ли переданное число нечетным
    return($var & 1);
}

//Первый элемент - массив данных, второй - массив функций - там функции обратного вызова лежат - в качестве элемента массива может быть функция, код тела функции, анонимная функция
$res = cust_array_filter($arrayData,[ $foo1, rangeCreator(5,8), function($value){ return ($value >= 5 && $value <= 7); } , "odd"]);

var_dump($res);
?>
