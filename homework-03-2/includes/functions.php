<?php
require_once 'connection.php';

function createOrder(int $user_id, string $address, string $comment, string $payment, int $callback)
{
  global $PDO;

  $new_order_query = $PDO->prepare("INSERT INTO orders (`user_id`, `address`, `comment`, `payment`, `callback`) VALUES (:user_id, :address, :comment, :payment, :callback)");

  $execute = $new_order_query->execute([
    ':user_id' => $user_id,
    ':address' => $address,
    ':comment' => $comment,
    ':payment' => $payment,
    ':callback' => $callback
  ]);

  if (!$execute) {
    echo "There is some problems";
  }
}

function createUser(string $email, string $username, string $phone)
{
  global $PDO;

  $new_user_query = $PDO->prepare("INSERT INTO users (`email`, `username`, `phone`) VALUES (:email, :username, :phone)");
  $new_user_query->execute([
    ':email' => $email,
    ':username' => $username,
    ':phone' => $phone
  ]);
}

function selectByEmail(string $email)
{
  global $PDO;

  $result = $PDO->prepare("SELECT * FROM users WHERE `email` = :email ");
  $result->execute([
    ':email' => $email
  ]);

  return $result->fetch(PDO::FETCH_ASSOC);
}

function selectById(int $user_id)
{
  global $PDO;
  global $orderNumber;

  $resultOrder = $PDO->prepare("SELECT * FROM orders WHERE `user_id` = :user_id ");
  $resultOrder->execute([':user_id' => $user_id]);
  $numberOrder = $resultOrder->fetchAll(PDO::FETCH_ASSOC);

  $orderNumber = '';
  foreach ($numberOrder as $value) {
    $orderNumber = $value['id'];
  }
}

function countOrder(int $user_id)
{
  global $PDO;

  $count = $PDO->prepare("SELECT COUNT(*) as count FROM `orders` WHERE `user_id` = :user_id");
  $count->execute([':user_id' => $user_id]);

  $countResult = $count->fetch(PDO::FETCH_ASSOC);

  return $countResult['count'];
}

function getMessage(string $address, int $count = 1)
{
  global $orderNumber;

  echo "Спасибо, ваш заказ будет доставлен по адресу: $address<br>";
  echo "Номер вашего заказа: $orderNumber<br>";
  echo "Это ваш $count-й заказ!<br>";
}