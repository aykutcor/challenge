<?php
function getRepoNameFromGit($userName){

    $repoUrl="https://api.github.com/users/$userName/repos";
    $method="GET";
    $cache = new Cache();
    $getCache=$cache->readCache($userName);
    $data=array();

    if($getCache !=null){
        $data=$getCache;
    }else{
        $client = new \GuzzleHttp\Client();
        try{

        $res = $client->request($method, $repoUrl);
        $json=$res->getBody();
        $list=json_decode($json);
        foreach ($list as $row) {
            array_push($data,$row->name);
        }
        if(count($data)>0){
            $setCache=$cache->writeCache($data,$userName);
            
        }

        }catch(Exception $e){
            echo "Kulanıcı adı bulunamadı.";
        }
        
    }

    return $data;
}
