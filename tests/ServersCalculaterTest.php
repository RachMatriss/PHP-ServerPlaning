<?php  declare(strict_types=1);
require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use src\ServersCalculater;

 
/**
 * @coversDefaultClass src\ServersCalculater
 */
 
final class ServersCalculaterTest extends TestCase
{

/**
*@covers ::calculate
*@covers ::chekServer 
*@covers ::checkVms 
*/
 public function testCalculater():void
{   

$server = '{"CPU": 2, "RAM": 32, "Storage": 100}' ;
$vms = [
        ["CPU"=> 1, "RAM"=> 16, "Storage"=> 10], 
        ["CPU"=> 1, "RAM"=> 16, "Storage"=> 10], 
        ["CPU"=> 2, "RAM"=> 32, "Storage"=> 100] 
      ];
    
    $server =  json_decode($server) ;

    $servercalculter = new ServersCalculater() ; 
	/*------------------------------*/
	$number_server =  $servercalculter->calculate($server,$vms) ;
	$this->assertEquals( 2,$number_server);
}

/**
* @covers  ::checkVms
* @coversc
**/

public function testChekvms():void
{    
	$vms = [
        ["CPU"=> 0, "RAM"=> 16, "Storage"=> 10], // pass 0 here 
        ["CPU"=> 1, "RAM"=> 16, "Storage"=> 10], 
        ["CPU"=> 1, "RAM"=> 1, "Storage"=> 100] 
      ];

  $server =  '{"CPU": 2, "RAM": 32, "Storage": 100}' ;
	$server = json_decode($server) ; 

	$servercalculter = new ServersCalculater() ; 

      $vms = $servercalculter->checkVms($server, $vms) ;
      $this->assertIsArray($vms,'Test Ok !') ;
      $this->expectOutputString(PHP_EOL.'Error Processing: This is empty virtual Machine=> {"CPU":0,"RAM":16,"Storage":10}');
}

/**
*@covers ::chekServer 
*/

public function testChekServer():void
{
	$servercalculter = new ServersCalculater() ;

$server = '{"CPU": 2, "RAM": 32, "Storage": 100}' ;
$vms = [
        ["CPU"=> 1, "RAM"=> 16, "Storage"=> 10], 
        ["CPU"=> 5, "RAM"=> 16, "Storage"=> 10], 
        ["CPU"=> 2, "RAM"=> 32, "Storage"=> 100] 
      ];
    
    $server =  json_decode($server) ;
    
    $vm = $servercalculter->chekServer($server,$vms) ;

   $this->assertIsArray($vm ,'test is ok !') ;
}

/* END CLASS*/
}
?>