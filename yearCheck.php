<?php


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


	//echo 'writing output/' .$era . $year . '.json | ';
	echo '  writing output/'. $era . $year .'.html<br />';
}


$baseStart = -4046;
$baseEnd = 2045;

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


	$nombre_fichero = './output/' . $era . $year . '.html';
	echo $nombre_fichero;
	if (file_exists($nombre_fichero)) {
	    echo " existe <br />";
	} else {
	    echo " no existe !!!!!!!!!!!!!!!!! <br />";
	    //getCalendarByYear($year, $era);
	}
}

?>