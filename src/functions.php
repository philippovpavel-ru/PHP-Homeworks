<?php
function task1(array $strings, bool $return = false)
{
  $result = '';
  foreach ($strings as $string) {
    if ($return) {
      $result .= "<p>$string</p>";
    } else {
      echo "<p>$string</p>";
    }
  }
  if ($return) {
    return $result;
  }
}

function task2(string $operation, ...$numbers)
{
  $firstNum = array_shift($numbers);
  $result = $firstNum;

  foreach ($numbers as $num) {
    switch ($operation) {
      case '+':
        $result += $num;
        break;
      case '-':
        $result -= $num;
        break;
      case '*':
        $result *= $num;
        break;
      case '/':
        $result /= $num;
        break;
    }
  }

  echo "$result<br>";
}

function task3(int $rows, int $columns)
{
  if (func_num_args() !== 2) {
    throw new InvalidArgumentException('function task3 требует два аргумента');
  }

  echo '<table border="1">';
  for ($i = 1; $i <= $rows; $i++) {
    echo '<tr>';
    for ($j = 1; $j <= $columns; $j++) {
      $result = $i * $j;
      echo "<td>$j x $i = $result</td>";
    }
    echo '</tr>';
  }
  echo '</table>';
}
