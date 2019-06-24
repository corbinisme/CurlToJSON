<html>
<head>
<link rel="stylesheet" href="public/bootstrap/css/bootstrap.css" />
	</head>
	<body>
<?php

// check for extra links on pages
$where = "./output";
$myDirectory = opendir($where);
  
  // get each entry
  while($entryName = readdir($myDirectory)) {
     if ($entryName != "." && $entryName != ".." && $entryName!=".DS_Store" && strpos($entryName, ".json")==false) {
        $dirArray[] = $entryName;
     }
  }
  // close directory
  closedir($myDirectory);

  $limit = 7000;
  $counter = 0;
  
  echo "<table class='table table-bordered'><tr><th>File</th><th>Link</th></tr>";
  foreach($dirArray as $fi){
  	if($counter<$limit){
  		
  		
  		$fichero = file_get_contents('./output/' . $fi, true);
  		//echo $fichero;
  		//echo "<hr />";

  			if(strpos($fichero, "SignificantDate")!==false){

				echo "<tr>";
  				echo "<td width='10%'>./output/" .$fi  . "</strong></td>";
  				echo "<td>";
  				$dom = new DomDocument();
				$dom->loadHTML($fichero);
				$output = array();
				foreach ($dom->getElementsByTagName('a') as $item) {
				   $output[] = array (
				      'str' => $dom->saveHTML($item),
				      'href' => $item->getAttribute('href'),
				      'anchorText' => $item->nodeValue
				   );
				   if($item->getAttribute('href')!=""&&$item->getAttribute('href')!="#EndResult"){
					   echo $item->getAttribute('href') . ": ";
					   
					   if(strpos($item->getAttribute('href'),"Timeline")!==false){
					   	// it's a significant link
					   	$url = "https://www.biblicalcalendarproof.com".$item->getAttribute('href');
					   	echo $url;

					   	// Set the url
					   	/*
						curl_setopt($handle, CURLOPT_URL, $url);
						// Set the result output to be a string.
						curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);


						//curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false)
						$newoutput = curl_exec($handle);
						 
						curl_close($handle);

						$fw = fopen('./Timeline/'.$item->getAttribute('href') .'.html', 'w');
						fwrite($fw, $newoutput);
						fclose($fw);
						*/

					   }
					} else {
						//echo "<td>no</td>"
					}
				}
				echo "</td></tr>";
  			} else {
  				//echo "<td>No</td>";
  			}

  		

  		$counter++;
  	}
  }
  echo "</table>";
  
  /*
  $fichero = file_get_contents('./output/AD30.html', true);
  if(strpos($fichero, "SignificantDate")!==false){

  	$dom = new DomDocument();
	$dom->loadHTML($fichero);
	$output = array();
	foreach ($dom->getElementsByTagName('a') as $item) {
	   $output[] = array (
	      'str' => $dom->saveHTML($item),
	      'href' => $item->getAttribute('href'),
	      'anchorText' => $item->nodeValue
	   );
	   if($item->getAttribute('href')!=""&&$item->getAttribute('href')!="#EndResult"){
		   echo $item->getAttribute('href') . ": ";
		   
		   if(strpos($item->getAttribute('href'),"Timeline")!==false){
		   	// it's a significant link
		   	//$url = "https://www.biblicalcalendarproof.com".$item->getAttribute('href');
		   	//echo $url . "<br />";
		   	
		   	/*
		   	$htmlhead = "<html>";
		   	$htmlEnd = "</html>";
			$handle = curl_init();

			// Set the url
			curl_setopt($handle, CURLOPT_URL, $url);
			// Set the result output to be a string.
			curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);


			//curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false)
			$newoutput = curl_exec($handle);
			 
			curl_close($handle);

			$htmlOutput = $newoutput;

			$fw = fopen('./'.$item->getAttribute('href') .'.html', 'w');
			fwrite($fw, $htmlOutput);
			fclose($fw);

			echo 'writing ./'.$item->getAttribute('href').'.html<br />';
			
		   }
		} else {
			// get prev/next links
		}
	}
	*/
	//echo "<pre>";
	//print_r($output);
	//echo "</pre>";

  

?>

</body>
</html>