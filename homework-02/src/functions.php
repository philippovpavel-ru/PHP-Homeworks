<?php
function task1(array $strings, bool $return = false)
{
  $result = '';
  foreach ($strings as $string) {
    $result .= "<p>$string</p>";
  }

  if ($return) {
    return $result;
  }

  echo $result;
}

function task2(string $operation, ...$numbers)
{
  $firstNum = array_shift($numbers);
  $result = $firstNum;

  foreach ($numbers as $num) {
    if ( ! is_numeric($num) ) {
      continue;
    }

    switch ($operation) {
      case '+':
        $result += (float)$num;
        break;
      case '-':
        $result -= (float)$num;
        break;
      case '*':
        $result *= (float)$num;
        break;
      case '/':
        if ( $num == 0 ) {
          break;
        }

        $result /= (float)$num;
        break;
      default:
        $result = 'Недопустимая операция';
        break;
    }
  }

  echo "$result<br>";
}

function task3(int $rows, int $columns)
{
  if (func_num_args() !== 2) {
    trigger_error('function task3 требует два аргумента');
    return;
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

function myReadFile($fileName)
{
  $f = fopen($fileName, 'r');
  echo fread($f, filesize($fileName));
  fclose($f);
}