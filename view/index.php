<?php 
require_once __DIR__ . '/../vendor/autoload.php';
use src\ServersCalculater;


echo "<h1> Servers Calculater Test !</h1>" ;


 



$server =  '{"CPU": 2, "RAM": 32, "Storage": 100}'  ;  // pass the server like this
$vms = [                                            // pass VMs as Array 
        ["CPU"=> 0, "RAM"=> 16, "Storage"=> 10],  
        ["CPU"=> 1, "RAM"=> 16, "Storage"=> 10], 
        ["CPU"=> 21, "RAM"=> 32, "Storage"=> 100] 
      ];


$server =  json_decode($server) ; //make object $server
/*------------------------------*/
//print_r($server) ; die();

 $serv = new ServersCalculater() ; 

$servernumber = $serv->calculate($server,$vms);  
 

?>


<hr><?= 'You need => '. $servernumber  .' servers for all this VMs'?>