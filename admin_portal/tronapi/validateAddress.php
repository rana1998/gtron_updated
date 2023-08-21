<?php
require_once('../../vendor/autoload.php');

$client = new \GuzzleHttp\Client();

$address ="TMshLMuGQjpBW3HvyuCCgYM2tQ7CoQSyQv";


$response = $client->request('POST', 'https://api.shasta.trongrid.io/wallet/validateaddress', [
  'body' => '{"address":"'.$address.'","visible":true}',
  'headers' => [
    'accept' => 'application/json',
    'content-type' => 'application/json',
  ],
]);

echo $response->getBody();

?>