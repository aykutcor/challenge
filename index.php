<?php 
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
require 'vendor/autoload.php';
require 'cache.php';
require 'functions.php';

$gitHubUserName="aykutcor";
$data=getRepoNameFromGit($gitHubUserName);

foreach ($data as $item) {
    echo $item . '<br>';
}

