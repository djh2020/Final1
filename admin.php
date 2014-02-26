<?php
// Set the page title and include the HTML header.
$page_title = 'Admin';
include './include/header.inc';
?>

<div class="container">

	<h1>Admin</h1>
<hr>
</div>


<?

if ($userLevel) {

				if 
					($userLevel == 'admin')  {

					echo "you are an admin";
				} else {

					echo "you are a user";
				}

} else {

		echo "you are not logged in";

}

?>

<!--

php below


-->





<?php
include './include/footer.inc';

?>