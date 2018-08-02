<?php

namespace app;

use etherscan\api\Etherscan;

require_once __DIR__  . '/vendor/autoload.php';

$client = new Etherscan('empty');
print_r($client->balance('0x8Ef300465FBf0f3867E85AC60D9faD9DC6a232d9'));





