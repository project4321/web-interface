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

			$keywords = $result['keywords'];
			$keywordsString = "";
			foreach ($keywords as $keyword) 
				$keywordsString .= '<i>'.$keyword["word"].'</i> '.$keyword["freq"].'; ';
			$keywordsString = substr($keywordsString, 0, strlen($keywordsString)-1);

			$parentLinkString = "";
			$parentLinks = $result['page']['parentLinks'];
			for ($i=1; $i<=count($parentLinks); $i++){
				$parentLink = $parentLinks[$i-1];
				$parentLinkString .= 'Parent Link'.$i.': <a href="'.$parentLink.'">'.$parentLink.'</a><br>';
			}

			$childLinkString = "";
			$childLinks = $result['page']['childLinks'];
			for ($i=1; $i<=count($childLinks); $i++){
				$childLink = $childLinks[$i-1];
				$childLinkString .= 'Child Link'.$i.': <a href="'.$childLink.'">'.$childLink.'</a><br>';
			}


			echo '<tr>';
			echo '<td align="right" valign="top" width="200px">'.$result["score"].'</td><td width="50px"> </td>';

			echo '<td>';
			echo '<b>'.$result['page']['title']."</b><br>";
			echo '<a href="'.$result['page']['url'].'">'.$result['page']['url'].'</a><br>';
			echo $result['page']['lastMod'].', '.$result['page']['size']."<br>";
			echo $keywordsString.'<br>';
			echo $parentLinkString;
			echo $childLinkString;


			echo '<br></td>';
			echo '</tr>';
		}

		echo '</table>';

	}


	echo "</body></html>";

?>
