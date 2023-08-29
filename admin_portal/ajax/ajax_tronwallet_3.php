<?php
require '../../vendor/autoload.php'; // Load the Composer autoloader

use IEXBase\TronAPI\Tron;

try {
    // $fullNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.trongrid.io');
    // $solidityNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.trongrid.io');
    // $eventServer = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.trongrid.io');
    $fullNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.shasta.trongrid.io');
    $solidityNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.shasta.trongrid.io');
    $eventServer = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.shasta.trongrid.io');
    
    $tron = new Tron($fullNode, $solidityNode, $eventServer);
    
    // $privateKey = 'YOUR_PRIVATE_KEY'; // Replace with your actual private key
    // $toAddress = 'RECIPIENT_ADDRESS';   // Replace with the recipient's address
    // $amount = 1000000; // TRX amount in SUN (1 TRX = 1000000 SUN)

    // $toAddress = 'TZ4UXDV5ZhNW7fb2AMSbgfAEZ7hWsnYS2g';
    // $amount = 100;
    $amount = 1;
    // $privateKey = 'c77eff71a698c77a108f20b85c1f16c88aca4422b15164a88de86088b1b1eef5';
    
    // $transaction = [
    //     'to' => $toAddress,
    //     'amount' => $amount    ];
    
    // Sign the transaction
    // $signedTransaction = $tron->signTransaction($transaction, $privateKey);

    // print_r($signedTransaction);
    // exit();
    
    // Broadcast the transaction
    // $result = $tron->sendRawTransaction($signedTransaction);
    
    // var_dump($result);

    //Step 2
    // Function to sign the transaction using TronWeb
    function signTransaction($transactionData, $privateKey) {
        try {
            $tron = new Tron();
            $privateKey = 'c77eff71a698c77a108f20b85c1f16c88aca4422b15164a88de86088b1b1eef5';
            $tron->setPrivateKey($privateKey);

            $transaction = [
                'to' => $transactionData['to_address'],
                'amount' => (float)$transactionData['amount'],
            ];

            // print_r($transaction);
            // exit();

            // Construct and sign the transaction
            $signedTransaction = $tron->getTransactionBuilder()
                ->sendTrx(
                    $transaction['to'],
                    $transaction['amount'],
                    $tron->getAddress(),
                    $tron->getAddress() // You can set the "from" address here
                )
                ->sign($privateKey)
                ->broadcast();
            
            print_r($signedTransaction);
            // exit();

            echo "Signed Transaction: " . json_encode($signedTransaction);
        } catch (TronException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // // Example transaction data
    $transactionData = [
        'to_address' => 'TPswDDCAWhJAZGdHPidFg5nEf8TkNToDX1',
        'amount' => 1, // Amount in SUN (Tron's smallest unit)
    ];

    $privateKey = 'c77eff71a698c77a108f20b85c1f16c88aca4422b15164a88de86088b1b1eef5';

    signTransaction($transactionData, $privateKey);
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
