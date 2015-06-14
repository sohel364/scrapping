<?php 
set_time_limit(0);
include_once('../simple_html_dom.php');
include_once 'databaseHelper.php';
$dbname="jd_apparels";
$dbopoption=" jd_apparels_op_date_time";

//MapToLongitudeLatitude($dbname);
AddressToPin($dbname);
//MapToLongitudeLatitude($dbname);


	
function AddressToPin($dbname){

	$query = "SELECT `id`,`address`,`itemurl` FROM $dbname where `id`>11843";
	echo $query."</br>";
	
	$db_bitch = new databaseHelper();
	$dataAddress=$db_bitch->ExecuteDataSet($query);
//	echo "<pre>";
//	print_r($dataAddress);
//	echo "</pre>";
	
//	return;
	foreach ($dataAddress as $test){
		if($test!=NULL){
			if (strpos($test['address'],' - ') !== false){
				echo "ID: ".$test['id']."--->". $test['address'].'</br>';
				
				$pieces = explode(",", $test['address']);
				
				foreach ($pieces as $explodeItem){
					if(strpos($explodeItem,' - ')!==false){
						$sql_update ='update '.$dbname.' set pincode="'.$explodeItem.'" where id="'.$test['id'].'"';
						$db_bitch->ExecuteInsertReturnID($sql_update);
						echo $sql_update."<br>";		
					}
				}
			}
			//echo "here :".$test['itemurl'];
			echo "Start insert</br>";
			$tmpWeb=GetInnserData($test['itemurl'],$test['id']);
			echo $tmpWeb;
			echo "End insert</br>";
			$updateSQL='update '.$dbname.' set site="'.safe($tmpWeb).'" where id="'.$test['id'].'"';
			echo $updateSQL.'</br>';
			$db_bitch->ExecuteNonQuery($updateSQL);
			//echo "here";
		}
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
	
	
	
function get_string_between($string, $start, $end){
    $string = " ".$string;
    $ini = strpos($string,$start);
    if ($ini == 0) return "";
    $ini += strlen($start);
    $len = strpos($string,$end,$ini) - $ini;
    return substr($string,$ini,$len);
}
	
	

function MapToLongitudeLatitude($dbname){
	$query = "SELECT `id`,`address`,`mapdata` FROM `$dbname`";
	
	$db_bitch = new databaseHelper();
	$dataAddress=$db_bitch->ExecuteDataSet($query);	

	foreach ($dataAddress as $arr){

		if($arr!=NULL){
			//$arr['id']. 
			
			if($arr['mapdata']!=NULL){
					$tmpo=get_string_between($arr['mapdata'],"view_map_result('",");_ct");
					//echo "ID:".$tmpo."</br>";
					$arrayToExplode=get_string_between($tmpo,"'map',",",'bcard");
					$explodedpieces=explode(",", $arrayToExplode);
//					echo "<pre>";
//						print_r($explodedpieces);
//					echo "</pre>";
//					echo "ID:".$arr['id']."--->"."Longitude : ".$explodedpieces[1]."-->Latitude : ".$explodedpieces[2]."</br>";
					
					$sql_update ='update '.$dbname.' set longitude="'.str_replace("'","",$explodedpieces[1]).'", latitude="'.str_replace("'","",$explodedpieces[2]).'" where id="'.$arr['id'].'"';
					$db_bitch->ExecuteInsertReturnID($sql_update);
					echo $sql_update."<br>";		
			}
		}
	}
}

function safe($value){
	return mysql_real_escape_string($value);
}


	
	
?>