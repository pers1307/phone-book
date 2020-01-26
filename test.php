<?php

namespace pers1307\phoneBook;

use pers1307\phoneBook\service\PhoneToText;

require __DIR__ . '/vendor/autoload.php';

/** @var PhoneToText $phoneToText */
$phoneToText = new PhoneToText();

for ($index = 1; $index < 999999999999; $index++) {
    print_r($index . ' : ' . $phoneToText->convertPhoneToText($index));
}