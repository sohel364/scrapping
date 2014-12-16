<?php 
include_once '../simple_html_dom.php';
$html = file_get_html('http://www.justdial.com/');

echo $html;

foreach ($html->find('section[class=jw]') as $baby){
	echo $baby;
}
?>