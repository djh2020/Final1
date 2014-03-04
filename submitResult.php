<?php
session_start();
ob_start();
$page_title = 'Edit!';
//include './include/header.inc';
require_once './include/db_connect.php';
require_once('helper.php');
// update responses table  with survey id and user id and email.
// user returned id (reponses id) to update the response_answers table


//  create records in response_anaswers table as follows

//  response_id (obtained above)
// question id (from $get)
// //answer id ????  do'n see why this is required.
// text from $get

echo "<pre>";
print_r($_GET);
print_r($_SESSION);

echo "</pre>";

echo "survey id is " .$_GET['survey_id'] ;



// step 1 - create an entry in the reponses table.

// get user id

if ( $_SESSION['sess_userID'] ) {   

		$userArray = getUserInfo($_SESSION['sess_userID']);  // Get all user information
		echo "<pre>";
		print_r($userArray);
		echo "</pre>";
		createEntryInResponseTable($userArray[0]["id"],   $_GET['survey_id']       ,$userArray[0]["email_address"]);  // create entry in response table


						//  need id number from result.....

						

	}  else {

		echo "No user ID session found";

	}

function createEntryInResponseTable ($userID,$surveyID,$userEmail="no email address provided") {

				  			$success = FALSE;

				  			$query = "INSERT INTO `responses` (`id`,  `users_id`, `survey_id`, `email`, `created`, `modified`) VALUES (NULL,'"  .$userID ."','"   .$surveyID  ."','"  .$userEmail ."',"  ." now(), now());";

				  			$result = @mysql_query( $query );

						  			if ($result)  {

						  						echo $query;
						  						echo "<br>";
						  						echo "last id is" ;
						  						echo mysql_insert_id();

						  			} else {

						  				echo "insert Failed";
						  			}


				  			
				  			

						}


//get survey id




?>