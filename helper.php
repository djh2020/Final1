
<?php


date_default_timezone_set('America/Los_Angeles'); //Gets rid of timezone error  


function getState($thisPage) {      //used to control class on nav bar, active / inactive determines whether the link is highlighted.
  $retVal = ($_SERVER['PHP_SELF'] == $thisPage) ? "active" : "inactive" ;
  return $retVal;

}


function getStatusArray()  //see if someone has a session
{

        
        if(isset($_SESSION['sess_f_name'])){
              
                $out['link'] = '<a class="" href="./goodbye.php">&nbsp;&nbsp; ' .$_SESSION['sess_f_name'] ." " .$_SESSION['sess_l_name'] .' (logout) </a>';
                $out['classState'] = "hidden";
                
                return $out;
             
              }else{
                
                $out['link'] = '<a class="" href="./register.php">&nbsp;&nbsp;Register (New User)</a>';
                $out['classState'] = " ";
                
                return $out;
          
              }
}





?>