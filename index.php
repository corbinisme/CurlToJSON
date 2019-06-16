<html>
<head>
	<script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>
  <script>
 var counter = 0;
 var masterList = [];
  $("#listAll span").each(function(){
  	var era = $(this).attr("data-era");
  	var year = parseInt($.trim($(this).text()));

  	
  	//$("#newlist").append()
  	if(counter==0){

  	}
  	if(counter==50){
  		counter =0;
  	} else {
  	counter++;
  	}

  });
  </script>
</head>
<body>
	
<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
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

	$fw = fopen('output/'. $era . $year .'.html', 'w');
	fwrite($fw, json_decode($output));
	fclose($fw);


	echo 'writing output/' .$era . $year . '.json | ';
	echo 'writing output/'. $era . $year .'.html<br />';
}



if(isset($_REQUEST['year']) && isset($_REQUEST['era'])) {
	//single year
	$year = "33";
	if(isset($_REQUEST['year'])){
		$year = $_REQUEST['year'];
	}
	$era = "AD";
	if(isset($_REQUEST['era'])){
		$era = $_REQUEST['era'];
	}
	getCalendarByYear($year, $era);
} else {

	//echo "not single";
	if(isset($_REQUEST["from"]) && isset($_REQUEST["to"])){
		//echo "calculate that set";

		$from = $_REQUEST["from"];
		$to  = $_REQUEST["to"];

		$fromSplit = explode(":",$from);
		$toSplit = explode(":",$to);

		$fromEra = $fromSplit[0];
		$fromYear = $fromSplit[1];
		if($fromEra=="BC"){
			$fromYear *=-1;
		}
		$toEra = $toSplit[0];
		$toYear = $toSplit[1];
		if($toEra=="BC"){
			$toYear *=-1;
		}

		echo "<h2>Downloading years " . $fromYear . "-" . $toYear . "</h2>";
		echo "<br />";

		for($k=$fromYear; $k<$toYear;$k++){
			$thisEra = "BC";
			$thisYear = $k;



			if($k>=0){
				$thisEra = "AD";

			} else {
				$thisYear *=-1;
			}
			
			echo $k . " | " . $thisEra . " " . $thisYear . "<br />";
			getCalendarByYear($thisYear, $thisEra);
		}
	} else {

		echo "<h1>Download by sets of 50</h1>";
		$maxCounter = 0;

		$counter = 0;
		$fiftyCounter = 1;
		$full = array();

		$baseStart = -4000;
		$baseEnd = 2020;

		$tot = $baseStart*-1 + $baseEnd;
		$remain = $tot%50;

		for($i=-4000;$i<2020;$i++){
			$era = "BC";
			if($i>0){
				$era = "AD";
			}
			$year = $i;
			if($year<0){
				$year = $year*-1;
			}

			if($counter==1){
				$full["entry_".$fiftyCounter] = $era . ":" . $year;
			}
			if($counter==50){
				$full["entry_".$fiftyCounter] .= "-" . $era . ":" . $year;
				$fiftyCounter++;
				$counter = 0;
			}
			$counter++;
		}
		$last = $full["entry_" . $fiftyCounter];
		$lastYear = explode(":", $last)[1];
		//echo "<br>" . $remain . " : " .$lastYear;
		$newEndYear = "-".explode(":", $last)[0] . ":".  ((int)$lastYear+(int)$remain);
		//echo "newendyear " . $newEndYear;
		$full["entry_" . $fiftyCounter] .= $newEndYear;
		//echo "<pre>";
		//print_r($full);
		//echo "</pre>";

		echo "<ul class='linksbyfifty'>";
		foreach($full as $years){
			$baseSplit = explode("-", $years);
			$from = $baseSplit[0];
			$to = $baseSplit[1];

			echo "<li><a href='index.php?from={$from}&to={$to}'>". $years ."</a></li>";
		}
		echo "</ul>";
	}


}


// this will blow up the server
/*
echo "<div id='listAll'>";
for($i=-4000;$i<2020;$i++){
	
	$era = "BC";
	if($i>0){
		$era = "AD";
	}
	$year = $i;
	if($year<0){
		$year = $year*-1;
	}
	echo "<span data-era='" .$era. "'>" . $year . "</span><br />";
	//getCalendarByYear($year, $era);
	//$maxCounter++;
}
echo "</div>";
*/
?>

</body>
</html>