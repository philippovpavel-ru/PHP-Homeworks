<?php

require '../vendor/autoload.php';

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\Typography\FontFactory;

// create new image instance
$manager = new ImageManager(new Driver());
$image = $manager->read(file_get_contents('cat.jpg'));

$image->scale(width: 200);

$text = "the cat the cat\n the cat the cat\n the cat the cat\n the cat the cat";

$image->text($text, 100, 100, function (FontFactory $font) {
  $font->file('Oswald-Regular.ttf');
  $font->size(30);
  $font->color('#ffffff2b');
  $font->align('center');
  $font->valign('middle');
  $font->angle(-45);
});

$image->save('cat-200.jpg');

echo '<img src="cat-200.jpg">';