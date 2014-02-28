<?php
// Set the page title and include the HTML header.
$page_title = 'Register!';
include './include/header.inc';

?>

<div class="container">
<h1>User Registration</h1>
      <hr />
</div>


<div class="container">
<?php
if ( isset( $_POST['submit'] ) ) { // Handle the form.

	$message = NULL;
	$prefix = "You forgot to enter in your ";

	$first_name = mysql_real_escape_string( $_POST['fname'] );
	$last_name = mysql_real_escape_string( $_POST['lname'] );
	$email_address = mysql_real_escape_string( $_POST['email_address'] );
	$user_name = mysql_real_escape_string( $_POST['username'] );
	$password_1 = mysql_real_escape_string( $_POST['password_1'] );
	$password_2 = mysql_real_escape_string( $_POST['password_2'] );
	$passhint = mysql_real_escape_string( $_POST['passhint'] );
	$ip = $_SERVER['REMOTE_ADDR'];




	// Check for a name.
	if ( strlen( $first_name ) > 0 ) {
		$fname = TRUE;
	} else {
		$fname = FALSE;
		$message .= 'first name';
	}

	// Check for a name.
	if ( strlen( $last_name ) > 0 ) {
		$lname = TRUE;
	} else {
		$lname = FALSE;
		$message .= ', last name';
	}

	// Check for an email address.
	if ( strlen( $email_address ) > 0 ) {
		$email = TRUE;
	} else {
		$email = FALSE;
		$message .= ', email address';
	}

	// Check for a username.
	if ( strlen( $user_name ) > 0 ) {
		$username = TRUE;
	} else {
		$username = FALSE;
		$message .= ', user name';
	}

	// Check for a password and match against the confirmed password.
	if ( strlen( $password_1 ) > 0 ) {

		//perform string compare
		$pass_test = strcasecmp( $password_1, $password_2 );
		if ( $pass_test != 0 ) {
			$password = FALSE;
			$message .= '<p class="warn">Password did not match the confirmed password!</p>';
		}else {
			$password = TRUE;
		}


	} else {
		$password = FALSE;
		$message .= ', your password!';
	}

	// check if user already exists


	if (userExists( $user_name )) {
		$exists = TRUE;
		$message .= "<p class=\"warn\"> User Name Already Exists </p>";
		

	} else {
		$exists = FALSE;
		

	}



	if ( $fname && $lname && $email && $username && $password && !$exists ) { // If everything's okay.
		// Register the user.
		//$password_1 = md5( $password_1 );
		$password_1 = password_hash($password_1, PASSWORD_DEFAULT);






		$query = "INSERT INTO users (first_name, last_name, user_name, password, hint, email_address, created) VALUES('$first_name', '$last_name', '$user_name','$password_1','$passhint', '$email_address', now())";

		$result = mysql_query( $query );

		if ( $result ) {


			// Send an email.
			//$body = "Thank you for registering with our site!\nYour username is ". $_POST['user_name'] ." and your password is ". $_POST['password_1'] .".\n\nSincerely,\nUs";
			//mail( $email_address, 'Thank you for registering!', $body, 'From: wts@uw.com' );
			
			$_SESSION['sess_username'] = $user_name;
			$_SESSION['sess_f_name'] = $first_name;
			$_SESSION['sess_l_name'] = $last_name;
			$_SESSION['sess_email'] = $email_address;
			$_SESSION['sess_userlevel'] = "user";  //default status set in the db after registration
			
			header( "Location: http://".$_SERVER['HTTP_HOST'].dirname( $_SERVER['PHP_SELF'] )."/"."complete.php" );
			exit();

		}else {

			echo "<p>There has been an error in updating the database:  ".mysql_error()."</p>";

		};


	} else {
		$message .= '<p class="warn">Please try again.</p>';
	}

}



// Print the error message if there is one.
if ( isset( $message ) ) {
	echo '<p class="warn"> You forgot to enter in your '. $message  .'</p>';
}
?>
<p>To access the private materials, please become a member by submitting your name and E-mail address. A link to the materials will be sent to your E-mail address. Sign up!</p>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<fieldset>

<legend>Enter your information in the form below:</legend>

<div id="name">
	<label>First Name:</label> <input type="text" name="fname" size="20" maxlength="20" value="<?php if ( isset( $_POST['fname'] ) ) echo $_POST['fname']; ?>" />
</div>

<div id="name">
	<label>Last Name:</label> <input type="text" name="lname" size="20" maxlength="20" value="<?php if ( isset( $_POST['lname'] ) ) echo $_POST['lname']; ?>" />
</div>

<div id="email">
	<label>Email Address:</label><input type="text" name="email_address" size="20" maxlength="60" value="<?php if ( isset( $_POST['email_address'] ) ) echo $_POST['email_address']; ?>" />
</div>

<div id="username">
	<label>User Name:</label> <input type="text" name="username" size="20" maxlength="40" value="<?php if ( isset( $_POST['username'] ) ) echo $_POST['username']; ?>" />
</div>

<div id="pass">
	<label>Password:</label> <input type="password" name="password_1" size="20" maxlength="40" />
</div>

<div id="pass">
	<label>Confirm Password:</label> <input type="password" name="password_2" size="20" maxlength="40" />
</div>

<div id="passhint">
	<label>Password Hint:</label> <input type="text" name="passhint" id="passhint" size="20" maxlength="128" />
</div>

</fieldset>

<div ><input type="submit" name="submit" value="Submit Information" /></div>
<div ><input type="reset" name="clear" value="Clear Form" /></div>

</form><!-- End of Form -->

</div>  <!--container-->

<?

include './include/footer.inc';

?>
