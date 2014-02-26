<?php
// Set the page title and include the HTML header.
$page_title = 'Goodbye';
include './include/header.inc';
?>

<div class="container">

	<h1>Goodbye</h1>

</div>


<?php
if(isset($_SESSION['sess_f_name'])){
	echo " <p>You are now logged out! Please come by again.</p>";
	$_SESSION = array();
	session_destroy();
	setcookie('PHPSESSID', '',time()-300, '/',0);	

	echo "<script>";
	echo "location.reload();";
	echo "</script>";

}

?>



<?php
include './include/footer.inc';

?>