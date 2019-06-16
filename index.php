<?php 

function getCalendarByYear($year, $era){
	$url = "http://www.biblicalcalendarproof.com/find/Json/JSONGetCalendarByYear?year={$year}&era={$era}";

	$handle = curl_init();

	// Set the url
	curl_setopt($handle, CURLOPT_URL, $url);
	// Set the result output to be a string.
	curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
	 
	$output = curl_exec($handle);
	 
	curl_close($handle);

	$fp = fopen('output/' .$era . $year . '.json', 'w');
	fwrite($fp, json_encode($output));
	fclose($fp);

	$fw = fopen('output/'. $era . $year .'html', 'w');
	fwrite($fw, json_decode($output));
	fclose($fw);


	echo 'writing output/' .$era . $year . '.json | ';
	echo 'writing output/'. $era . $year .'html<br />';
}


/*
$year = "33";
if(isset($_REQUEST['year'])){
	$year = $_REQUEST['year'];
}
$era = "AD";
if(isset($_REQUEST['era'])){
	$era = $_REQUEST['era'];
}
*/

for($i=-4000;$i<2020;$i++){
	
	$era = "BC";
	if($i>0){
		$era = "AD";
	}
	$year = $i;
	echo $era . $year . "<br />";
	//getCalendarByYear($year, $era);
}

?>