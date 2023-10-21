<?php
require_once 'HTMLProcessor.php';

$html = file_get_contents('template.html');

$htmlProcessor = new HTMLProcessor($html);
$htmlProcessor->removeTitles();

$metaTagsToRemove = ['description', 'keywords'];
$htmlProcessor->removeMetaTags($metaTagsToRemove);

$modifiedHtml = $htmlProcessor->getModifiedHtml();

echo $modifiedHtml;
?>