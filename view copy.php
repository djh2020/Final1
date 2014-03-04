<?php
// Set the page title and include the HTML header.
$page_title = 'View';
include './include/header.inc';



?>
<div class="container">

	<h1>View</h1>
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
          <th>Link</th>
          </tr>
      </thead>
      <tbody>

  <?php

$query = "SELECT id, status, start_date, end_date, description , created FROM surveys";

$result = mysql_query( $query ); // Run the query. should return true if a result resource is returned.

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

		echo  "<td>";
		echo " <a class='enabled' href='./view_survey_details.php?id="  .  $row["id"]    ."'>Survey Details</a>";
		echo "</td>";
		echo "</tr>";  // end row

		//echo "<li><div id='"  .$i     ."'>". $row["user_name"] .",". $row["first_name"] .",". $row["last_name"] .",". $row["type"] ."</div></li>";
		$i++;
	}
	
	mysql_free_result( $result ); // Free up the resources.

} else { // If it did not run OK.
	echo '<p>The user table could not be displayed due to a system error. We apologize for any inconvenience.</p><p>' . mysql_error() . '</p>';
}

mysql_close(); // Close the database connection.
echo "</tbody>";
    echo "</table>";
?>






</div>







<?php

include './include/footer.inc';

?>