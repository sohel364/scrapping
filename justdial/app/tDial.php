<?php
set_time_limit(0);
include_once('../simple_html_dom.php');
include_once 'databaseHelper.php';
include_once 'clsJDItem.php';

$table_name="jd_entertainment";
$table_name_opdtm="jd_entertainment_op_date_time";

for($itr=1;$itr<20;$itr++){	
	 	$url ='http://www.justdial.com/Delhi-NCR/Farm-House-On-Hire/ct-467586/page-'.$itr.'';
		$innerHtml = file_get_html($url);
		
//		sleep(10);
		$myfile = fopen("data.html", "w");
		fwrite($myfile, $innerHtml);
		fclose($myfile);

		$tt = file_get_html('file:///C:/xampp/htdocs/scrapping/justdial/app/data.html');
		echo 'New Data'.$url.'</br>';
				
		$hotelObject= NULL;
		$arrayOfHotelInfo = array();
		$cat="Entertainment";
		$subcat="Farm-House-On-Hire";
		
		foreach ($tt->find('section[class=rslwrp] section[class=jbbg]') as $block){	
				//echo $block;
				$hotelObject = new JDItem();	
				
				foreach ($block->find('section[class=jcar] section[class=jrcl] aside[class=compdt] p[class=jcnwrp] span[class=jcn] a') as $item_name)
				{
					//echo "Name:".$hotel_name->plaintext;
					$hotelObject->setItemURL($item_name->href);
			 		$hotelObject->setName($item_name->plaintext);
				}

				
				foreach ($block->find('section[class=jcar] section[class=jrcl] aside[class=compdt] p[class=jrcw]') as $contactNumber)
				{
					//echo "Contact Num:".$contactNumber;
					$hotelObject->setContact($contactNumber->plaintext);
				}
				foreach ($block->find('section[class=jcar] section[class=jrcl] aside[class=compdt] p[class=jaid] span[class=jaddt trans]') as $address)
				{
					//echo "Address:".$address->plaintext;
					$hotelObject->setAddress(str_replace("More...","",$address->plaintext));
					
					if (strpos($hotelObject->getAddress(),' - ') !== false){
					//echo "ID: ".$test['id']."--->". $test['address'].'</br>';
					
					$pieces = explode(",", safe($hotelObject->getAddress()));
					
					foreach ($pieces as $explodeItem){
						if(strpos($explodeItem,' - ')!==false){
							$hotelObject->setPinCode($explodeItem);	
						}
						}
					}
					
				}
				
				foreach ($block->find('section[class=jcar] section[class=jrcl] aside[class=compdt] p[class=jaid]  a[class=rsmap]') as $mpdata)
				{
						$myfile = fopen("mapdata.txt", "w");
						fwrite($myfile, $mpdata);
						fclose($myfile);												
						$myfl = fopen("mapdata.txt", "r") or die("Unable to open file!");
						$mapData= fgets($myfl);
						fclose($myfl);
						$hotelObject->setMapData("<xmp>".$mapData."</xmp>");
						
						$lon="";
						$lat="";						
						if($hotelObject->getMapData()!=NULL){
							$tmpo=get_string_between($hotelObject->getMapData(),"view_map_result('",");_ct");
							//echo "ID:".$tmpo."</br>";
							$arrayToExplode=get_string_between($tmpo,"'map',",",'bcard");
							$explodedpieces=explode(",", $arrayToExplode);
							
							$lon=$explodedpieces[1];
							$lat=$explodedpieces[2];
							
							$hotelObject->setLongitude($lon);
							$hotelObject->setLatitude($lat);
						}								
				}
				
				
				foreach ($block->find('section[class=jcar] section[class=jrcl] aside[class=trstfctr] ul li[class=estd]') as $estdin)
				{
					//echo "Estd In : ".$estdin;
					$hotelObject->setSince($estdin->plaintext);
				}
				
				foreach ($block->find('section[class=jcar] section[class=jrcl] aside[class=trstfctr] ul li[class=fctrtng]') as $rating)
				{
					//echo "Estd In : ".$rating;
					$hotelObject->setRating($rating->plaintext);
				}
			   
			   $hotelObject->setCategory($cat);
			
			   array_push($arrayOfHotelInfo,$hotelObject);
			
			}

			foreach ($tt->find('section[class=rslwrp] section[class=jgbg]') as $block){	
				echo $block;
				$hotelObject = new JDItem();	
				
				foreach ($block->find('section[class=jcar] section[class=jrcl] aside[class=compdt] p[class=jcnwrp] span[class=jcn] a') as $item_name)
				{
					//echo "Name:".$hotel_name->plaintext;
					$hotelObject->setItemURL($item_name->href);
			 		$hotelObject->setName($item_name->plaintext);
				}
				
				foreach ($block->find('section[class=jcar] section[class=jrcl] aside[class=compdt] p[class=jrcw]') as $contactNumber)
				{
					//echo "Contact Num:".$contactNumber;
					$hotelObject->setContact($contactNumber->plaintext);
				}
				foreach ($block->find('section[class=jcar] section[class=jrcl] aside[class=compdt] p[class=jaid] span[class=jaddt trans]') as $address)
				{
					//echo "Address:".$address->plaintext;
					$hotelObject->setAddress(str_replace("More...","",$address->plaintext));
					
					if (strpos($hotelObject->getAddress(),' - ') !== false){
						//echo "ID: ".$test['id']."--->". $test['address'].'</br>';
						
						$pieces = explode(",", safe($hotelObject->getAddress()));
						
						foreach ($pieces as $explodeItem){
							if(strpos($explodeItem,' - ')!==false){
								$hotelObject->setPinCode($explodeItem);	
							}
						}
					}
				}
				
				foreach ($block->find('section[class=jcar] section[class=jrcl] aside[class=compdt] p[class=jaid]  a[class=rsmap]') as $mpdata)
				{
							$myfile = fopen("mapdata.txt", "w");
							fwrite($myfile, $mpdata);
							fclose($myfile);
							
							
							$myfl = fopen("mapdata.txt", "r") or die("Unable to open file!");
							$mapData= fgets($myfl);
							fclose($myfl);
							$hotelObject->setMapData("<xmp>".$mapData."</xmp>");

							$lon="";
							$lat="";						
							if($hotelObject->getMapData()!=NULL){
								$tmpo=get_string_between($hotelObject->getMapData(),"view_map_result('",");_ct");
								//echo "ID:".$tmpo."</br>";
								$arrayToExplode=get_string_between($tmpo,"'map',",",'bcard");
								$explodedpieces=explode(",", $arrayToExplode);
								
								$lon=$explodedpieces[1];
								$lat=$explodedpieces[2];
	
								$hotelObject->setLongitude($lon);
								$hotelObject->setLatitude($lat);
							}			
				}
							
				foreach ($block->find('section[class=jcar] section[class=jrcl] aside[class=trstfctr] ul li[class=estd]') as $estdin)
				{
					//echo "Estd In : ".$estdin;
					$hotelObject->setSince($estdin->plaintext);
				}
				
				foreach ($block->find('section[class=jcar] section[class=jrcl] aside[class=trstfctr] ul li[class=fctrtng]') as $rating)
				{
					//echo "Estd In : ".$rating;
					$hotelObject->setRating($rating->plaintext);
				}			   
			   $hotelObject->setCategory($cat);			
			   array_push($arrayOfHotelInfo,$hotelObject);
			
			}
		
		foreach ($arrayOfHotelInfo as $hotel) 
		{
	
			$sql='INSERT INTO `justdial`.'.$table_name.'(`id`,`name`,`contact`, 
			`site`,`address`,`pincode`, `since`, `rating`, `mapdata`,`longitude`,
			`latitude`,`img`,`category`,`subcategory`,`itemurl`) 
			VALUES (NULL,"'.safe($hotel->getName()).'",
			"'.safe($hotel->getContact()).'",
			"'.safe($hotel->getSite()).'",
			"'.safe($hotel->getAddress()).'",
			"'.safe($hotel->getPinCode()).'",
			"'.safe($hotel->getSince()).'",
			"'.safe($hotel->getRating()).'",
			"'.safe($hotel->getMapData()).'",
			"'.safe(str_replace("'","",$hotel->getLongitude())).'",
			"'.safe(str_replace("'","",$hotel->getLatitude())).'", 
			"'.safe($hotel->getImg()).'",
			"'.safe($hotel->getCategory()).'",
			"'.safe($subcat).'",
			"'.safe($hotel->getItemURL()).'")';
			
			echo $sql.'<br>';			
			$dataBaseHelper = new databaseHelper();
			$insertedID=$dataBaseHelper->ExecuteInsertReturnID($sql);
			
			/*
			 * Dealing with the 2nd layer
			 */
			//$hotelObject->setSite(GetInnserData($hotel->getItemURL(),$insertedID));
			
			//$updateSQL='update jd_health_care set site="'.safe(GetInnserData($hotel->getItemURL(),$insertedID)).'" where id="'.$insertedID.'"';
			//echo $updateSQL.'</br>';
			//$dataBaseHelper->ExecuteNonQuery($updateSQL);
	    }
		
}

//No more in use now
function GetInnserData($siteURL,$insertedID) {
		sleep(5);
		$tt = file_get_html($siteURL);
		sleep(10);
		$tmpID=$insertedID;
		$websiteOfItem="";
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
						$sqlInnerData='INSERT INTO '.$table_name_opdtm.' (`days`, `duration`, `id`) VALUES ("'.safe($exploded[0]).'","'.safe($exploded[1]).'","'.safe($tmpID).'")';
						$dataBaseHelper = new databaseHelper();
						$insertedID=$dataBaseHelper->ExecuteInsertReturnID($sqlInnerData);
						//echo $sqlInnerData.'</br>';
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



/*
 * Utility Functions are here
 */

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