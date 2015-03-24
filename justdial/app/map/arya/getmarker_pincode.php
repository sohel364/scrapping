<?php
//include("config.php");
$host = "localhost";
$user = "root";
$password = "";
$database_name = "db_shop"; 
$mysqli = new mysqli($host, $user, $password, $database_name); 
?>
<?php
$json_response = array();

$sql ="SELECT * FROM tbl_aa WHERE lat IS NOT NULL ";
//$sql = "SELECT * FROM tbl_shopinfo where device_id = '$device' and created_date = '$date' ";
$result = $mysqli->query($sql);

//echo '{"posts": [';
while($row=$result->fetch_array())
{
$row_array['Latitude'] = $row['lat'];
$row_array['Longitude'] = $row['lng'];
$row_array['ID'] = $row['id'];

 array_push($json_response,$row_array);
}

echo json_encode($json_response);


//$lat=$row['lat'];
//$long=$row['lng'];
//$id=$row['id'];
//$loc_detail=$row['Detail'];
//$des=$row[''];
/*echo '
{
"Latitude":"'.$lat.'",
"Longitude":"'.$long.'",
"ID":"'.$id.'"
},'; 
}
echo ']}';*/
?>