
<?php


date_default_timezone_set( 'America/Los_Angeles' ); //Gets rid of timezone error




function displayArray( $arrayName ) {  //handy for debugging


  echo "<br>";
  echo "<pre>";
  print_r( $arrayName );
  echo "</pre>";
  echo "<br>";

}


function getRsponseAndAnswerTable() {

  $query = "SELECT * FROM response_answers";   //

  $result = @mysql_query( $query ); // Run the query. should return true if a result resource is returned.

  if ( $result ) { // If it ran OK, continue

    while ( $row = mysql_fetch_array( $result, MYSQL_ASSOC ) ) {   // loop through each reponse answer

      $responseAnswersArray[] = $row;

    }   //finish builind array

    return $responseAnswersArray;

  }

}
  function getResponsesTable() {

    $query = "SELECT * FROM responses";

    $result = mysql_query( $query );

    if ( $result ) {   //query worked

      while ( $row = mysql_fetch_array( $result, MYSQL_ASSOC ) ) {

        $responses[] = $row;

      }


    } else {

      echo "an error occurred getting responses";
    }

    return $responses;


  }







  function createEntryInResponseTable( $userID, $surveyID, $userEmail="no email address provided" ) {

    $success = FALSE;  //not used, should return array....

    $query = "INSERT INTO `responses` (`id`,  `users_id`, `survey_id`, `email`, `created`, `modified`) VALUES (NULL,'"  .$userID ."','"   .$surveyID  ."','"  .$userEmail ."',"  ." now(), now());";

    $result = @mysql_query( $query );

    if ( $result ) {

      //echo $query;
      //echo "<br>";
      //echo "last id is" ;
      return mysql_insert_id();   //return the id from the response table.  This is needed for the response_answers table.

    } else {

      return "insert Failed";
    }


  }  //end function


  function updateResponseAnswerTable( $responseID, $questionID, $answerString ) {

    $success = FALSE;  //not used, should return array....

    $query = "INSERT INTO `response_answers` (`id`,  `response_id`, `question_id`, `text`, `created`, `modified`) VALUES (NULL,'"  .$responseID ."','"   .$questionID  ."','"  .$answerString ."',"  ." now(), now());";

    $result = @mysql_query( $query );

    if ( $result ) {

      $success = TRUE;
      //echo $query;
      //echo "<br>";
      //echo "last id is" ;
      //return mysql_insert_id();   //return the id from the response table.  This is needed for the response_answers table.

    } else {

      $success = FALSE;
    }

    return $success;
  }

  function getState( $thisPage ) {      //used to control class on nav bar, active / inactive determines whether the link is highlighted.
    $retVal = ( $_SERVER['PHP_SELF'] == $thisPage ) ? "active" : "inactive" ;
    return $retVal;

  }

  function isAdmin() {
    if ( isset( $_SESSION['sess_userlevel'] ) ) {    //Use is logged in with a session

      return $_SESSION['sess_userlevel'];  //return user or admin
    }
  }


  function getUserInfo( $userId ) {

    $query = "SELECT * FROM users WHERE id ='" .$userId ."'";

    $result = mysql_query( $query );

    if ( $result ) {   //query worked

      while ( $row = mysql_fetch_array( $result, MYSQL_ASSOC ) ) {

        $userInfo[] = $row;

      }



    }

    return $userInfo;

  }


  function getSurveyInfo( $surveyID ) {

    $query = "SELECT id, status, start_date, end_date, description , created FROM surveys WHERE id = " . $surveyID;

    $result = @mysql_query( $query ); // Run the query. should return true if a result resource is returned.

    if ( $result ) { //query worked


      while ( $row = mysql_fetch_array( $result, MYSQL_ASSOC ) ) {

        $surveyInfo[] = $row;

      }

    }
    mysql_free_result( $result ); // Free up the resources.
    return $surveyInfo;
  }


  function getSurveyQuestions( $surveyID ) {

    $query = "SELECT id, sequence, question, description FROM questions WHERE survey_id = " . $surveyID ." ORDER BY sequence ASC";

    $result = @mysql_query( $query ); // Run the query. should return true if a result resource is returned.

    if ( $result ) { // If it ran OK, display the records.

      while ( $row = mysql_fetch_array( $result, MYSQL_ASSOC ) ) {

        $questionArray[] = $row;  //build an array of quesitons, used below.

      }

    }
    mysql_free_result( $result ); // Free up the resources.
    return $questionArray;

  }  //end function


  function getPotentialAnswers( $questionID ) {

    $query = "SELECT id, question_id, sequence, response_type, response_value FROM answers WHERE question_id = " . $questionID ;

    $result = @mysql_query( $query ); // Run the query. should return true if a result resource is returned.

    if ( $result ) { // If it ran OK, display the records.

      while ( $row = mysql_fetch_array( $result, MYSQL_ASSOC ) ) {

        $potentialAnswersArray[] = $row;  //build an array of quesitons, used below.

      }

    }
    mysql_free_result( $result ); // Free up the resources.
    return $potentialAnswersArray;

  }  //end function









  function getStatusArray()  //see if someone has a session
    {


    if ( isset( $_SESSION['sess_f_name'] ) ) {  //if they are logged in or registered

      //$out['link'] = '<a class="" href="./goodbye.php">&nbsp;&nbsp; ' .$_SESSION['sess_f_name'] ." " .$_SESSION['sess_l_name'] .' (logout) </a>';
      $out['link'] = '<a class="" href="./goodbye.php">&nbsp;&nbsp; ' .$_SESSION['sess_f_name'] ." " .$_SESSION['sess_l_name'] .' (logout) </a>';
      $out['classState'] = "hidden";
      $out['userLevel'] = isAdmin();

      return $out;

    }else {  //otherwise show this in the top right

      $out['link'] = '<a class="" href="./register.php">&nbsp;&nbsp;Register (New User)</a>';
      $out['classState'] = " ";

      return $out;

    }
  }

  function userExists( $user ) {


    $query = "SELECT * FROM users WHERE user_name ='" .$username ."'";

    $result = mysql_query( $query );

    if ( $result ) {   //query worked

      return mysql_num_rows( $result ) >0;  //TRUE if row count is greater than 1, i.e. user already in the table

    }

  }

  function getAdminStatus() {

    if ( $_SESSION['sess_userlevel'] ) {

      if
      ( $_SESSION['sess_userlevel'] == 'admin' ) {

        $status = "you are an admin";
      } else {

        $status =  "you are a user";
      }

    } else {

      $status = "you are not logged in";

    }
    return $status;

  }



?>
