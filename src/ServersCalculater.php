<?php 
namespace src;

use Exception; 

/**
 * 
 */
class ServersCalculater
{
 
  /**
  ** calculate function 
  ** return number servers needed! (int number)
  **/
    public function calculate($server,$vms): int
    {   // calculate the number of servers needed !
        $number_servers= 0; define('SERVER', serialize($server) ); 
        $vms = $this->checkVms($server, $vms) ; 
  
      while ( !empty($vms) ) {
        $vms = $this->chekServer($server,$vms) ; 
        $server = unserialize( SERVER)  ;
        $number_servers= $number_servers +1 ;  
      }
      return $number_servers ; 
    }

   /**
   ** check vms function // 
   ** if vm is empty or big then server   
   **  return vms array
   ***/
    public function checkVms($server, $vms)
    {   
      foreach ($vms as $kye => $vm ) {   
      // check if vm is empty or bing then server   
      try {  
        if (!empty($vm['CPU']) && !empty($vm['RAM']) && !empty($vm['Storage']) ) {
          if ( ($vm['CPU'] > $server->{'CPU'}) || ($vm['RAM'] > $server->{'RAM'}) || ($vm['Storage'] > $server->{'Storage'}) ){ 
              unset($vms[$kye]);  // delet this VM 
            }
          }else{  
            throw new Exception("This is empty virtual Machine=> ".json_encode($vm));     
          }

        } catch (Exception $e) {
              echo PHP_EOL ."Error Processing: ".$e->getMessage() ; 
        }

      }
      
      return $vms ; 
    }

/**
**
** chekserver function 
**/
    public function chekServer($server,$vms)
    {  
      // return the soum of all vms on one array 
     foreach ($vms as $kye=> $vm ) {

       if(($server->{'CPU'} >= $vm['CPU']) && ($server->{'Storage'} >= $vm['Storage']) && ($server->{'RAM'} >= $vm['RAM']) )  
         { 
            $server->{'CPU'}  = $server->{'CPU'} - $vm['CPU'] ;
            $server->{'RAM'}  = $server->{'RAM'} - $vm['RAM'] ;
            $server->{'Storage'}  = $server->{'Storage'} - $vm['Storage'] ; 
            unset($vms[$kye]) ;
          }
    
       } 
        return $vms  ; 
    }

}

?>