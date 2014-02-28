<?php
session_start();
ob_start();
$page_title = 'Edit!';
include './include/header.inc';
require_once './include/db_connect.php';
require_once('helper.php');

//print_r( $_GET );

$id = $_GET['id'];

$dbaction = (isset($_POST['dbaction']) ? $_POST['dbaction'] : 'show');  




if ($dbaction=='show') {   //show form with data.
	
	
	$query = "SELECT * FROM users WHERE id = " . $id;
	$result = mysql_query( $query ) or die( 'Could not find the user.' .$id );

		if ( $result ) { // If it ran OK, display the records.
			$row = mysql_fetch_array( $result, MYSQL_ASSOC );
			//print_r( $row );

			echo '<div class="container">';
			echo '<div class="row ">';
			echo '<div class="col-sm-6 col-sm-offset-3 ">';
			echo '<form name="form1" method="post" action="./edit.php">';
			echo '<fieldset>';
			echo '<div>';
			echo '<div class="form-group">';
      echo  '<input type="text"  name="First_Name" class="form-control" value="' .$row['first_name']    .'">';
      echo  '</div>';
      echo '<div class="form-group">';
      echo  '<input type="text"  name="Last_Name" class="form-control" value="' .$row['last_name']    .'">';
      echo  '</div>';
      

      echo '<div class="radio-inline">';
  		echo		'<label>';
    	echo '<input type="radio" name="optionsRadios" id="optionsRadios1" value="user" checked>';
    	echo "User";
  		echo '</label>';
			echo  '</div>';
			echo   '<div class="radio-inline">';
  		echo   '<label>';
    	echo '<input type="radio" name="optionsRadios" id="optionsRadios2" value="admin">';
    	echo  'Administrator';
  		echo  '</label>';
			echo  '</div>';
                  
			echo '</div>';
			echo '</fieldset>';

			echo '<button type="submit" class="btn btn-success btn-block" >';
			echo 'Submit Changes';
			echo '</button>';
			echo '<input type="hidden" name="dbaction" value="update" />';   //used to determine action to take.
			echo '<input type="hidden" name="databaseid" value="' .$id  .'" />';   //used to determine action to take.
			echo '</form>';
			echo '</div>';
			echo '</div>';

			echo '</div>';

		} else { // If it did not run OK.
			
			echo '<p>The user information. We apologize for any inconvenience.</p><p>' . mysql_error() . '</p>'; 
		}
		mysql_close(); // Close the database connection either way.
} elseif ($dbaction=='update') {  //update the values

	//print_r($_POST);
	//define post vars and sanitize.
	$first_name = mysql_real_escape_string($_POST['First_Name']);
	$last_name = mysql_real_escape_string($_POST['Last_Name']);
	$type = ($_POST['optionsRadios']);
	$id = ($_POST['databaseid']);

	$query = "UPDATE users SET first_name = '".$first_name."', last_name ='".$last_name."', type = '".$type."' WHERE id = ".$id ;

	$result = mysql_query($query);
	

	if($result){
		echo $result;
		//echo "<h1>Thank you for updating the user</h1>";
		$_SESSION['edit_uid'] = $id;
		
		header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/"."admin.php");
		mysql_free_result ($result); // Free up the resources.	
		exit();
	}else{
		echo "<p>There has been an error in updating the database:  ".mysql_error()."</p>";
		echo $query;
		//echo $id;
	};
	
	
}













/*if ( getAdminStatus()=='you are an admin' ) {



	if ( $_GET['id'] ) { //echo "we have an id";

		$id = $_GET['id'];

		// build the query
		$query = "DELETE FROM users WHERE id = " . $id;

		$result = mysql_query( $query ) or die( 'Could not delete the user.' );
		if ( $result ) {
			header( "Location: http://".$_SERVER['HTTP_HOST'].dirname( $_SERVER['PHP_SELF'] )."/"."admin.php" );
			exit();
		}else {
			echo "Something went horribly wrong when attempting to delete ID " . $id ."<br/>";
		}

	} else {   // echo "we don't have an id";



	}


} else {
	//header( "Location: http://".$_SERVER['HTTP_HOST'].dirname( $_SERVER['PHP_SELF'] )."/include/fu.html" );

	include('./include/fu.html');

}






*/


include './include/footer.inc';

?>


