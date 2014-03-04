<?php
// Set the page title and include the HTML header.
$page_title = 'Home';
include './include/header.inc';

?>


<div class="container">
<section class="jumbotron">
				
					<h1>Build your own Survey</h1>
					<p>
						Build, customize and publish your own survey quickly and easily.  We provide quick and easy way to create and automatically evaluate your web surveys on any possible subject.
					</p>
					
			
			</section>
				</div>
			<!--End Jumbotron-->

	<div class="container main text-center">

				<!-- Three columns of text below the carousel -->
				<div class="row">
					<div class="col-sm-3">
						<img class="img-responsive center-block" src="images/glasses.png" alt="Generic placeholder image">
						<br />
						<h2>View</h2>
						
						<p>
							View current survey results, subscibe to an out-dated RSS feed and more....</p>
						<p>
							<a class="btn btn-default" href="./view.php" role="button">View details &raquo;</a>
						</p>
					</div><!-- /.col-lg-4 -->
					<div class="col-sm-3">
					<img class="img-responsive center-block" src="images/hammer.png" alt="Generic placeholder image">
						<br />
						<h2>Build</h2>
						<p>
						Build your own survey, define your own questions, set a start and end date.</p>
						<p>
							<a class="btn btn-default" href="./build.php" role="button">View details &raquo;</a>
						</p>
					</div><!-- /.col-lg-4 -->
					<div class="col-sm-3">
						<img class="img-responsive center-block" src="images/chalk-board.png" alt="Generic placeholder image">
						<br /><h2>Participate</h2>
						<p>
							Complete a survey, make your vote count.
						</p>
						<p>
							<a class="btn btn-default" href="./participate.php" role="button">View details &raquo;</a>
						</p>
					</div><!-- /.col-lg-4 -->
					<div class="col-sm-3">
						<img class="img-responsive center-block" src="images/hat.png" alt="Generic placeholder image">
						<br /><h2>Admin</h2>
						<p>
							Change user first and last names, promote users to administrators.</p>
						<p>
							<a class="btn btn-default" href="./admin.php" role="button">View details &raquo;</a>
						</p>
					</div><!-- /.col-lg-4 -->
				</div><!-- /.row -->
			</div>



<?php

include './include/footer.inc';

?>