<?php

require 'vendor/autoload.php';


use GuzzleHttp\Client;

$client = new Client([
    // Base URI is used with relative requests
    'base_uri' => 'http://localhost/',
    // You can set any number of default request options.
    'timeout'  => 2.0,
]);
/**
 * Geragar o as chaves para o cliente
 * php artisan passport:client --client
 * pegar o token
 * https://web.superalfa.coop.br/oauth/token
 * params
 * grant_type = client_credentials
 * client_id = igual ao client_id gerado
 * client_secret = igual ao client_secret gerado
 */
$response = $client->post('oauth/token', [
    'form_params' => [
        'grant_type' => 'client_credentials',
        'client_id' => '95e403b9-d527-4844-a3cf-4da214db80af',
        'client_secret' => 'A43o2IwSXr1loComVre2SP8ENAM5pBjn13G0u0aF',
    ]
]);

if($response->getReasonPhrase()){

  
    $data = json_decode($response->getBody(), true);

    $headers = [
        'Authorization' => sprintf('%s %s',$data['token_type'],$data['access_token']),        
        'Accept'        => 'application/json',
    ];

    $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_SPECIAL_CHARS);;

     include sprintf("%s.php",$page);
    
}