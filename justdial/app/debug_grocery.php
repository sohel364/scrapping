<?php 
set_time_limit(0);
include_once 'databaseHelper.php';
include_once('../simple_html_dom.php');

$query = "SELECT `id` FROM `jd_apparels_op_date_time`";

//echo $query;
//echo '</br>';

$db_bitch = new databaseHelper();
$dataAddress=$db_bitch->ExecuteDataSet($query);

//echo "<pre>";
//	print_r($dataAddress);
//echo "</pre>";

$IndexArr=array();

foreach ($dataAddress as $item){
	if($item!=null){
		//echo $item[0];
		//echo "</br>";
			
		array_push($IndexArr,$item['id']);
	}
}

//return;

//echo "<pre>";
//	print_r($IndexArr);
//echo "</pre>";



for($i=1;$i<14551;$i++){
		if(!in_array("$i",$IndexArr)){
			
			echo $i;
			
			$sql="SELECT `itemurl` FROM `jd_apparels` WHERE `id`='$i'";
			echo $sql;
			echo "</br>";
			
			GiveMeQueryIwillFixIT($sql,$i);
		}
	}
	
	
function GiveMeQueryIwillFixIT($sql,$id){
	$db_bitch = new databaseHelper();
	$urlData=$db_bitch->ExecuteDataSet($sql);
	echo $sql;
	echo "</br>";
	echo "<pre>";
		print_r($urlData);
	echo "</pre>";
	if($urlData[1][0]!=null){
	echo GetInnserData($urlData[1][0],$id);
	}
}


function GetInnserData($siteURL,$insertedID) {
		//sleep(5);
		$tt = file_get_html($siteURL);
		
		//echo $tt;
		//echo "</br>";
		
		//echo $siteURL;
		
		//sleep(10);
		$tmpID=$insertedID;
		$websiteOfItem="";
		//div[class=hReview-aggregate] 
		
		if($tt!=null){
		
		foreach ($tt->find(
				'section[class=jw] 
					section[class=jdlc] 
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
						$exploded = explode(": ",$rdata[0]);//jd_grocery_op_date_time
						$sqlInnerData='INSERT INTO  `jd_apparels_op_date_time` (`days`, `duration`, `id`) VALUES ("'.safe($exploded[0]).'","'.safe($exploded[1]).'","'.safe($tmpID).'")';
						$dataBaseHelper = new databaseHelper();
						$insertedID=$dataBaseHelper->ExecuteInsertReturnID($sqlInnerData);
						echo $sqlInnerData.'</br>';
					}
					
				
				}
				
				foreach ($tt->find(
				'section[class=jw] 
					section[class=jdlc] 
						div[class=hReview-aggregate] 
							section[class=dtwrp] 
								section[class=dtcont] 
									section[id=rvcnt] 
										section[class=moreinfo] section[class=fcont] p[class=wsurl] a') as $fcnt)
				{
					$websiteOfItem=$fcnt->plaintext;
				}
				
			
				
				if($websiteOfItem==""){
						
						foreach ($tt->find(
						'section[class=jw] 
							section[class=jdlc] 
								div[class=hReview-aggregate] 
									section[class=dtwrp] 
										section[class=dtcont] 
											section[id=rvcnt] 
												section[class=moreinfo] section[class=fcont] aside[class=continfo nocl] p[class=wsurl] a') as $fcnt1)
						{
							$websiteOfItem=$fcnt1->plaintext;
						}

				}
				
//				echo "source :".$siteURL.'</br>';
//				echo "ID :".$tmpID.":".$websiteOfItem.'</br>';
				return $websiteOfItem;
}

else {
	echo "ID :".$insertedID."Something went wrong with this url :" .$siteURL."</br>";
}

}

function safe($value){
	return mysql_real_escape_string($value);
}


function get_string_between($string, $start, $end){
    $string = " ".$string;
    $ini = strpos($string,$start);
    if ($ini == 0) return "";
    $ini += strlen($start);
    $len = strpos($string,$end,$ini) - $ini;
    return substr($string,$ini,$len);
}

?>
