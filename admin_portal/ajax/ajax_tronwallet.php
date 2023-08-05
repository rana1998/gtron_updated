<?php
require '../../vendor/autoload.php';

require_once('../core/config.php');
require_once('../core/session.php');
require_once('../helper/AdminHelper.php');
$db = getDB();  

session_start();


if(isset($_SESSION['isOTPmatch']) && $_SESSION['isOTPmatch'] == true) {

    unset($_SESSION['isOTPmatch']);

    $curl = curl_init();

    $receiverWalletAddress = $_POST['walletAddress'];
    $gtronAmount = (float)$_POST['gtronAmount'];

    curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.shasta.trongrid.io/wallet/createtransaction",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode([
        'owner_address' => 'TZ4UXDV5ZhNW7fb2AMSbgfAEZ7hWsnYS2g',
        // 'to_address' => '$receiverWalletAddress',
        'to_address' => 'TPswDDCAWhJAZGdHPidFg5nEf8TkNToDX1',
        'amount' => $gtronAmount,
        'visible' => true
    ]),
    CURLOPT_HTTPHEADER => [
        "accept: application/json",
        "content-type: application/json"
    ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    

    if ($err) {
    // echo "cURL Error #:" . $err;
    echo "failed";
    } else {
        $res = AdminHelper::updateAdminWalletSummeryLogs($db,$gtronAmount,$receiverWalletAddress);
        if($res == 'Data inserted successfully.') {
            echo $response;
        }
    }
} else {
    echo "failed";
}

?>