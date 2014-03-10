<?php
// Set the page title and include the HTML header.
$page_title = 'Complete Survey';
include './include/header.inc';

$id = $_GET['id'];

$surveyArray = getSurveyInfo($id);  //get survey information

$surveyDescription = $surveyArray[0]["description"];
$surveyStatus = $surveyArray[0]["status"];
$surveyStart = $surveyArray[0]["start_date"];
$surveyEnd = $surveyArray[0]["end_date"];


$questionArray = getSurveyQuestions($id);  //get survey questions

?>



<div class="container">

	<h1>Survey: <small><?php echo $surveyDescription ?> </small>       </h1>
 <hr />
</div>


<div class="container">

	<h3>Questions</h3>
 <hr />
</div>


<div class="container">
<form method="get" action="./submitResult.php">
<table class="table table-hover table-striped ">
      <thead>
        <tr>
          <th>Questions</th>
          <th>Answers</th>
          </tr>
      </thead>
      <tbody>

  <?php


  	for ($i=0;$i<count($questionArray);$i++)   {    //loop through each question

  				echo "<tr>";  //start row
  				
  				echo "<td>";
					echo $questionArray[$i]["question"];
					echo "</td>";

					$potentailAnswersArray = getPotentialAnswers($questionArray[$i]["id"]);   //get potential answers
					//insert response(s)
					echo "<td>";

						if ($potentailAnswersArray[0]["response_type"] == "text"    ) {
						//	echo "its a text input";# code...

							echo "<input type='text' name='" .$potentailAnswersArray[0]["question_id"]     ."'>" ;



						}  else if ($potentailAnswersArray[0]["response_type"] == "radio"  ) {

							//echo "its a radio input";# code...
								
								for ($y=0; $y <count($potentailAnswersArray) ; $y++) { 
										echo "<div class='radio'>";
									echo "<input type='radio' name='" .$potentailAnswersArray[0]["question_id"]  ."'" ." value='" . $potentailAnswersArray[$y]["response_value"]    ."'>" .$potentailAnswersArray[$y]["response_value"] ;
								   
								echo "</div>";
								//echo "i=" .$i;
								//echo "y=" .$y;
								} 




						} else {

								echo "unable to determine input type";
								//echo "i=" .$i;
								//echo "y=" .$y;

						}
							


				/*	echo "<pre>";
						

						print_r($potentailAnswersArray);   //"response input type and text goes here";
						//need to update response_anserrs table with quesiton id
					echo "</pre>";

					*/
					echo "</td>";

					echo "</tr>";  //end row

			}


	


    //echo getPotentialAnswers($questionArray[$i][5]);

?>

	</tbody>
  </table>
  <input name="survey_id" type="hidden" value=" <?php echo $surveyArray[0]["id"]; ?>     ">
  <button type="submit" class="btn btn-success btn-block" >
		Submit

	</button>
</form>



</div>





<?php

include './include/footer.inc';

?>