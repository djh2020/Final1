<?php
// Set the page title and include the HTML header.
$page_title = 'Survey Details';
include './include/header.inc';

$id = $_GET['id'];

?>
<div class="container">

	<h1>Survey Details</h1>
 <hr />
</div>

<div class="container">

	<h3>Summary</h3>
 <hr />
</div>


<div class="container">
<table class="table table-hover table-striped ">
      <thead>
        <tr>
          <th>Survey Description</th>
          <th>ID</th>
          <th>Status</th>
          <th>Start Date</th>
          <th>End Date</th>
         
          </tr>
      </thead>
      <tbody>

  <?php

$query = "SELECT id, status, start_date, end_date, description , created FROM surveys WHERE id = " . $id;

$result = @mysql_query( $query ); // Run the query. should return true if a result resource is returned.

if ( $result ) { // If it ran OK, display the records.

	$i = 1;
	// Fetch and print all the records.
	//echo "<ol>";
	while ( $row = mysql_fetch_array( $result, MYSQL_ASSOC ) ) {

		echo  "<td>";
		echo $row["description"];
		echo "</td>";
		
		echo  "<td>";
		echo $row["id"];
		echo "</td>";

		echo  "<td>";
		echo $row["status"];
		echo "</td>";
		
		echo  "<td>";
		echo $row["start_date"];
		echo "</td>";
		
		echo  "<td>";
		echo $row["end_date"];
		echo "</td>";

		//echo "<li><div id='"  .$i     ."'>". $row["user_name"] .",". $row["first_name"] .",". $row["last_name"] .",". $row["type"] ."</div></li>";
		$i++;
	}
	
	mysql_free_result( $result ); // Free up the resources.

} else { // If it did not run OK.
	echo '<p>The user table could not be displayed due to a system error. We apologize for any inconvenience.</p><p>' . mysql_error() . '</p>';
}

//mysql_close(); // Close the database connection.
echo "</tbody>";
    echo "</table>";
?>




</div>


<div class="container">

	<h3>Questions</h3>
 <hr />
</div>


<div class="container">
<table class="table table-hover table-striped ">
      <thead>
        <tr>
          <th>ID</th>
          <th>Sequence</th>
          <th>Question</th>
          <th>Description</th>
         
          </tr>
      </thead>
      <tbody>

  <?php

$query = "SELECT id, sequence, question, description FROM questions WHERE survey_id = " . $id ." ORDER BY sequence ASC";


//echo $query;

$result = @mysql_query( $query ); // Run the query. should return true if a result resource is returned.

if ( $result ) { // If it ran OK, display the records.

	$i = 1;
	// Fetch and print all the records.
	//echo "<ol>";
	while ( $row = mysql_fetch_array( $result, MYSQL_ASSOC ) ) {

		$questionArray[] = $row;  //build an array of quesitons, used below.

		echo  "<td>";
		echo $row["id"];
		echo "</td>";
		
		echo  "<td>";
		echo $row["sequence"];
		echo "</td>";

		echo  "<td>";
		echo $row["question"];
		echo "</td>";
		
		echo  "<td>";
		echo $row["description"];
		echo "</td>";
		
		
		echo "</tr>";  // end row

		//echo "<li><div id='"  .$i     ."'>". $row["user_name"] .",". $row["first_name"] .",". $row["last_name"] .",". $row["type"] ."</div></li>";
		$i++;
	}
	
	mysql_free_result( $result ); // Free up the resources.

} else { // If it did not run OK.
	echo '<p>The questions table could not be displayed due to a system error. We apologize for any inconvenience.</p><p>' . mysql_error() . '</p>';
}

//mysql_close(); // Close the database connection.
echo "</tbody>";
    echo "</table>";
?>




</div>



<div class="container">

	<h3>Responses</h3>
 <hr />
</div>



  <?php

//get all response answers and put them in an array/  

$query = "SELECT * FROM response_answers";   //



$result = @mysql_query( $query ); // Run the query. should return true if a result resource is returned.

		if ( $result ) { // If it ran OK, continue

			while ( $row = mysql_fetch_array( $result, MYSQL_ASSOC ) ) {   // loop through each reponse answer

				$responseAnswersArray[] = $row;

			}   //finish builind array

			mysql_free_result( $result ); // Free up the resources.
			$query = NULL;  // clear query

			$query = "SELECT id, survey_id, users_id, email FROM responses WHERE survey_id = " . $id ;  //get user_id's of people that have responded.

			$result = @mysql_query( $query ); // Run the query. should return true if a result resource is returned.


					if ( $result ) { // If it ran OK, display the records.

						//display each user id and their answers

						while ( $row = mysql_fetch_array( $result, MYSQL_ASSOC ) ) {   // loop through each user id

								$id = $row["users_id"];
								//echo $id;
								$userArray = getUserInfo($id);
								//print_r($userArray);
								//echo $userArray[0]["first_name"];
								echo "<div class='container'>";
								echo  "<h4>Name: " .$userArray[0]["first_name"] ." " .$userArray[0]["last_name"] ."</h4>";
								echo "</div>";

								echo '<div class="container">';
									echo '<table class="table table-hover table-striped ">';
								     echo '<thead>';
								       echo '<tr>';
										       echo   '<th>Question</th>';
										        echo  '<th>Response</th>';
										    echo  '</tr>';
								     echo '</thead>';
								     echo '<tbody>';

								     //loop through each question / response

								     foreach ($questionArray as $value) {


												     	echo "<tr>";
												     	echo  "<td>";
															echo $value["question"];
															echo "</td>";


															echo  "<td>";
															for ($i=0;$i<count($responseAnswersArray);$i++)   {


																		if ($responseAnswersArray[$i]["question_id"]==$value["id"])
																		echo $responseAnswersArray[$i]["text"];

															}

															//echo $responseAnswersArray["question_id"==1];
															echo "</td>";			
															echo "</tr>";

								     }  //finsish  loop
										

											echo "</tbody>";
   										echo "</table>";
								     	# code...




   							//debugging

   							/*			
								echo "<br><pre>";
								print_r($responseAnswersArray);


								echo "</pre>";
								echo "<br><pre>";

								print_r($questionArray);
								echo "</pre>";

								*/





								//echo array_search(["question_id"] => 1, $responseAnswersArray); 

								//end debugging
						}


					}  else {
							echo "unable to get user ids from response table";
					}

		} else {

			echo "unable to retirve all respnses and put them into an array";

		}

mysql_close(); // Close the database connection.

?>




</div>



<?php

include './include/footer.inc';

?>