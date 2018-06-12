<?php 
require 'vendor/autoload.php';

$client = new \GuzzleHttp\Client();
$res = $client->request('GET', 'https://api.github.com/users/reterius/repos');
//echo $res->getStatusCode();
// 200
//echo $res->getHeaderLine('content-type');
// 'application/json; charset=utf8'
$json=$res->getBody();
// '{"id": 1420053, "name": "guzzle", ...}'
$list=json_decode($json);
//print_r($list);
foreach ($list as $row) {
    echo $row->name . "\n";
}