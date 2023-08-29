
<?php
include_once '../../vendor/autoload.php';

// $fullNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.trongrid.io');
// $solidityNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.trongrid.io');
// $eventServer = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.trongrid.io');

// try {
//     $tron = new \IEXBase\TronAPI\Tron($fullNode, $solidityNode, $eventServer);
// } catch (\IEXBase\TronAPI\Exception\TronException $e) {
//     exit($e->getMessage());
// }

// $tron->setAddress('TGEbBaHpoVXbLzbo1heSENn2GjThAFgT2n');
// $tron->setPrivateKey('8386338e8b18c8f2ec2089fcc8991b396afa9f0ad668555461d8736bd4d23c08');

// try {
//     $transfer = $tron->send( 'TZ4UXDV5ZhNW7fb2AMSbgfAEZ7hWsnYS2g', 1);
// } catch (\IEXBase\TronAPI\Exception\TronException $e) {
//     die($e->getMessage());
// }

// var_dump($transfer);

// $fullNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://nile.trongrid.io/');
// $solidityNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://nile.trongrid.io/');
// $eventServer = new \IEXBase\TronAPI\Provider\HttpProvider('https://nile.trongrid.io/');
$fullNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.shasta.trongrid.io');
$solidityNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.shasta.trongrid.io');
$eventServer = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.shasta.trongrid.io');

try {
    $tron = new \IEXBase\TronAPI\Tron($fullNode, $solidityNode, $eventServer);
} catch (\IEXBase\TronAPI\Exception\TronException $e) {
    exit($e->getMessage());
}

// Convert the amount to SUN (1 TRX = 1,000,000 SUN)
$amountInSun = 100000; // For example, sending 0.1 TRX
try {
    $transaction = $tron->getTransactionBuilder()->sendTrx('TPswDDCAWhJAZGdHPidFg5nEf8TkNToDX1', (float)$amountInSun,'TZ4UXDV5ZhNW7fb2AMSbgfAEZ7hWsnYS2g');
    print_r($transaction);
    exit();
    $signedTransaction = $tron->signTransaction($transaction);
    $response = $tron->sendRawTransaction($signedTransaction);
    print_r($response);
} catch (\IEXBase\TronAPI\Exception\TronException $e) {
    die($e->getMessage());
}

?>