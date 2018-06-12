<?php 
require 'vendor/autoload.php';
require 'cache.php';

$repoUrl="https://api.github.com/users/reterius/repos";
$method="GET";
$cache = new Cache();
$getCache=$cache->readCache();

if($getCache !=null){
    output($getCache);
}else{
    $data=getRepoNameFromGit();
    if(count($data)>0){
        $setCache=$cache->writeCache($data);
        if($setCache){
            output($cache->readCache());
        }
    }
}

function getRepoNameFromGit(){
    $data=array();
    $client = new \GuzzleHttp\Client();
    $res = $client->request("GET", "https://api.github.com/users/reterius/repos");
    $json=$res->getBody();
    $list=json_decode($json);
    foreach ($list as $row) {
        array_push($data,$row->name);
    }
    return $data;
}
function output($data){
    foreach ($data as $item) {
        echo $item . "\n";
    }
}
