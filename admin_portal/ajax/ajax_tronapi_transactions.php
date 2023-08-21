<?php 
error_reporting(E_ERROR | E_PARSE);
// require '../../vendor/autoload.php';

// use IEXBase\TronAPI\Provider\HttpProvider;
// use IEXBase\TronAPI\Tron;

// $fullNode = new HttpProvider('https://api.shasta.trongrid.io');
// // You can similarly create objects for other nodes (solidityNode, eventServer, privateNode, tronGrid) if needed

// $tron = new Tron($fullNode);

// // use IEXBase\TronAPI\Tron;

// $ownerAddress = "TMshLMuGQjpBW3HvyuCCgYM2tQ7CoQSyQv"; // Owner's address
// $receiverAddress = "TPHyyDRvbT3LgoSmqWTHVuMUBeZB45jKvk"; // Receiver's address
// $amount = 100; // Amount to transfer in TRX (for example)

// $transactionData = [
//     'to_address' => $receiverAddress,
//     'owner_address' => $ownerAddress,
//     'amount' => $amount * 1000000, // TRON uses SUN (smallest unit), 1 TRX = 1,000,000 SUN
//     'visible' => true
// ];


// // $tron = new Tron('https://api.shasta.trongrid.io'); 
// // TRON API endpoint

// // Load the private key
// $privateKey = 'c77eff71a698c77a108f20b85c1f16c88aca4422b15164a88de86088b1b1eef5'; // Replace with the actual private key
// $tron->setPrivateKey($privateKey);

// // Sign the transaction
// $signedTransaction = $tron->signTransaction($transactionData);

// $response = $tron->sendRawTransaction($signedTransaction);
// if ($response['result']) {
//     echo "Transaction Broadcasted Successfully. TXID: " . $response['txid'];
// } else {
//     echo "Broadcasting Failed. Error: " . $response['message'];
// }



require '../../vendor/autoload.php'; // Load Composer's autoloader

use IEXBase\TronAPI\Provider\HttpProvider;
use IEXBase\TronAPI\Tron;

$fullNode = new HttpProvider('https://api.shasta.trongrid.io');
$tron = new Tron($fullNode);

// Set up private key and addresses
$privateKey = 'c77eff71a698c77a108f20b85c1f16c88aca4422b15164a88de86088b1b1eef5'; // Replace with the actual private key
// $ownerAddress = '...'; // Replace with owner's address
// $receiverAddress = '...'; // Replace with receiver's address
$ownerAddress = "TMshLMuGQjpBW3HvyuCCgYM2tQ7CoQSyQv"; // Owner's address
$receiverAddress = "TPHyyDRvbT3LgoSmqWTHVuMUBeZB45jKvk"; // Receiver's address
$amount = 100; // Amount to transfer in TRX (for example)

// Set up transaction data
$transactionData = [
    'to_address' => $receiverAddress,
    'owner_address' => $ownerAddress,
    'amount' => $amount * 1000000, // TRON uses SUN (smallest unit), 1 TRX = 1,000,000 SUN
    'visible' => true
];

// Sign the transaction
$tron->setPrivateKey($privateKey);
$signedTransaction = $tron->signTransaction($transactionData);

var_dump($signedTransaction);

// Broadcast the transaction
$response = $tron->sendRawTransaction($signedTransaction);

// Check response
if ($response['result']) {
    echo "Transaction Broadcasted Successfully. TXID: " . $response['txid'];
} else {
    echo "Broadcasting Failed. Error: " . $response['message'];
}



?>