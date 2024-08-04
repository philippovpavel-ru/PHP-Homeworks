<?php
// если пустой $_POST
if ( empty($_POST) ) {
  header("HTTP/1.0 404 Not Found");
  exit;
}

// подключаемся
require_once __DIR__ . '/includes/connection.php'; // к БД
require_once __DIR__ . '/includes/functions.php'; // к функциям

// включаем отображение ошибок
ini_set('display_errors', 'on');
ini_set('error_reporting', E_NOTICE | E_ALL);

// поле email
$email = !empty($_POST['email']) ? $_POST['email'] : '';

// если поле email пустое
if (empty($email)) {
  echo 'Заполните поле Email';
  exit;
}

// остальные поля
$name = !empty($_POST['name']) ? $_POST['name'] : '';
$phone = !empty($_POST['phone']) ? $_POST['phone'] : '';

$comment = !empty($_POST['comment']) ? $_POST['comment'] : '';
$payment = !empty($_POST['payment']) ? $_POST['payment'] : '';
$callback = empty($_POST['callback']) ? 1 : 0;

// формируем адрес
$adress_array = [];

foreach ($_POST as $key => $value) {
  if (in_array($key, ['street', 'home', 'part', 'appt', 'floor']) && !empty($value)) {
    $adress_array[$key] = $value;
  }
}

$address = implode(', ', $adress_array);

// получаем данные пользователя по email
$user = selectByEmail($email);

// если пользователь не найден, создаем
if ( empty($user) ) {
  createUser($email, $name, $phone);
  $user = selectByEmail($email);
}

// получаем id пользователя и создаем заказ
$user_id = (int)$user['id'];
createOrder( $user_id, $address, $comment, $payment, (int)$callback);
selectById( $user_id );

// формируем и выводим сообщение об успешном успехе
$count = intval(countOrder($user_id) ?: 1);
getMessage($address, $count);