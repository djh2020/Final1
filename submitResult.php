<?php
session_start();
ob_start();
$page_title = 'Edit!';
//include './include/header.inc';
require_once './include/db_connect.php';
require_once 'helper.php';
// update responses table  with survey id and user id and email.
// user returned id (reponses id) to update the response_answers table
//  create records in response_anaswers table as follows
//  response_id (obtained above)
// question id (from $get)
// //answer id ????  do'n see why this is required.
// text from $get
/*
echo "<pre>";
print_r( $_GET );
print_r( $_SESSION );

echo "</pre>";

echo "survey id is " .$_GET['survey_id'] ;
*/


// step 1 - create an entry in the reponses table.

// get user id

if ( $_SESSION['sess_userID'] ) {

	$userArray = getUserInfo( $_SESSION['sess_userID'] );  // Get all user information
	/*
	echo "<pre>";
	print_r( $userArray );
	echo "</pre>";
	*/
	$responseID = createEntryInResponseTable( $userArray[0]["id"],   $_GET['survey_id']       , $userArray[0]["email_address"] );  // create entry in response table
	//  need id number from result.....
	if ( $responseID && is_numeric( $responseID ) ) {
		// code...
		//echo "ID returned";

		//insert loop for all answers in $_GET
		foreach ( $_GET as $key => $value ) {
			if ( is_numeric( $key ) ) {  //extract only numeric quesiton id's and corresponding answer

				$updateSuccess = updateResponseAnswerTable( $responseID, $key, $value );  //add entry in response_answers table for each answer in $_GET
				echo "Key value is: " .$key  ." and " ." correspnding value is: " .$value;
				echo "<br>";
			} else {

				//skip - not an question_id / answer
			}
			// code...
		}
		echo "completed";
		// redirect to thank you page


	} else {

		echo "Error: No id returned after updating response table";
	}


}  else {

	echo "No user ID session found";

}









?>
