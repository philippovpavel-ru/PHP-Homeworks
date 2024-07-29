<?php
require_once('src/functions.php');

// Задание #1
task1(['Hello', 'World']);
echo task1(['GoodBye', 'Word'], true);

echo '<hr>';

// Задание #2
task2('+', 1, 2, 'не число', 3, 5.2); //11.2
task2('-', 1, 2, 'не число', 3, 5.2); //-9.2
task2('*', 1, 2, 'не число', 3, 5.2); //31.2
task2('/', 1, 2, 'не число', 3, '0', '5.2'); //0.032051282051282

echo '<hr>';

// Задание #3
task3( rand(5, 10), rand(5, 10) );

echo '<hr>';

// Задание #4
date_default_timezone_set('Europe/Moscow');
echo date('d.m.Y H:i') . "<br>";
echo strtotime('24.02.2016 00:00:00') . "<br>";

echo '<hr>';

// Задание #5
$str1 = str_replace('К', '', 'Карл у Клары украл Кораллы');
echo $str1 . '<br>';

$str2 = str_replace('Две', 'Три', 'Две бутылки лимонада');
echo $str2 . '<br>';

echo '<hr>';

// Задание #6
$file = 'test.txt';
if (!file_exists($file)) {
  $f = fopen($file, 'w');
  fwrite($f, 'Hello again!');
  fclose($f);

}
myReadFile($file);

echo '<hr>';