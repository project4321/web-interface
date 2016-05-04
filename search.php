<!-- #!/usr/local/bin/php  -->
<?php

	// colors
	$headerColor = "#707070";
	$bodyColor   = "#F0F0F0";

	echo '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>';
	echo '<body style="background-color:'.$bodyColor.'">';

	// header
	echo '<div style="weight:100%; height:50px; top:0px; left:0px; right:0px; position:fixed; background-color:'.$headerColor.'"></div>';
	echo '<div style="top:15px; left:20px; position:fixed"><font color="#FFFFFF">Search Result</font></div>';
	echo '<div style="top:15px; right:20px; position:fixed"><a href="home.php"><font color="#FFFFFF">Home</font></a></div>';
	echo '<div style="top:15px; right:100px; position:fixed"><a href="v-space-search.php"><font color="#FFFFFF">Vector Space Search</font></a></div>';


	// margin
	echo '<div style="weight:100%; height:50px; top: 0px; background-color:'.$bodyColor.'"></div>';


	// display search result
	if (!empty($_GET["qs"])){
		// get result

		$qsString = "";
		foreach ($_GET["qs"] as $q) $qsString = $qsString."qs=".urlencode($q)."&";
		$url = 'http://localhost:8090/search?'.substr($qsString, 0, strlen($qsString)-1);
		$options = array( 'http' => array( 'method'  => 'GET' ) );
		$context  = stream_context_create($options);
		$results = file_get_contents($url, false, $context);
		if ($results === FALSE) { /* error handling */ }
		$results = json_decode($results, true);


		// formating result

		echo '<table>';
		foreach ($results as $result){

<<<<<<< HEAD
			// $timestamp = $result['page']['lastMod'];
			$timestamp = gmdate("Y-m-d\TH:i:s\Z", substr($result['page']['lastMod'], 0, 10));

			$keywords = $result['keywords'];
			$keywordsString = "";
			$simQuery = "search.php?";
			foreach ($keywords as $keyword) {
				$keywordsString .= '<i>'.$keyword["word"].'</i> '.$keyword["freq"].'; ';
				$simQuery .= 'qs[]='.$keyword["word"].'&';
			}
			$keywordsString = substr($keywordsString, 0, strlen($keywordsString)-2);
			$simQuery = substr($simQuery, 0, strlen($simQuery)-1);
=======
			$keywords = $result['keywords'];
			$keywordsString = "";
			foreach ($keywords as $keyword) 
				$keywordsString .= '<i>'.$keyword["word"].'</i> '.$keyword["freq"].'; ';
			$keywordsString = substr($keywordsString, 0, strlen($keywordsString)-1);
>>>>>>> cbf3a233484291648cc0c85c6c30517381a210c9

			$parentLinkString = "";
			$parentLinks = $result['page']['parentLinks'];
			for ($i=1; $i<=count($parentLinks); $i++){
				$parentLink = $parentLinks[$i-1];
<<<<<<< HEAD
				$parentLinkString .= 'Parent Link'.$i.': <a href="'.$parentLink.'"><font color="#0000FF">'.$parentLink.'</font></a><br>';
=======
				$parentLinkString .= 'Parent Link'.$i.': <a href="'.$parentLink.'">'.$parentLink.'</a><br>';
>>>>>>> cbf3a233484291648cc0c85c6c30517381a210c9
			}

			$childLinkString = "";
			$childLinks = $result['page']['childLinks'];
			for ($i=1; $i<=count($childLinks); $i++){
				$childLink = $childLinks[$i-1];
<<<<<<< HEAD
				$childLinkString .= 'Child Link'.$i.': <a href="'.$childLink.'"><font color="#0000FF">'.$childLink.'</font></a><br>';
=======
				$childLinkString .= 'Child Link'.$i.': <a href="'.$childLink.'">'.$childLink.'</a><br>';
>>>>>>> cbf3a233484291648cc0c85c6c30517381a210c9
			}


			echo '<tr>';
			echo '<td align="right" valign="top" width="200px">'.$result["score"].'</td><td width="50px"> </td>';

			echo '<td>';
<<<<<<< HEAD
			echo '<a href="'.$result['page']['url'].'"><font color="#000000"><b>'.$result['page']['title']."</b></font></a><br>";
			echo '<a href="'.$result['page']['url'].'"><font color="#0000FF">'.$result['page']['url'].'</font></a><br>';
			echo $timestamp.', '.$result['page']['size']."<br>";
			echo $keywordsString.' <a href="'.$simQuery.'"><font color="#0000FF">Search Similar Pages!</font></a><br>';
=======
			echo '<b>'.$result['page']['title']."</b><br>";
			echo '<a href="'.$result['page']['url'].'">'.$result['page']['url'].'</a><br>';
			echo $result['page']['lastMod'].', '.$result['page']['size']."<br>";
			echo $keywordsString.'<br>';
>>>>>>> cbf3a233484291648cc0c85c6c30517381a210c9
			echo $parentLinkString;
			echo $childLinkString;


			echo '<br></td>';
			echo '</tr>';
		}

		echo '</table>';

	}


	echo "</body></html>";

?>
