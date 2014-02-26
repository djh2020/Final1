<?php #db_config_inc.php

	define("DB","djhart");
	define("USER","djhart");
	define("PASS","djhart");

	define("HOST", "localhost:8888");
	define("TABLE_PREFIX","");
	$dbconn = @mysql_connect(HOST,USER,PASS,TRUE) or die("error= could not connect to db" .DB);
	$dbconn = mysql_select_db(DB);
	if (!$dbconn) {
		
		echo "could not connect to database" .DB;
		exit;
	} else {
			//echo "you are connected to " .DB;
		
	}


 		?>