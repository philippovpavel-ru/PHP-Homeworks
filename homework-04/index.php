<?php
// интерфейс тарифа
interface Tariff
{
  public function countPrice(): int;
  public function addService(Service $service): self;
  public function getMinutes(): int;
  public function getDistance(): int;
}

// интерфейс услуги
interface Service
{
  public function apply(Tariff $tariff, &$price);
}

// абстрактный тариф
abstract class AbstractTariff implements Tariff
{
  protected $pricePerKilometer;
  protected $pricePerMinute;
  protected $distance;
  protected $minutes;
  protected $services = [];

  public function __construct(int $distance, int $minutes)
  {
    $this->distance = $distance;
    $this->minutes = $minutes;
  }

  public function countPrice(): int
  {
    $price = $this->distance * $this->pricePerKilometer + $this->minutes * $this->pricePerMinute;

    if ($this->services) {
      foreach ($this->services as $service) {
        $service->apply($this, $price);
      }
    }

    return $price;
  }

  public function addService(Service $service): Tariff
  {
    array_push($this->services, $service);
    return $this;
  }

  public function getMinutes(): int
  {
    return $this->minutes;
  }

  public function getDistance(): int
  {
    return $this->distance;
  }
}

// базовый тариф
class BasicTariff extends AbstractTariff
{
  protected $pricePerKilometer = 10;
  protected $pricePerMinute = 3;
}

// часовой тариф
class HourlyTariff extends AbstractTariff
{
  protected $pricePerKilometer = 0;
  protected $pricePerMinute = 200 / 60;

  public function __construct(int $distance, int $minutes)
  {
    parent::__construct($distance, $minutes);
    $this->minutes = $this->minutes - $this->minutes % 60 + 60;
  }
}

// студенческий тариф
class StudentTariff extends AbstractTariff
{
  protected $pricePerKilometer = 4;
  protected $pricePerMinute = 1;
}

// интерфейс сервиса
class GpsService implements Service
{
  private $pricePerHour;

  public function __construct(int $pricePerHour)
  {
    $this->pricePerHour = $pricePerHour;
  }

  public function apply(Tariff $tariff, &$price)
  {
    $hours = ceil($tariff->getMinutes() / 60);
    $price += $this->pricePerHour * $hours;
  }
}

// интерфейс сервиса
class DriverService implements Service
{
  private $price;

  public function __construct(int $price)
  {
    $this->price = $price;
  }

  public function apply(Tariff $tariff, &$price)
  {
    $price += $this->price;
  }
}

// пример использования
$km = 5;
$min = 63;

// базовый тариф
$tariff = new BasicTariff($km, $min);
echo 'Базовый тариф: ' . $tariff->countPrice() . '<br>';

$tariff->addService(new GpsService(15));
echo 'Базовый тариф + Gps в салон: ' . $tariff->countPrice() . '<br>';

$tariff->addService(new DriverService(100));
echo 'Базовый тариф + Gps в салон + водитель: ' . $tariff->countPrice();

echo '<hr>';

// почасовой тариф
$tariff = new HourlyTariff($km, $min);
echo 'Почасовый тариф: ' . $tariff->countPrice() . '<br>';

$tariff->addService(new GpsService(15));
echo 'Почасовый тариф + Gps в салон: ' . $tariff->countPrice() . '<br>';

$tariff->addService(new DriverService(100));
echo 'Почасовый тариф + Gps в салон + водитель: ' . $tariff->countPrice();

echo '<hr>';

// студенческий тариф
$tariff = new StudentTariff($km, $min);
echo 'Студенческий тариф: ' . $tariff->countPrice() . '<br>';

$tariff->addService(new GpsService(15));
echo 'Студенческий тариф + Gps в салон: ' . $tariff->countPrice() . '<br>';

$tariff->addService(new DriverService(100));
echo 'Студенческий тариф + Gps в салон + водитель: ' . $tariff->countPrice();
