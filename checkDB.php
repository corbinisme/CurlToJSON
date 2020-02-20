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
  <div class="row">
    <div class="col-sm-6">
  <table class="table">

<?php
$env = "local";
include "conn.php";
$sql = "SELECT AM_Year from `generator` WHERE GC_Era = 'BC'";
$res = $conn->query($sql);
$counter = 2;

if ($res) {
      while($row = mysqli_fetch_array($res)) {
        // do something with the $row
        if((int)$row['AM_Year'] !== $counter && $row['AM_Year']!="-999"){
          $bads[] = $row['AM_Year'];
          $counter++;
        }
        echo "<tr><td>" . $row['AM_Year'] . "</td><td>" . $counter ."</td></tr>";
        $counter++;
      }

    }
?>
</table>
</div>
<div class="col-sm-6">
<pre>
<?php print_r($bads);?>
</pre>
</div>
</div>
</body>
</html>