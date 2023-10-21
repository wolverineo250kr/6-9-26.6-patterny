<?php

class HTMLProcessor
{
    private $dom;
    private $head;

    public function __construct($html)
    {
        $this->dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $this->dom->loadHTML($html);
        libxml_use_internal_errors(false);
        $this->head = $this->dom->getElementsByTagName('head')->item(0);
    }

    public function removeTitles()
    {
        $titles = $this->dom->getElementsByTagName('title');
        foreach ($titles as $title) {
            $this->head->removeChild($title);
        }
    }

    public function removeMetaTags($tagsToRemove)
    {
        $metaTags = $this->dom->getElementsByTagName('meta');
        $metaTagsCount = $metaTags->length;

        for ($i = $metaTagsCount - 1; $i >= 0; $i--) {
            $metaTag = $metaTags->item($i);
            $name = $metaTag->getAttribute('name');

            if ($name && in_array($name, $tagsToRemove)) {
                $this->head->removeChild($metaTag);
            }
        }
    }

    public function getModifiedHtml()
    {
        $modifiedHtml = $this->dom->saveHTML();
        $modifiedHtml = html_entity_decode($modifiedHtml);
        return $modifiedHtml;
    }
}