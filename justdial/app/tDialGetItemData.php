<?php 
set_time_limit(0);
include_once('../simple_html_dom.php');
include_once 'databaseHelper.php';

	//http://www.justdial.com/Delhi/Kaya-Skin-Clinic-&lt;near&gt;-Punjabi-Bagh/011PGE17727_RGVsaGkgRGVybWF0b2xvZ2lzdHM=_BZDET
	
$tt = file_get_html('http://www.justdial.com/Delhi/Dr-Batra-s-Positive-Health-Clinic-Pvt-Ltd-&lt;near&gt;-Pitampura/011P110251_RGVsaGkgRGVybWF0b2xvZ2lzdHM=_BZDET');

//echo $tt;

foreach ($tt->find(
'section[class=jw] 
	section[class=jdlc] 
		div[class=hReview-aggregate] 
			section[class=dtwrp] 
				section[class=dtcont] 
					section[id=rvcnt] 
						section[class=moreinfo] section[class=fcont] div[class=hrsop] table') as $fcnts)
{
	
	//echo "<xmp>".$fcnts."</xmp>";
	$rowData = array();
	foreach($fcnts->find('tr') as $row) {
	    // initialize array to store the cell data from each row
	    $opdatetime = array();
	    foreach($row->find('td') as $cell) {
	        // push the cell's text to the array
	        $opdatetime[] = $cell->plaintext;
	    }
	    $rowData[] = $opdatetime;
	}

	foreach ($rowData as $rdata){
		 $exploded = explode(": ",$rdata[0]);
		 
		echo "<pre>";
			print_r($exploded);
			echo "</pre>";
		 
	}
	

}

foreach ($tt->find(
'section[class=jw] 
	section[class=jdlc] 
		div[class=hReview-aggregate] 
			section[class=dtwrp] 
				section[class=dtcont] 
					section[id=rvcnt] 
						section[class=moreinfo] section[class=fcont] p[class=wsurl] a ') as $fcnt)
{
	echo $fcnt;
	
}

?>