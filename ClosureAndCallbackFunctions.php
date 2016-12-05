<?php
//Генератор
function generate(){
	$array=[1,2,3,4,5,6,];
	foreach ($array as $val){
		yield $val;
	}
}

//foreach (generate() as $num) {
//	var_dump ($num);
//}

//===========================================================================================
//Механизм замыкания


function rangeCreator ($min=0, $max=1000) {
	//Область видимости 1
	$function = function($value) use ($min, $max) {
		//Область видимости 2 - перетягиваем сюда $min, $max из области видимости 1 - посредством use - это и есть замыкание
		return ($value >= $min && $value <= $max); //возвращает булево значение
	};		
	return $function;	//rangeCreator - фабрика функций	
}

$foo1 = rangeCreator(1,6); //1- Создаем функцию $foo1 - проверяет входит ли число в заданный диапазон
//var_dump($foo1);
$res = $foo1(3); //2 - Передаем созданной функции foo1 аргумент 3
echo '$foo1 return: <br>';
var_dump($res);

$foo2 = rangeCreator(5,10);
$res = $foo2(4);
echo '$foo2 return: <br>';
var_dump($res);

$arrayData = [0,1,2,3,4,5,6,7,8,9];

//Функция array_map - возвращает результирующий массив после прогона исходного массива данных через функцию $foo1
$resultArrayMap = array_map($foo1, $arrayData);
var_dump($resultArrayMap);

//Анонимная функция - нет имени - в переменной $funcEl делаем ссылку на анонимную функцию
$funcEl = function($el){
	return $el+1;
};

//Первый аргумент - анонимная функция, второй - массив данных
$resultArrayMap2 = array_map($funcEl, $arrayData); 

//Идентично строке выше - тело функции пишем как аргумент
//$resultArrayMap2 = array_map(function($el){
//	return $el+1;
//}, $arrayData);

//var_dump($resultArrayMap2);

//Функция array_filter - в качестве первого аргумента - массив данных, второй аргумент - функция обратного вызова
//Т.о. прогоняем каждый элемент массива через функцию $foo1 - результат функции булево значение - т.о. фильтруем массив - оставляем true
$resultArrayFilter = array_filter($arrayData, $foo1);
//var_dump($resultArrayFilter);

//=============================================================================
//Механизм обратного вызова - Пример №1
function printWithTags($string, $callback1, $callback2){
	//var_dump($string);
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

$res1 = printWithTags('Hell', $tagP, $tagB);
$res2 = printWithTags('Hello', $tagP, $tagB);

//===================================================================================================================================
//Механизм обратного вызова - Пример №2
//Прогоняем массив данных через массив функций как бы через несколько фильтров 

//cust_array_filter - самописная функция - перебираем функции обратного вызова - лежат в массиве $callbacks
function cust_array_filter($array, $callbacks){
	foreach($callbacks as $callback){
		$array = array_filter($array, $callback);
	}	
	return $array;
}

$arrayData = [-1, -29, 1,2,3,4,5,6,7,8,9,10];

$foo1 = rangeCreator(1,9); //создаем функцию $foo1 - отсеим от 1 до 9

//Обычная функция
function odd($var) {
    // является ли переданное число нечетным
    return($var & 1);
}

//Анонимная функция - нет имени - в переменной $funcEl делаем ссылку на анонимную функцию
$even = function ($var)
{
    // является ли переданное число четным
    return(!($var & 1));
};

//Первый элемент - массив данных, второй - массив функций - там функции обратного вызова лежат - в качестве элемента массива может быть функция, анонимная функция, код тела функции 
$res = cust_array_filter($arrayData,[ $foo1, rangeCreator(4,8), function($value){ return ($value >= 5 && $value <= 7);},"odd"]);
var_dump($res);

?>
