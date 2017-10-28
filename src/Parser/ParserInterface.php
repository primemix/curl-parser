<?php

namespace Parser;

/**
 * Interface ParserInterface
 * @package Parser
 */
interface ParserInterface
{
    /**
     * @param $url string remote server
     * @param $searchWord string search word
     * @return string result
     */
    public function getResponseRemoteServer(string $url, string $searchWord): string ;

    /**
     * @param $HtmlDomDocument
     * @return array
     */
    public function countResult($HtmlDomDocument);
}