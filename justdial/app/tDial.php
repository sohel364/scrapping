<?php
include_once('../simple_html_dom.php');


//$html= file_get_html('file:///C:/Users/simon/Zend/workspaces/DefaultWorkspace/RemoteSystemsTempFiles/LOCALHOST/c/xampp/htdocs/justdial/app/testfile.html');
//$html= file_get_html('http://www.justdial.com/Delhi-NCR/71/Hotels_b2c');

$html= file_get_html('file:///C:/xampp/htdocs/justdial/app/testfile.html');
//echo "$html";

//$myfile = fopen("testfile.html", "w");
//fwrite($myfile, $html);
//fclose($myfile);

//header('location: '. $myfile);

//exit;
////$tt = file_get_html('http://localhost/justdial/app/tDial.php');

//echo tt;



//echo $html;

foreach ($html->find('section[class=fltc]') as $data){
	echo $data;
}

?>