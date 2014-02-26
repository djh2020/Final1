<?php
// Set the page title and include the HTML header.
$page_title = 'registration Complete!';
include './include/header.inc';
			
			if(isset($_SESSION['sess_f_name'])){
				echo "Welcome ". $_SESSION['sess_f_name'] . " " . $_SESSION['sess_l_name']. " thank you for registering\n";
				echo "Details were emailed to " .$_SESSION['sess_email'];
				//print_r ($_SESSION);
			}else{
				//should never get here
				header( "Location: http://".$_SERVER['HTTP_HOST'].dirname( $_SERVER['PHP_SELF'] )."/"."index.php" );
				
				//print_r ($_SESSION);
			}
			
			?>