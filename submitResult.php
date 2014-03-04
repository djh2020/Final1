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





// step 1 - create an entry in the reponses table.

// get user id

if ( $_SESSION['sess_userID'] ) {

		$userArray = getUserInfo($_SESSION['sess_userID']);
		echo "<pre>";
		print_r($userArray);
		echo "</pre>";
		
		echo $userArray[0]["id"];

	}  else {

		echo "No user ID session found";

	}




//get survey id




?>