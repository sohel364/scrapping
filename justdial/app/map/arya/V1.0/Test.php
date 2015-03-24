<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
</head>
<body>
   <!-- <b>Testing tool Address Type a address submit...</b></br>
	<b>Type Address : </b>
    <textarea id="txtAddress" rows="3" cols="25"></textarea>
    <br />
    <input type="button" onclick="GetLocation()" value="Get Location" />
	 --> 
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <script type="text/javascript">

		var str=null;

    	function TT(param){
        	alert("Passed : "+param);
        }
    	
    	var latitude = null;
    	var longitude = null;
    	var adrss=null;
    	var dataFinal = null;
        function GetLocation(adrs) {
        	adrss=adrs;
			//alert(adrs);
           // var address=adrs;
            var geocoder = new google.maps.Geocoder();
           // var address = document.getElementById("txtAddress").value;
            geocoder.geocode({ 'address': adrss }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                     latitude = results[0].geometry.location.lat();
                     longitude = results[0].geometry.location.lng();
                     alert("Address:"+adrss+" Latitude: " + latitude + "Longitude: " + longitude);

                     dataFinal=latitude+","+longitude;
                     
                     Test();
                     //setInterval(function(){alert('Hello')},3000);
                     //alert(Test());
                     
                } else {
                    alert("Request failed.");
                }
            });
        };

        setTimeout(function(){
            //do what you need here
        }, 5);

        function Test(){
        
        	var jqXHR =$.ajax({
        	  type: 'POST',
        	  url: 'get_data.php',
        	  data: {
        		      dat    : dataFinal
//        	          lon :  longitude,
//        	          lat :  latitude,
//        	          adrs:  adrss
        	        },
        	  async:false,
        	  success: function(){
        	      //code on success
              	  alert("Done");
        	  },
        	  dataType: 'html'
        	});

        	return jqXHR.responseText;
        }
</script>

 <?php
	$sql="SELECT `product_supplier_address` FROM `product`where `product_id`<'20000'";
	$tmpData=databaseHelper::ExecuteDataSet($sql);	
	foreach ($tmpData as $itm) {
		if($itm!=null){
			//echo $itm[0].'</br>';
			
			$myval= substr($itm[0], 0, strrpos($itm[0], ","));
			echo $myval;
			?>
			<script> 
			 
			 str=<?=json_encode($myval)?>;
			 
			 GetLocation(str);
			 
			</script> 
			<?php 
		}
	}
	

	//echo "Lon :".$_POST['lon']." Lat : ".$_POST['lat'];
	
	
	
class databaseHelper{
		public function ExecuteDataSet($sql)
        {
            $RowsAffected = 0;
            
            try
            {
            
      		$connection = mysql_connect("localhost", "root", "") or die('Unable to connect!');                
	        mysql_select_db("indiamart")  or die('Unable to select database!');
            $result = mysql_query($sql)  or die("Error in query: $sql.".mysql_error()); 
             
            }
            
            catch (Exception $e)
                        
            {
                
            } 
         $DataSet  = array(null);
         while( $values = mysql_fetch_array($result))
          {

                
                array_push($DataSet, $values);//ataSet = $values; 

          }  
            return $DataSet;
        }

		}
     	?>

  
</body>
</html>