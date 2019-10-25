<html lang="en" dir="ltr" prefix="content: http://purl.org/rss/1.0/modules/content/ dc: http://purl.org/dc/terms/ foaf: http://xmlns.com/foaf/0.1/ og: http://ogp.me/ns# rdfs: http://www.w3.org/2000/01/rdf-schema# sioc: http://rdfs.org/sioc/ns# sioct: http://rdfs.org/sioc/types# skos: http://www.w3.org/2004/02/skos/core# xsd: http://www.w3.org/2001/XMLSchema#">
<head>
  <link rel="profile" href="http://www.w3.org/1999/xhtml/vocab" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Generator" content="Drupal 7 (http://drupal.org)" />
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.css" media="all" />
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@unicorn-fail/drupal-bootstrap-styles@0.0.2/dist/3.3.1/7.x-3.x/drupal-bootstrap.css" media="all" />
<style>
.badge {margin: 4px;}
</style>


<style>table, td {border: 1px solid #ddd; padding: 5px;}</style>
</head>


<body>
	<script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>
<script>
$(document).ready(function(){


	$("table a").click(function(e){
		e.preventDefault();
		var linky = $(this).attr("href");
		$.ajax({
			url: linky,
			success: function(data){
				var thisLink = $(data).find(".sdHeadline a").attr("href");
				thisLink = "https://www.biblicalcalendarproof.com" + thisLink;
				window.open(thisLink)
			}, 
			error: function(e){

			}
		});
	});
});
</script>
<?php
$env = "local";
include "../generator/calendar/conn.php";
$dates = array(
"BC4046",
"BC3915",
"BC3810",
"BC3720",
"BC3650",
"BC3585",
"BC3424",
"BC3358",
"BC3171",
"BC3115",
"BC3003",
"BC2989",
"BC2905",
"BC2810",
"BC2755",
"BC2623",
"BC2483",
"BC2394",
"BC2389",
"BC2386",
"BC2384",
"BC2383",
"BC2348",
"BC2318",
"BC2284",
"BC2254",
"BC2222",
"BC2192",
"BC2163",
"BC2045",
"BC2036",
"BC2033",
"BC2023",
"BC2017",
"BC1992",
"BC1958",
"BC1948",
"BC1947",
"BC1933",
"BC1928",
"BC1915",
"BC1900",
"BC1893",
"BC1884",
"BC1883",
"BC1873",
"BC1858",
"BC1854",
"BC1833",
"BC1791",
"BC1790",
"BC1782",
"BC1767",
"BC1753",
"BC1752",
"BC1743",
"BC1720",
"BC1672",
"BC1654",
"BC1609",
"BC1568",
"BC1528",
"BC1527",
"BC1490",
"BC1489",
"BC1488",
"BC1189",
"BC1184",
"BC1177",
"BC1167",
"BC1159",
"BC1139",
"BC1099",
"BC1079",
"BC1039",
"BC999",
"BC959",
"BC956",
"BC949",
"BC948",
"BC934",
"BC920",
"BC919",
"BC902",
"BC901",
"BC899",
"BC898",
"BC897",
"BC874",
"BC873",
"BC869",
"BC859",
"BC858",
"BC855",
"BC839",
"BC838",
"BC837",
"BC831",
"BC827",
"BC826",
"BC821",
"BC820",
"BC799",
"BC798",
"BC784",
"BC783",
"BC782",
"BC781",
"BC769",
"BC755",
"BC743",
"BC729",
"BC706",
"BC705",
"BC694",
"BC693",
"BC692",
"BC691",
"BC676",
"BC673",
"BC665",
"BC662",
"BC661",
"BC657",
"BC634",
"BC633",
"BC589",
"BC588",
"BC579",
"BC578",
"BC577",
"BC576",
"BC545",
"BC542",
"BC534",
"BC533",
"BC529",
"BC523",
"BC454",
"BC453",
"BC5",
"BC4",
"AD30",
"AD70");
echo "<table><tr><th>Era</th><th>Year</th><th>AM</th></tr>";
foreach($dates as $date){
	//echo $date;
	$era = substr($date, 0,2);
	$year  = substr($date, 2);
	echo  "<tr><td>" . $era . " </td><td> " . $year . "</td><td>";
	$where ="GC_Era = '" . $era . "' and GC_Year = '" . $year . "'";
	//echo $where . "<br />";
	$sql = "SELECT AM FROM calendardates where " . $where;
	//echo $sql . "<hr />";
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()) {
		echo "<a href='../generator/calendar/download/" . $date . ".html'>";
		echo $row['AM'];
		echo "</a>";
	}
	echo "</td></tr>";
	//print_r($result);
}

//echo "<pre>";
//print_r($dates);
//echo "</pre>";
?>
</body>
</html>