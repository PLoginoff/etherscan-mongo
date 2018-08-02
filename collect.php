<?php

namespace app;

use etherscan\api\Etherscan;

require_once __DIR__  . '/vendor/autoload.php';

$address = '0xc2807533832807Bf15898778D8A108405e9edfb1';

/*
$client = new Etherscan('empty');

$list   = $client->transactionList($address,0, 1E9, 'desc', 1, 20000);

    [blockNumber] => 5669428
    [timeStamp] => 1527176540
    [hash] => 0x491f2b1d7aeb922c1a67da39780a05a3311f0879bcba67f064f59da175db5e73
    [nonce] => 4
    [blockHash] => 0xd48405d46cf086aaef9e6dfcdbd24b73d45418f89f6f32f4e000f00ecc2e11c8
    [transactionIndex] => 78
    [from] => 0x05b2783dc2b88b5cf0509ba12f1aef1cae944b0f
    [to] => 0xc2807533832807bf15898778d8a108405e9edfb1
    [value] => 0
    [gas] => 37618
    [gasPrice] => 11000000000
    [isError] => 0
    [txreceipt_status] => 1
    [input] => 0xa9059cbb000000000000000000000000395048c5b04f834f5672a88832b9698c4fc403e80000000000000000000000000000000000000000000000000000002bbfb67700
    [contractAddress] =>
    [cumulativeGasUsed] => 3216738
    [gasUsed] => 22618
    [confirmations] => 405383

echo json_encode($list, JSON_PRETTY_PRINT);

*/

$result = [];
foreach (json_decode(file_get_contents('collect.json'), true)['result'] as $t) {
    $date = date('Y-m-d', $t['timeStamp']);
    // $result[$date]
    if (strstr($t['input'], '0xa9059cbb') === false) {
        continue;
    }

    // round pt
    $input = (int) round(hexdec(trim(substr($t['input'], -32), '0')) / 1E8);

    if (empty($result[$date])) {
        $result[$date] = 0;
    }

    $result[$date] += $input;
}

ksort($result);

foreach ($result as $i => $v) {
    echo "$i\t$v\n";
}

