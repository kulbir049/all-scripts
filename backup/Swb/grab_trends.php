<?php
 unlink('trending.txt');
$fp = fopen("trending.txt", "a");


$url = "https://www.google.com/trends/hottrends/atom/hourly";
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
$output = curl_exec($curl);
curl_close($curl);

$DOM = new DOMDocument;
$DOM->loadHTML( $output);

//get all H1
$items = $DOM->getElementsByTagName('li');

//display all H1 text
 for ($i = 0; $i < $items->length; $i++){
        $txt = $items->item($i)->nodeValue;
        fwrite($fp, $txt."|");
        
        }
        
        fclose($fp);
        

?>