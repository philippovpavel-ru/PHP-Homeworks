<?php
require_once('src/functions.php');

// создаем 50 случайных пользователей
$random_users = getRandomUsers(50);
$users = [];

if ( !empty($random_users) ) {
  // записываем данные в файл
  file_put_contents('users.json', json_encode($random_users));

  // считываем данные из файла
  $users = json_decode(file_get_contents('users.json'), true);
}

// подсчитываем количество пользователей с каждым именем
$countUsers = getCountUsers($users);

// подсчитываем средний возраст пользователей
$averageAge = getEverageAge($users);

if ( $countUsers && $averageAge ) {
  // формируем данные для вывода
  $countUsersList = implode('', array_map(function( $key, $value ) {
    return "<li>$key: $value</li>";
  }, array_keys($countUsers), $countUsers)) ;
  
  // выводим результат
  echo "<p><strong>Количество пользователей с каждым именем:</strong> <ul>$countUsersList</ul></p>";
  echo "<p><strong>Средний возраст пользователей:</strong> $averageAge</p>";
}