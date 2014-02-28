<?php
// Set the page title and include the HTML header.
$page_title = 'Admin';
include './include/header.inc';
?>

<div class="container">

	<h1>Administration Page <?php echo "<small> (" .getAdminStatus() .")</small>"?></h1>
<hr>
</div>




<div class="container">
<table class="table table-hover table-striped ">
      <thead>
        <tr>
          <th>#</th>
          <th>User Name</th>
          <th>Type</th>
          <th>Creation Date</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>id</th>
          <th>Action</th>	
        </tr>
      </thead>
      <tbody>

  <?php

$query = "SELECT id, first_name, last_name, user_name, type , created ,password FROM users";

$result = mysql_query( $query ); // Run the query. should return true if a result resource is returned.

if ( $result ) { // If it ran OK, display the records.

	$i = 1;
	// Fetch and print all the records.
	//echo "<ol>";
	while ( $row = mysql_fetch_array( $result, MYSQL_ASSOC ) ) {

		echo "<tr>";  //start row
		echo  "<td>";
		echo $i;
		echo "</td>";
				
		echo  "<td>";
		echo $row["user_name"];
		echo "</td>";
		
		echo  "<td>";
		echo $row["type"];
		echo "</td>";

		echo  "<td>";
		echo $row["created"];
		echo "</td>";
		
		echo  "<td>";
		echo $row["first_name"];
		echo "</td>";
		
		echo  "<td>";
		echo $row["last_name"];
		echo "</td>";

		echo  "<td>";
		echo $row["id"];
		echo "</td>";



		echo  "<td>";
		if (getAdminStatus()=='you are an admin') {
			echo " <a class='' href='./edit.php?id="  .  $row["id"]    ."'>Edit</a>" ."&nbsp;"  ." <a class='confirm' href='./delete.php?id="  .  $row["id"]    ."'>Delete</a>";
		} else {

			echo " <a class='disabled' href='./edit.php?id="  .  $row["id"]    ."'>Edit</a>" ."&nbsp;"  ." <a class='disabled' href='./delete.php?id="  .  $row["id"]    ."'>Delete</a>";
		}
		
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
