<?php
// Задание #1
$name = 'Павел';
$age = 34;

echo "Меня зовут: $name<br>";
echo "Мне $age года<br>";
echo '"!|/\'"\\<br>';

echo '<br>';

// Задание #2
// На школьной выставке 80 рисунков. 23 из них выполнены фломастерами, 40 карандашами, а остальные — красками. Сколько рисунков, выполненные красками, на школьной выставке?
define('NUMBER_OF_PICTURES', 80);
define('NUMBER_OF_FOMOGRAMS', 23);
define('NUMBER_OF_PENCILS', 40);

$number_of_pictures_painted = NUMBER_OF_PICTURES - NUMBER_OF_FOMOGRAMS - NUMBER_OF_PENCILS;
echo "Количество рисунков, выполненных краской: $number_of_pictures_painted<br>";

echo '<br>';

// Задание #3
$age = getRandomNumber();

echo "Возраст: $age<br>";
if ($age >= 18 && $age <= 65) {
  echo 'Вам еще работать и работать<br>';
} elseif ($age > 65) {
  echo 'Вам пора на пенсию<br>';
} elseif ($age >= 1 && $age < 18) {
  echo 'Вам ещё рано работать<br>';
} else {
  echo 'Неизвестный возраст<br>';
}

echo '<br>';

// Задание #4
$day = getRandomNumber(1, 10);

echo "День недели: $day<br>";
switch ($day) {
  case 1:
  case 2:
  case 3:
  case 4:
  case 5:
    echo 'Это рабочий день<br>';
    break;
  case 6:
  case 7:
    echo 'Это выходной день<br>';
    break;
  default:
    echo 'Неизвестный день<br>';
}

echo '<br>';

// Задание #5
$bmw = array(
  "model" => "X5",
  "speed" => 120,
  "doors" => 5,
  "year" => "2015"
);

$toyota = array(
  "model" => "Camry",
  "speed" => 150,
  "doors" => 4,
  "year" => "2016"
);

$opel = array(
  "model" => "Insignia",
  "speed" => 125,
  "doors" => 5,
  "year" => "2017"
);

$cars = array(
  "bmw" => $bmw,
  "toyota" => $toyota,
  "opel" => $opel
);

foreach ($cars as $car_name => $car) {
  echo "CAR $car_name<br>";

  foreach ($car as $name => $value) {
    echo "$value ";
  }

  echo '<br><br>';
}

echo '<br>';

echo "<table border='1'>";
for ($i = 1; $i <= 10; $i++) {
  $tr_content = '';

  for ($j = 1; $j <= 10; $j++) {
    $value = $i * $j;

    if ($i % 2 == 0 && $j % 2 == 0) {
      $tr_content .= "<td>($value)</td>";
    } elseif ($i % 2 != 0 && $j % 2 != 0) {
      $tr_content .= "<td>[$value]</td>";
    } else {
      $tr_content .= "<td>$value</td>";
    }
  }

  echo "<tr>$tr_content</tr>";
}
echo "</table>";

// случайное число
function getRandomNumber(int $min = 1, int $max = 100)
{
  if (!is_int($min) || !is_int($max)) {
    throw new InvalidArgumentException('Оба аргумента должны быть числами');
  }

  return rand($min, $max);
}
