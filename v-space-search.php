<!-- #!/usr/local/bin/php  -->
<?php

	// colors
	$headerColor = "#707070";
	$bodyColor   = "#F0F0F0";

	echo '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>';
	echo '<body style="background-color:'.$bodyColor.'">';

	// get words
	$url = 'http://localhost:8090/words';
	$options = array( 'http' => array( 'method'  => 'GET' ) );
	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context);
	if ($result === FALSE) { /* error handling */ }
	$result = json_decode($result);


	// header
	echo '<div style="weight:100%; height:50px; top:0px; left:0px; right:0px; position:fixed; background-color:'.$headerColor.'"></div>';
	echo '<div style="top:15px; left:20px; position:fixed"><font color="#FFFFFF">Vector Space Search</font></div>';
	echo '<div style="top:15px; right:20px; position:fixed"><a href="home.php"><font color="#FFFFFF">Home</font></a></div>';
	


	// margin
	echo '<div style="weight:100%; height:50px; top: 0px; background-color:'.$bodyColor.'"></div>';
	
	// form
	echo '<form action="search.php" method="get">';

	echo '<table>';
	for ($i=0; $i<count($result); $i++){
		$col = 3;
		$mod  = $i % $col;
		if ($mod == 0)      echo '<tr>';

		$word = $result[$i];
		echo '<td width="10%"><input type="checkbox" name="qs[]" value="'.$word.'"> '.$word.'</td>';

		if ($mod == $col-1) echo '</tr>';
	}
	echo '</table>';
	echo '<input type="submit" value="Submit">';
	echo '</form>';


	echo "</body></html>";
	// file_put_contents("page.html", $html);

?>
