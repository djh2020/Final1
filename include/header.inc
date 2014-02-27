<?php
session_start();
ob_start();
require_once('db_connect.php');
require_once('helper.php');

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $page_title; ?></title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/modal.css" rel="stylesheet">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
       <div class="navbar navbar-static-top navbar-inverse " role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Survey's R Us</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li <?php echo "class='" .getState('/Final1/index.php') ."'" ?>><a href="./index.php">Home</a></li>
            <li <?php echo "class='" .getState('/Final1/view.php') ."'" ?>><a href="./view.php">View</a></li>
            <li <?php echo "class='" .getState('/Final1/build.php') ."'" ?>><a href="./build.php">Build</a></li>
            <li <?php echo "class='" .getState('/Final1/admin.php') ."'" ?>> <a href="./admin.php">Admin</a></li>
          </ul>
          <form  action="./login.php" method="post" class="navbar-form navbar-right" role="form">
                <div class="form-group">
                  <!--<input type="text" placeholder="User Name" class="form-control">-->
                  <?
                    $data = getStatusArray();
                    $link =  $data['link'];
                    $classState =  $data['classState'];
                    $userLevel = $data['userLevel'];
                    
                  ?>
                  <input <?php echo "class='form-control " .$classState           ."'" ?> type="text" placeholder="Username" name="user_name">
                </div>
                <div class="form-group">
                  <input <?php echo "class='form-control " .$classState           ."'" ?> type="password" placeholder="Password" name="user_pass">
                </div>
                <button type="submit" name="Submit" <?php echo "class='btn btn-success " .$classState           ."'" ?>>


                  Sign in
                </button>
                <!--<a class="" href="#registrationModal">&nbsp;&nbsp;Register (New User)</a>-->
                <!--<a class="" href="./register.php">&nbsp;&nbsp;Register (New User)</a>-->
                 
                    <?php echo "<strong>" .$link ."</strong>"?> 
                 
                 
               

                    

              </form>

       </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </div><!-- /.navbar -->

      

	<!-- PAGE SPECIFIC CONTENT STARTS HERE. -->