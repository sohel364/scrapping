<?php 
include_once('../simple_html_dom.php');
$html= file_get_html('http://www.justdial.com/Delhi-NCR/Hotels/ct-303533/page-20');

//echo $html;

foreach ($html->find('section[class=jmc] section[class=rslwrp]') as $data){
	echo $data;
}

?>