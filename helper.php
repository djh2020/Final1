
<?php


date_default_timezone_set('America/Los_Angeles'); //Gets rid of timezone error  


function getState($thisPage) {      //used to control class on nav bar, active / inactive determines whether the link is highlighted.
  $retVal = ($_SERVER['PHP_SELF'] == $thisPage) ? "active" : "inactive" ;
  return $retVal;

}

function isAdmin()
{
  if(isset($_SESSION['sess_userlevel'])){    //Use is logged in with a session

    return $_SESSION['sess_userlevel'];  //return user or admin
  }  
}




function getStatusArray()  //see if someone has a session
{

        
        if(isset($_SESSION['sess_f_name'])){  //if they are logged in or registered
              
                $out['link'] = '<a class="" href="./goodbye.php">&nbsp;&nbsp; ' .$_SESSION['sess_f_name'] ." " .$_SESSION['sess_l_name'] .' (logout) </a>';
                $out['classState'] = "hidden";
                $out['userLevel'] = isAdmin();
                
                return $out;
             
              }else{
                
                $out['link'] = '<a class="" href="./register.php">&nbsp;&nbsp;Register (New User)</a>';
                $out['classState'] = " ";
                
                return $out;
          
              }
}

function userExists( $user ) {


  $query = "SELECT * FROM users WHERE user_name ='" .$username ."'";

  $result = mysql_query( $query );

  if ( $result ) {   //query worked

    return ( mysql_num_rows( $result ) >0 ) ;  //TRUE if row count is greater than 1, i.e. user already in the table

  }

}


// Output a form
  function draw_form($name, $action, $method = 'post', $parameters = '') {
    $form = '<form name="' . output_string($name) . '" action="' . output_string($action) . '" method="' . output_string($method) . '"';

    if (!is_null($parameters)) $form .= ' ' . $parameters;

    $form .= '>';

    return $form;
  }


 function draw_input_field($name, $value = '', $parameters = '', $type = 'text', $reinsert_value = true) {
    $field = '<input type="' . output_string($type) . '" name="' . output_string($name) . '"';

    if ( (isset($GLOBALS[$name])) && ($reinsert_value == true) ) {
      $field .= ' value="' . output_string(stripslashes($GLOBALS[$name])) . '"';
    } elseif (!is_null($value)) {
      $field .= ' value="' . output_string($value) . '"';
    }

    if (!is_null($parameters)) $field .= ' ' . $parameters;

    $field .= '>';

    return $field;
  }

////
// Output a form password field
  function draw_password_field($name, $value = '', $parameters = 'maxlength="40"') {
    return draw_input_field($name, $value, $parameters, 'password', false);
  }

////
// Output a selection field - alias function for draw_checkbox_field() and draw_radio_field()
  function draw_selection_field($name, $type, $value = '', $checked = false, $parameters = '') {
    $selection = '<input type="' . output_string($type) . '" name="' . output_string($name) . '"';

    if (!is_null($value)) $selection .= ' value="' . output_string($value) . '"';

    if ( ($checked == true) || ( isset($GLOBALS[$name]) && is_string($GLOBALS[$name]) && ( ($GLOBALS[$name] == 'on') || (isset($value) && (stripslashes($GLOBALS[$name]) == $value)) ) ) ) {
      $selection .= ' CHECKED';
    }

    if (!is_null($parameters)) $selection .= ' ' . $parameters;

    $selection .= '>';

    return $selection;
  }



?>