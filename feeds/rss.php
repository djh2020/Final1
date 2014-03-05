<?php

session_start();
ob_start();
require_once('../include/db_connect.php');
require_once('../helper.php');

// Set Filename
$filename = "./index.xml";
//$rootURL = "http://darrellhart.com/Final1/view_survey_details.php?id=";
$rootURL =  $_SERVER['SERVER_NAME'] .":" .$_SERVER['SERVER_PORT'] ."/Final1/view_survey_details.php?id=";

//Create XML


$createXML = "<?xml version=\"1.0\"  encoding=\"UTF-8\" ?>\n";
$createXML .= "\t<rss version=\"2.0\">\r\n";
$createXML .= "\t\t<channel>\r\n";
$createXML .= "\t\t\t<title>Latest Survey Results</title>\r\n";
$createXML .= "\t\t\t<link>http://darrellhart.com/Final1/view/</link>\r\n";
$createXML .= "\t\t\t<description>List latest president activity</description>\r\n";
$createXML .= "\t\t\t<language>en-us</language>\r\n";






//loop through surveys

$surveyArray = getSurveys();

print_r($surveyArray);

for ( $i=0; $i < count( $surveyArray ); $i++ ) {

	$createXML .= "\t\t\t\t<item>";
	$createXML .= "\t\t\t\t\t\t\t<title>" .$surveyArray[$i]["status"] ."</title>";
	$createXML .= "\t\t\t\t\t\t\t<link>" .$rootURL .$surveyArray[$i]["id"] ."</link>";
	$createXML .= "\t\t\t\t\t\t\t<description>" .$surveyArray[$i]["description"] ."</description>";
	$createXML .= "\t\t\t\t</item>";
	// code...
}


//finish xml
$createXML .="</channel>\n </rss>";

//create file
echo $createXML;
$filehandle = fopen( $filename, w ) or die ( "can't open file" );
fwrite( $filehandle, $createXML );
fclose( $filehandle );




function getSurveys() {

	$query = "SELECT id, status, start_date, end_date, description , created FROM surveys";

	$result = @mysql_query( $query ); // Run the query. should return true if a result resource is returned.

	while ( $row = mysql_fetch_array( $result, MYSQL_ASSOC ) ) {   // loop through each reponse answer

      $surveyArray[] = $row;

    }   //finish builind array

	return $surveyArray;

}

?>
