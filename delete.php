<?php
session_start();
ob_start();
require_once('./include/db_connect.php');

print_r( $_GET );


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





?>
