<?php
class Cache {

    private $cacheUrl="./cache/";

    function __constructor(){
        
    }

    public function readCache($userName){
        $getUrl=$this->setUrlByUserName($userName);
        if(file_exists($getUrl)){
            $file = fopen( $getUrl, "rb" );
            $data=array();
            while (!feof($file)) {
                array_push($data,fgets($file));
            }
            fclose( $file );
            return $data;
        }else{
            return null;
        }
    }
    public function writeCache($data,$userName){
        $getUrl=$this->setUrlByUserName($userName);
        $this->checkFile($getUrl);
        $file = fopen( $getUrl, "wb" );
        foreach ($data as $item) {
            fwrite($file,$item."\n");
        }
        fclose($file);
        return true;
    }
    public function checkFile($getUrl){
        $getUrl=$this->setUrlByUserName($userName);
        if(file_exists($getUrl)){
            return;
        }else{	

           $dirName=dirname(__FILE__).'/cache/';
            $check=$this->checkPerms($dirName);
            if(!$check){
                $this->setPerms($dirName);
            }
            $file=fopen($getUrl,"w");
            fclose($file);
        }
    }
    function checkPerms($path)
    {   
        $permission=fileperms($path);
        if($permission==16895){
            return true;
        }else{
            return false;
        }
    }
    function setPerms($path)
    {   
       shell_exec("sudo chmod -R 777 ".$path);
    }
    function setUrlByUserName($userName){
        return $this->cacheUrl.$userName."."."txt";
    }

}