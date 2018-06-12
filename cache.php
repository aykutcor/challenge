<?php
class Cache {

    private $cacheUrl="cache.txt";

    function __constructor(){
        
    }

    public function readCache(){
        if(file_exists($this->cacheUrl)){
            $file = fopen( $this->cacheUrl, "rb" );
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
    public function writeCache($data){
        $this->checkFile();
        $file = fopen( $this->cacheUrl, "wb" );
        foreach ($data as $item) {
            fwrite($file,$item."\n");
        }
        fclose($file);
        return true;
    }
    public function checkFile(){
        if(file_exists($this->cacheUrl)){
            return;
        }else{	
            $file=fopen("cache.txt","wb");
            fclose($file);
        }
    }

}