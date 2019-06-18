<html>
<head>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
	rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	  
	  <script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>
  <script>
 var listCounter = 0;
 var list = [];
  function downloadAll(){

  	var current = 0;
  	
  	$(".linksbyfifty li").each(function(){
  		var url = $(this).find("a").attr("href");
  		list.push(url);
  		//console.log(url)

  	});

  	ajaxDownload()
  	//ajaxDownload(list[0]);
  }

function downloadYear(){
	var year = $("#year").val();
	var era = $("#era").val();
	var url = "index.php?year="  +year + "&era=" + era;
	$.ajax({
		url: url
	}).done(function(data){
		console.log(data);
		alert("downloaded")
	})
}
 
  function ajaxDownload(){
  	var url = list[listCounter];
  	$(".linksbyfifty li a[href='" + url + "']").addClass("btn btn-default").append("<span class='loader'></span>");

  	$.ajax({
  		url: url,
  	}).done(function(data){
  		//console.log($(data).find(".container").html());
  		console.log(url + " done");
  		$(".linksbyfifty li a[href='" + url + "']").addClass("disabled").find("span").remove();

  		listCounter++;
  		// just setting to the first two for now
  		//if(listCounter==1){
  			ajaxDownload();
  		//}
  	});

	
	console.log("ajaxing "+url)
  }
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

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" 
  integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" 
  crossorigin="anonymous"></script>
  <style>
.loader {
  border: 16px solid #f3f3f3; /* Light grey */
  border-top: 16px solid #3498db; /* Blue */
  border-radius: 50%;
  width: 20px;
  height: 20px;
  display: inline-block;
  position: relative;
  top: 8px;
  left: 5px;
  animation: spin 2s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

  </style>
</head>
<body>
<header>

	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Calendar Downloader</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <!--
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
       <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Download ALL</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Download  Specific Year</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Results</a>
      </li>
    </ul>
  </div>
-->
</nav>

</header>
<br />
<?php 


error_reporting(E_ALL);
ini_set('display_errors', 1);
function getCalendarByYear($year, $era){
	$url = "http://www.biblicalcalendarproof.com/find/Json/JSONGetCalendarByYear?year={$year}&era={$era}";


$htmlhead = '<html>
<head>
	<!--Requires site.css--><link rel="SHORTCUT ICON" href="../src/favIcon.ico">
	<link rel="stylesheet" href="../src/generator_files/jquery.simplyscroll.css" media="all" type="text/css">
	<link type="text/css" rel="stylesheet" href="../src/generator_files/ResponsiveMAIN.css" title="Normal">
	<link type="text/css" rel="stylesheet" href="../src/generator_files/HighContrast.css" title="HighContrast">
	<link type="text/css" rel="stylesheet" href="../src/generator_files/site.css">
	<link type="text/css" rel="stylesheet" href="../src/generator_files/GS.css">
	<link href="../src/generator_files/css" rel="stylesheet" type="text/css">
</head>
<body>
	<div id="pageWrap">
	<div id="md-maincontent">';
	$htmlEnd = '</div>
</div>
</body>
</html>';

	$handle = curl_init();

	// Set the url
	curl_setopt($handle, CURLOPT_URL, $url);
	// Set the result output to be a string.
	curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
	 
	$output = curl_exec($handle);
	 
	curl_close($handle);

	$htmlOutput = $htmlhead . "<br />" .  json_decode($output) . $htmlEnd;

	$fp = fopen('output/' .$era . $year . '.json', 'w');
	fwrite($fp, json_encode($output));
	fclose($fp);

	$fw = fopen('output/'. $era . $year .'.html', 'w');
	fwrite($fw, $htmlOutput);
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
	echo "<div class='container'><div class='alert alert-success'>";
	getCalendarByYear($year, $era);
	echo "</div></div>";
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
			
			//echo $k . " | " . $thisEra . " " . $thisYear . "<br />";
			echo "<div class='container'><div class='alert alert-success'>";
			getCalendarByYear($thisYear, $thisEra);
			echo "</div></div>";
		}
	} else {

		?>
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
		<?php
		echo "<h1>Download by sets of 50</h1>";
		echo "<a href='javascript:downloadAll();' class='btn btn-primary'>Download All (long process)</a><hr />";
		$maxCounter = 0;

		$counter = 0;
		$fiftyCounter = 1;
		$full = array();

		$baseStart = 2043;
		$baseEnd = 2146;
		// and BC 0-10
		// AD 0-4

		$tot = $baseStart*-1 + $baseEnd;
		$remain = $tot%50;

		for($i=$baseStart;$i<$baseEnd;$i++){
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

		?>
			</div>
			<div class="col-sm-6">
				<h1>Get a specific year</h1>
				<form action="index.php" method="GET">
				<label>Year</label>
				<input type="text" id="year" name="year"  class="form-control"/>
				<label>Era</label>
				<select class="form-control" name="era" id="era">
					<option value="AD">AD</option>
					<option value="BC">BC</option>
				</select>
				<br />
				<a class="btn btn-primary" href="javascript:downloadYear()">
					Download
				</a>
				
			</div>
		</div>

		<?php
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