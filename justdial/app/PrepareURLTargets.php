<?php 
set_time_limit(0);
include_once('../simple_html_dom.php');
$url="http://www.justdial.com/Delhi-NCR/Ladies-Suit-Retailers/ct-484312";
$innerHtml = file_get_html($url);

foreach ($innerHtml->find('ul[class=jcc] li a') as $block){	
	if($block->plaintext=="Also use Justdial for"){
		break;
	}
	else
	{
		echo "\"".$block->href."\",</br>";
		//echo $block->plaintext."</br>";
	}
}
?>