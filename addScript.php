<html>
<head>
<link rel="stylesheet" href="public/bootstrap/css/bootstrap.css" />
	</head>
	<body>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
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

$limit = 1;
  $counter = 0;

  foreach($dirArray as $fi){
  	if($counter<$limit){
  		$fichero = file_get_contents('./output/' . $fi, true);

		$dom = new DomDocument();
		$dom->loadHTML($fichero);
		$output = "";
		foreach ($dom->getElementsByTagName('head') as $item) {
		   /*
		   $output[] = array (
		      'str' => $dom->saveHTML($item),
		      'href' => $item->getAttribute('href'),
		      'anchorText' => $item->nodeValue
		   );
		   */
			echo $fi . "<br />";
			$head = $dom->saveHTML($item);
			echo "<textarea class='form-control'>" . $head . "</textarea>";
			echo "<hr />";

			$nodo = $dom->createElement("script");
			$nodo->setAttribute ('src', '../src/generator_files/innerNav.js');
			$content = "var blank=true";
			$contentNode = $dom->createTextNode($content);
			$nodo->appendChild($contentNode);
			$nuevo_nodo = $item->appendChild($nodo);
			$output = $dom->saveHTML();
			// file put contents
		}

		$output = str_replace("<div id=\"pageWrap\">", "<div id=\"pageWrap\"><div id=\"CalendarPage\">", $output);
		$output = str_replace("</body>", "</div></body>", $output);

		file_put_contents('./output/' . $fi, $output);

		
			
			echo "<textarea>" .$dom->saveHTML() . "</textarea>";
		
		$counter++;


  	}
  }

  ?>


	</body>
	</html>