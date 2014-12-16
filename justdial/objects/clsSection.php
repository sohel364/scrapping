<?php
class Section {
	private $_section_id;
	private $_section_Name;
	private $_src;
	
	public function setSectionId($sectionid){
		$this->_section_id=$sectionid;
	}
	public function getSectionId(){
		return $this->_section_id;
	}
	
	public function setSectionName($sectionname){
		$this->_section_Name=$sectionname;
	}
	public function getSectionName(){
		return $this->_section_Name;
	}
	
	public function setSrc($src){
		$this->_src=$src;
	}
	public function getSrc(){
		return $this->_src;
	}
	

}


?>
