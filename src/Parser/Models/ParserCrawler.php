<?php

namespace Parser\Models;

use Parser\ParserInterface;

/**
 * Class ParserCrawler
 * @package Parser\Models
 */
class ParserCrawler
{
    /** @var ParserInterface  */
    protected $parserProvider;

    /**
     * ParserCrawler constructor.
     * @param ParserInterface $parserProvider
     */
    public function __construct(ParserInterface $parserProvider)
    {
        $this->parserProvider = $parserProvider;
    }

    /**
     * @param string $url
     * @param string $word
     * @return array
     */
    public function mainMixer(string $url, string $word): array 
    {
        $result = $this->parserProvider->getResponseRemoteServer($url, $word);
        
        $countResult = $this->parserProvider->countResult($result);
        
        return $countResult;
    }
}