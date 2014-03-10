<?php
session_start();
ob_start();

if(isset($_POST['user_name'])){

	require_once('./include/db_connect.php');

	//Define post fields into simple variables	

	$name = $_POST['user_name'];

	$pass = ($_POST['user_pass']);

	//$query = "SELECT * FROM users WHERE user_name = '$name' AND password = '$pass'";
	$query = "SELECT * FROM users WHERE user_name = '$name'"; 

	$result = mysql_query($query); // Run the query.

				if ($result) { // User Found

					// Get Details
				$row = mysql_fetch_array($result,MYSQL_NUM);
								if($row){
									$_SESSION['sess_username'] = $row[5];
									$_SESSION['sess_f_name'] = $row[2];
									$_SESSION['sess_l_name'] = $row[3];
									$_SESSION['sess_email'] = $row[4];
									$_SESSION['sess_userlevel'] = $row[1];
									$_SESSION['sess_userID'] = $row[0];
									$hash = $row[6];
										//	if (password_verify($pass, $hash)) {  //password is valid  $pass = what was provided as input, $hash is what is stored in db
										if (md5($pass) == $hash) {  //password is valid  $pass = what was provided as input, $hash is what is stored in db
											//print_r($row);
											//print_r($_SESSION);
											header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/"."index.php");
											mysql_free_result ($result); // Free up the resources.	
											exit();
										} else{
												echo "username and password did not match";
												unset($_POST['Submit']);
												//header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/"."index.php");
											}  // end password checks out

								}  // end if ($row)

								echo "username not found";

					}  else //end if resullt

					echo '<p>The login result could not be displayed due to a system error. We apologize for any inconvenience.</p><p>' . mysql_error() . '</p>'; 

								
				} 


	mysql_close(); // Close the database connection.

	//header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/"."login.php");




?>



