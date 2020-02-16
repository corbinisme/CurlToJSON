<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$env = "local";
include "conn.php";
?>
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
  </script>
</head>
<body>

<header>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Calendar Downloader</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>


</nav>
</header>
<div class="container">
<h1>Add to DB</h1>
<?php

function getCalendarByYear($file){
 

  $GC_Era = substr($file, 0, 2);
  $GC_Year = substr($file, 2, -5);
  $url = "../generator/calendar/download/" . $file;
  $output = file_get_contents($url);
  $start = strpos($output, "CalendarPage") + 14;
  $newoutput= substr($output, $start, -36);
  $newnewoutput = str_replace("</div<d", "</div><d", $newoutput);
  $newnewnewoutput = str_replace("&amp;nbsp", "&amp;nbsp;", $newnewoutput);

  $ampos = strpos($newnewnewoutput, "AMYear");
  $am = substr($newnewnewoutput, $ampos+29, 4);
  if(strpos($am, '"')!==false){
    $am = substr($am, 0, strpos($am, '"'));
  }

  if($am == ""){
    $am = -999;
  }
  if($newnewnewoutput == ""){
    $newnewnewoutput = "NONE";
  }
  echo "<tr>";
  echo "<td>" . $GC_Year . "</td>";
  echo "<td>" . $GC_Era . "</td>";
  echo "<td>" . $am . "</td>";
  echo" <td><textarea class='form-control'>" . $newnewnewoutput ."</textarea></td>";
  echo "</tr>";

  $sql = "|" .$GC_Year. "|".$GC_Era. "|". $am . "|" .  $newnewnewoutput . "\n";

  $fichero = 'sql/htmlgenerator.csv';
  file_put_contents($fichero, $sql, FILE_APPEND | LOCK_EX);
  //$fw = fopen('sql/htmlgenerator.csv', 'w');
  //fwrite($fw, $sql);
  //fclose($fw);

}

?>



<?php

if(isset($_REQUEST["from"]) && isset($_REQUEST["to"])){

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
    ?>
    <table class='table table-bordered'><tbody>
  <tr>
    <th>GC Year</th>
    <th>GC Era</th>
    <th>AM Year</th>
    <th>Html</th>
  </tr>
  <?php
    for($k=$fromYear; $k<$toYear;$k++){
      $thisEra = "BC";
      $thisYear = $k;



      if($k>=0){
        $thisEra = "AD";

      } else {
        $thisYear *=-1;
      }
      
      //echo $k . " | " . $thisEra . " " . $thisYear . "<br />";
      //echo "<div class='container'><div class='alert alert-success'>";
      //echo $thisYear . " ".  $thisEra;
      //echo "</div></div>";
      $file = $thisEra . $thisYear . ".html";
      getCalendarByYear($file);
    }
    ?>


<?php
/*
$where = "../generator/calendar/download";

$myDirectory = opendir($where);
 
  // get each entry
  $count =0;
  while($entryName = readdir($myDirectory)) {
     $ext = strpos($entryName, "html");


     if ($entryName != "." && $entryName != ".." && $ext==true && $count< 40) {
        $dirArray[] = $entryName;
        $count++;
     }
     
  }
  // close directory
  closedir($myDirectory);

  sort($dirArray);

  foreach($dirArray as $fil){
    getCalendarByYear($fil);
  }
  */

?>

</tbody>
</table>


<?php } else {
$maxCounter = 0;

    $counter = 0;
    $fiftyCounter = 1;
    $full = array();

    $baseStart = -4046;
    $baseEnd = 2046;

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

   echo "<a href='javascript:downloadAll();' class='btn btn-primary'>Download All (long process)</a><hr />";
    echo "<ul class='linksbyfifty hidden'>";
    foreach($full as $years){
      $baseSplit = explode("-", $years);
      $from = $baseSplit[0];
      $to = $baseSplit[1];

      echo "<li><a href='addToDB.php?from={$from}&to={$to}'>". $years ."</a></li>";
    }
    echo "</ul>";
    

}
?>
</div>
  </body>
  </html>