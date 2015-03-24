<?php 
class JDItem {
	private $name;
	private $contact;
	private $site;
	private $address;
	private $pinCode;
	private $since;
	private $rating;
	private $mapData;
	private $img;
	private $category;
	private $longitude;
	private $latitude;
	
	private $ItemURL;
	
	public $opDateTimeArray;
	
	public function setName($value){
		$this->name=$value;
	}
	public function getName(){
		return $this->name;
	}
			
	public function setContact($value){
		$this->contact=$value;
	}
	public function getContact(){
		return $this->contact;
	}
	
	public function setSite($value){
		$this->site=$value;
	}
	public function getSite(){
		return $this->site;
	}
	
	public function setAddress($value){
		$this->address=$value;
	}
	public function getAddress(){
		return $this->address;
	}
	
	public function setPinCode($value){
		$this->setPinCode=$value;
	}
	public function getPinCode(){
		return $this->pinCode;
	}
	
	public function setSince($value){
		$this->since=$value;
	}
	public function getSince(){
		return $this->since;
	}
	
	public function setRating($value){
		$this->rating=$value;
	}
	public function getRating(){
		return $this->rating;
	}
	
	public function setMapData($value){
		$this->mapData=$value;
	}
	public function getMapData(){
		return $this->mapData;
	}
	
	public function setImg($value){
		$this->img=$value;
	}
	public function getImg(){
		return $this->img;
	}
	
	public function setCategory($value){
		$this->category=$value;
	}
	public function getCategory(){
		return $this->category;
	}
	
	public function setLongitude($value){
		$this->longitude=$value;
	}
	public function getLongitude(){
		return $this->longitude;
	}
	
	public function setLatitude($value){
		$this->latitude=$value;
	}
	public function getLatitude(){
		return $this->latitude;
	}

	public function setItemURL($value){
		$this->ItemURL=$value;
	}
	public function getItemURL(){
		return $this->ItemURL;
	}
	
//	public function setOpDateTime($array){
//		
//	}
//	public function setOpDateTime(){
//		
//	}
	
 	public function MakeJDItemData($name,$contact,$site,$address,$pincode,$since,$rating,$mapData,$img,$category,$lon,$lat,$url){
 		$this->setName($name);
 		$this->setContact($contact);
 		$this->setSite($site);
 		$this->setAddress($address);
 		$this->setPinCode($pincode);
 		$this->setSince($since);
 		$this->setRating($rating);
 		$this->setMapData($mapData);
 		$this->setImg($img);
 		$this->setCategory($category);	
 		$this->setLongitude($lon);
 		$this->setLongitude($lat);
 		$this->setItemURL($url);
 		
 		return $this;
 	}
}


?>