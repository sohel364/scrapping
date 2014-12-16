<?php 
include_once 'clsSection.php';

class Category{
	private $_category_id;
	private $_category_name;
	private $_section;
	private $_sub_category_list_url;

 	public function setCategoryId($categoryid){
  		$this->_category_id=$categoryid;
  	}
	public function getCategoryId(){
  		return $this->_category_id;
  	}
  
  	public function setCategoryName($categoryname){
  		$this->_category_name=$categoryname;
  	}
  	public function getCategoryName(){
  		return	$this->_category_name;
  	}
  	public function setSection($section){
  		if($section!=null){
  			$this->_section=$section;
  		}
  	}
  	public function getSection(){
  		if($this->_section!=NULL){
  			return $this->_section;	
  		}
  	}
  	
  	public function setSubCategoryLlistUrl($subcategorylisturl){
         $this->_sub_category_list_url=$subcategoryllisturl;  		
  	}
  	public function getSubCategoryLlistUrl(){
      return $this->_sub_category_list_url;    		
  	}
	
  	
  function __construct(){
  	if($this->_section==null){
  		$this->_section=new Section();
  	}
  }
}






?>