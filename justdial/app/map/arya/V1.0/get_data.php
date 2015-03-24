<?php
	// will Insert the data from here
//	$address=$_POST['lon'];
//	$log=$_POST['lat'];
//	$lat=$_POST['adrs'];
//	
	$dat=$_POST['dat'];
	
	//$data="Lon :"+$lon+"Lat :"+$lat+"Address :"+$address;
	//$myfile = fopen("data.txt", "w");

	$file = 'data.txt';
// 	Open the file to get existing content
	$current = file_get_contents($file);
// Append a new person to the file
	$current .= $dat.'\n';
// Write the contents back to the file
	file_put_contents($file, $current);
	
//	fwrite($myfile, $dat);
//	fclose($myfile);
	
	echo $dat;
?>