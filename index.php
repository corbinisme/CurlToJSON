<?php 
$year = "33";
if(isset($_REQUEST['year'])){
	$year = $_REQUEST['year'];
}
$era = "AD";
if(isset($_REQUEST['era'])){
	$era = $_REQUEST['era'];
}
$url = "http://www.biblicalcalendarproof.com/find/Json/JSONGetCalendarByYear?year={$year}&era={$era}";
	echo $url;
?>