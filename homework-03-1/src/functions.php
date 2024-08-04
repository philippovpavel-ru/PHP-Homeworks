<?php
// вовзращаем массив из 50 случайных пользователей
function getRandomUsers( int $count = 50 )
{
  // проверяем количество пользователей
  if ( ! is_numeric( $count ) ) {
    trigger_error('function getRandomUsers требует чтобы аргумент $count был числом');
    return [];
  }

  if ($count < 1) {
    trigger_error('function getRandomUsers требует, чтобы аргумент $count был больше нуля');
    return [];
  }

  $users = [];

  for ($i = 0; $i < $count; $i++) {
    $users[] = [
      'id' => $i,
      'name' => randomName(),
      'age' => randomAge(),
    ];
  }

  return $users;
}

// подсчитываем количество пользователей с каждым именем
function getCountUsers( array $users = [] )
{
  if ( empty($users) ) {
    return [];
  }

  if ( ! is_array($users) ) {
    trigger_error('function getCountUsers требует, чтобы аргумент $users был массивом');
    return [];
  }

  $countUsers = [];

  foreach ($users as $user) {
    if (!isset($countUsers[$user['name']])) {
      $countUsers[$user['name']] = 0;
    }

    $countUsers[$user['name']]++;
  }

  return $countUsers;
}

// подсчитываем средний возраст пользователей
function getEverageAge( array $users = [] )
{
  if (empty($users)) {
    return 0;
  }

  if (!is_array($users)) {
    trigger_error('function getEverageAge требует, чтобы аргумент $users был массивом');
    return 0;
  }

  // подсчитываем средний возраст
  $totalAge = 0;

  foreach ($users as $user) {
    $totalAge += $user['age'];
  }

  // вовзращаем средний возраст
  return intval($totalAge / count($users));
}

// выбираем случайное имя
function randomName()
{
  $names = ['Иван', 'Петр', 'Антон', 'Мария', 'Ольга'];
  return $names[array_rand($names)];
}

// выбираем случайный возраст
function randomAge()
{
  return rand(18, 45);
}
