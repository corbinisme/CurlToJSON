<html>
<head>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
  rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>

</head>
<body>
<?php
$where = "../generator/output";
$counter = 0;
$myDirectory = opendir($where);
 
  // get each entry
  while($entryName = readdir($myDirectory)) {
     $ad = strpos($entryName, "AD");


     if ($entryName != "." && $entryName != "..") {
     	if($ad!==false){
			$dirArrayAD[] = $entryName;
     	} else {
        	$dirArrayBC[] = $entryName;
    	}
     } 
     
  }
  // close directory
  closedir($myDirectory);

  sort($dirArrayBC);
  echo "<div class='row'>";
  echo "<div class='col-sm-6'><h1>BC</h1><table class='table table-bordered'>";
  foreach($dirArrayBC as $fil){
    echo "<tr><td>" . $fil . "</td><td>" . $counter . "</td></td></tr>";
    $counter++;
  }
   echo "</table></div>";

   if(isset($dirArrayAD)){
   sort($dirArrayAD);
   $counter2 = 0;
    echo "<div class='col-sm-6'><h1>AD</h1><table class='table table-bordered'>";
  foreach($dirArrayAD as $fil2){
    echo "<tr><td>" . $fil2 . "</td><td>" . $counter2 . "</td></td></tr>";
    $counter2++;
  }
   echo "</table></div></div>";
  } else {
  	echo "</div>";
  }

?>

</body>
</html>