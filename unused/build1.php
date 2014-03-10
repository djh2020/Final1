<?php
// Set the page title and include the HTML header.
$page_title = 'Build';
include './include/header.inc';

?>
<div class="container">

	<h1>Build</h1>
 <hr />
</div>


<?php

//displayArray($_GET);




 if ($_GET['action']=='show'  || !isset($_GET['action']) )  {


 			echo buildFormTemplate("show");


 } elseif ($_GET['action']=='planning') {

 			echo buildFormTemplate("planning");


 }  elseif ($_GET['action']=='addQuestion') {

 			//create survey with start and end dates then prompt for questions
 			//  ?description=&start_date=2014-03-04&end_date=2014-03-06&action=addQuestion


 			if (isset($_GET['description']) &&  $_GET['description'] != '')   {  //add dates 

 				//update database
 				//echo buildFormTemplate("addQuestion");  //build add question form
 				echo "update db and add questions";

 			} else  {

 					echo buildFormTemplate("planning");
 					echo "<p> Warning, please provide a description </p>";

 			}




 }else {

 	echo "undefined action specified";
 	 

 }







//echo buildFormTemplate("show");
// check post


// if status = new, show creation button start date / end date and description input box  plus any questions


// if action = planning, show survey description / status / date etc.  AND add question button with "text" or "Radio" option  (if radio selected display "how many box 1 - 4 ")



// if action = add text question - show input box for question and sequence number?

				// then show again

// if action = add radio - provide text input for quesitons


//if action = finished  - add survey to DB and complete



// default initial state

function buildFormTemplate ($formStatus) {

	
	$formTemplate = "<div class=\"container\">\n<form class=\"form-horizontal\" role=\"form\" action=\""  .$_SERVER['PHP_SELF']    ."\" method=\"get\" name=\"the form\">\n";  // start form

	switch ($formStatus)  {

		case "show":
			//do something
		//$formTemplate.= "echo 'this is the show form'\n";
		$formTemplate.= "<button>Build Survey</button>\n";
		$formTemplate.=  setPageStatus('planning') ."\n";


			break;  
		
		case "planning":

		//$formTemplate.= "echo 'this is the planning form'\n";

		$formTemplate .= "<div class=\"form-group\">\n<label for=\"description\">Description</label>\n";
		$formTemplate .= "<input type=\"text\" name=\"description\" id=\"description\">\n</div>\n";
		$formTemplate .= "<label for=\"start_date\">Start Date</label>\n";
	
		$formTemplate.= "<input type=\"date\" name=\"start_date\" id=\"start_date\">\n</div>\n";
		$formTemplate.= "<label>End Date</label>\n";
		$formTemplate.= "<input type=\"date\" name=\"end_date\" >\n</div>\n";

		$formTemplate.= "<button>Build Survey</button>\n";
		$formTemplate.=  setPageStatus('addQuestion') ."\n";
			//do something else
		break;  


		case "addQuestion":

		//create survey first



		$formTemplate.= "<input type=\"text\" name=\"description\" >\n";
		$formTemplate.= "<input type=\"date\" name=\"start_date\" >\n";
		$formTemplate.= "<input type=\"date\" name=\"end_date\" >\n";
		$formTemplate.= "<button>Build Survey</button>\n";
		$formTemplate.=  setPageStatus('addQuestion') ."\n";
			//do something else
		break;  

	}


		
		
		$formTemplate .= "</div>\n</form>\n</div>\n<!--end container-->\n";   //finish form


		return $formTemplate;  //return the form
}





function  setPageStatus  ($status) {  //don't really needd seperate funciton

	$hiddenField = "<div>\n<input type=hidden name=\"action\" value=\"\n</div>"  .$status ."\">";

	return $hiddenField;

}


?>










<?php

include './include/footer.inc';

?>