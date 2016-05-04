<!-- #!/usr/local/bin/php  -->
<script type="text/javascript">
	function preSearch(){
		var goodQuery = true;

		var qs = document.getElementById('qs').value;
		qs = qs.replace(/\s+/g, " ");

		var count = (qs.match(/"/g) || []).length;
		if (count % 2 == 1) {
			alert("Unparallel Quotes");
			goodQuery = false;
		}

		var words = [];
		while (qs.indexOf('"') > -1){
			if (qs.charAt(0) == '"'){
				qs = qs.substring(1, qs.length);
				words.push(qs.substring(0, qs.indexOf('"')).replace(/^\s+|\s+$/g, ""));
				qs = qs.substring(qs.indexOf('"')+1, qs.length);
			}
			else {
				var splits = qs.substring(0, qs.indexOf('"')-1).split(" ");
				for (var i=0; i<splits.length; i++)
					words.push(splits[i]);
				qs = qs.substring(qs.indexOf('"'), qs.length);
			}
		}
		var splits = qs.split(" ");
		for (var i=0; i<splits.length; i++) words.push(splits[i]);


		var submit = "";
		for (var i=0; i<words.length; i++)
			submit += words[i] + "@";

		var query = "";
		for (var i=0; i<words.length; i++)
			if (words[i] != "") query += "qs[]=" + words[i] + "&";
		query = query.substring(0, query.length-1);


		// document.getElementById('debug').innerHTML = "query: " + query;

		if (goodQuery) window.location = "search.php?" + query;
	}
</script>

<?php

	// colors
	$headerColor = "#707070";
	$bodyColor   = "#F0F0F0";

	echo '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>';
	echo '<body style="background-color:'.$bodyColor.'">';


	// header
	echo '<div style="weight:100%; height:50px; top:0px; left:0px; right:0px; position:fixed; background-color:'.$headerColor.'"></div>';
	echo '<div style="top:15px; left:20px; position:fixed">';
	echo '<font color="#FFFFFF">COMP 4321 Project Group 18</font></div>';
	echo '<div style="top:15px; right:100px; position:fixed"><a href="v-space-search.php"><font color="#FFFFFF">Vector Space Search</font></a></div>';

	// margin
	echo '<div style="weight:100%; height:50px; top: 0px; background-color:'.$bodyColor.'"></div>';
	

	// form
	echo '<form action="javascript:preSearch()" method="get">';
		echo 'Search <input id="qs" type="textfield" name="qs[]">';
		echo '<input type="submit" value="Submit">';
	echo '</form>';


	echo "</body></html>";
	// file_put_contents("page.html", $html);

?>
