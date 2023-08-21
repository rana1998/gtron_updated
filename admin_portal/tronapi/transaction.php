<?php 
require '../../vendor/autoload.php';
use GuzzleHttp\Client;

// Instantiate a GuzzleHttp client
$client = new Client();

// Tron Shasta API endpoint
$apiEndpoint = 'https://api.shasta.trongrid.io';

// Replace these placeholders with your actual values
$senderAddress = 'TMshLMuGQjpBW3HvyuCCgYM2tQ7CoQSyQv';
$recipientAddress = 'TPHyyDRvbT3LgoSmqWTHVuMUBeZB45jKvk';
$privateKey = 'c77eff71a698c77a108f20b85c1f16c88aca4422b15164a88de86088b1b1eef5';

// Build the transaction data
$transactionData = [
    'to' => $recipientAddress,
    'amount' => 1000000,  // Amount in SUN (smallest Tron unit)
];

// Sign the transaction
// $signedTransaction = signTransaction($transactionData, $privateKey);
$signedTransaction = signTransaction($transactionData, $privateKey, $senderAddress);

// Prepare the API request
$response = $client->post("$apiEndpoint/wallet/createtransaction", [
    'json' => $signedTransaction,
]);

// Process the response
if ($response->getStatusCode() === 200) {
    $responseData = json_decode($response->getBody(), true);
    
    // Broadcast the signed transaction
    $response = $client->post("$apiEndpoint/wallet/broadcasttransaction", [
        'json' => $responseData,
    ]);
    
    if ($response->getStatusCode() === 200) {
        echo 'Transaction successfully broadcasted.';
    } else {
        echo 'Error broadcasting transaction.';
    }
} else {
    echo 'Error creating transaction.';
}



// Function to sign the transaction using TronWeb and GuzzleHttp
function signTransaction($transactionData, $privateKey, $senderAddress) {
    // Instantiate a GuzzleHttp client
    $client = new Client();

    // Tron Shasta API endpoint
    $apiEndpoint = 'https://api.shasta.trongrid.io';

    // Construct the transaction data
    $transaction = [
        'to' => $transactionData['to'],
        'amount' => $transactionData['amount'],
        'owner_address' => $senderAddress,
    ];

    // Prepare the API request to create the transaction
    $response = $client->post("$apiEndpoint/wallet/createtransaction", [
        'json' => $transaction,
    ]);

    if ($response->getStatusCode() === 200) {
        $responseData = json_decode($response->getBody(), true);
        
        // Sign the transaction
        $signedTransaction = [
            'transaction' => $responseData,
            'privateKey' => $privateKey,
        ];
        
        return $signedTransaction;
    } else {
        throw new Exception('Error creating transaction.');
    }
}

// // Function to sign the transaction using TronWeb
// function signTransaction($transactionData, $privateKey) {
//     // Use TronWeb library to sign the transaction
//     $tronWeb = new \IEXBase\TronAPI\Tron();
//     $tronWeb->setPrivateKey($privateKey);
    
//     // Construct the transaction
//     $transaction = $tronWeb->transactionBuilder->sendTrx(
//         $transactionData['to'],
//         $transactionData['amount'],
//         $senderAddress
//     );
    
//     // Sign the transaction
//     $signedTransaction = $tronWeb->signTransaction($transaction);
    
//     return $signedTransaction;
// }




?>