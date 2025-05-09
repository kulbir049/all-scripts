<?php
 
// Include Composer autoloader if not already done.
require 'vendor/autoload.php';
 
// Parse pdf file and build necessary objects.
$parser = new \Smalot\PdfParser\Parser();
$pdf    = $parser->parseFile('Pathetique-Sonata-8-Adagio-string-parts-score.pdf');
 
// Retrieve all pages from the pdf file.
$pages  = $pdf->getPages();
 
// Loop over each page to extract text.
foreach ($pages as $page) {
    echo $page->getText();
}
 
?>