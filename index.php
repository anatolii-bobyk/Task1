<?php

use Models\PriceImport;
use Models\CalculatePrice;
use Models\Terminal;

require_once 'filesInclude.php';

$importer = new PriceImport('prices.csv');
try {
    $priceData = $importer->getPriceData();
} catch (Exception $e) {
    echo $e->getMessage();
    exit;
}

$price = new CalculatePrice($priceData);
$terminal = new Terminal();
$terminal->setPrice($price);

$array = ['ABCDABAA', 'CCCCCCC', 'ABCD'];
$sapi_type = php_sapi_name() === 'cli' ? "\n" : '<br>';
foreach ($array as $objects) {
    echo "Scanning $objects $sapi_type";
    $terminal->reset();
    $chars = str_split(($objects));
    foreach ($chars as $char) {
        $terminal->scan($char);
    }
    echo 'Total price is: $' . $terminal->total . $sapi_type;
}
