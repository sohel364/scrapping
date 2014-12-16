<?php 

class product{
	
private $_product_details;  
private $_product_id;  
private $_product_supplier_address; 
private $_product_supplier_company; 
private $_product_supplier_contact_number;
private $_product_supplier_website;
private $_product_title;
private $_sub_category_id;

public function Set($key){
	$this->key=$key;
}
public function Get(){
	return $var;
}	

public function  SetProductDetails($productdetails){
	$this->_product_details=$productdetails;
}
public function  GetProductDetails(){
	return $this->_product_details;
}

public function SetProductId($productid){
	$this->_product_id=$productid;
}
public function getProductId(){
	return $this->_product_id;
}	

public function SetProductSupplierAddress($productsupplieraddress){
	$this->_product_supplier_address=$productsupplieraddress;
}
public function GetProductSupplierAddress(){
	return $this->_product_supplier_address;
}
	
public function SetProductSupplierCompany($productsuppliercompany){
	$this->_product_supplier_company=$productsuppliercompany;
}
public function GetProductSupplierCompany(){
	return $this->_product_supplier_company;
}	

public function SetProductSupplierContactNumber($productsuppliercontactnumber){
	$this->_product_supplier_contact_number=$productsuppliercontactnumber;
}
public function GetProductSupplierContactNumber(){
	return $this->_product_supplier_contact_number;
}

public function SetProductSupplierWebsite($productsupplierwebsite){
	$this->_product_supplier_website=$productsupplierwebsite;
}
public function GetProductSupplierWebsite(){
	return $this->_product_supplier_website;
}	

public function SetProductTitle($producttitle){
	$this->_product_title=$producttitle;
}
public function GetProductTitle(){
	return $this->_product_title;
}	
	

}




?>