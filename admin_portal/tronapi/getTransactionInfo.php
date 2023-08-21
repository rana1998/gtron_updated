<?php
require_once('../../vendor/autoload.php');

$client = new \GuzzleHttp\Client();

$address ="TMshLMuGQjpBW3HvyuCCgYM2tQ7CoQSyQv";


$response = $client->request('GET', 'https://api.shasta.trongrid.io/v1/accounts/'.$address.'/transactions', [
  'headers' => [
    'accept' => 'application/json',
  ],
]);

echo $response->getBody();

?>