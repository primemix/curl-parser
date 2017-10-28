<?php

namespace Parser\Models;

use Exception;
use Parser\ParserInterface;
use Sunra\PhpSimple\HtmlDomParser;

/**
 * Class Parser
 * @package Parser\Models
 */
class Parser implements ParserInterface
{
    /** @var  string result url */
    protected $url;

    /** @var  integer count result */
    protected $result;

    /**
     * @param string $url
     * @param string $searchWord
     * @return string html DOM document
     * @throws Exception
     */
    public function getResponseRemoteServer(string $url, string $searchWord): string
    {
        $searchWord = iconv('UTF-8', 'windows-1251', $searchWord);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT,
            'Mozilla/5.0 AppleWebKit/537.4 (KHTML, like Gecko; compatible; Googlebot/2.1; +http://www.google.com/bot.html)'); //прикинулся гуглаботом
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_COOKIESESSION, true);
        curl_setopt($ch, CURLOPT_COOKIEJAR, dirname(__FILE__).'/../../../web/cookie/cookie.txt');
        curl_setopt($ch, CURLOPT_COOKIEFILE,  dirname(__FILE__).'/../../../web/cookie/cookie.txt');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            '# here is post query #' . $searchWord . '');
        $out = iconv('windows-1251', 'UTF-8', curl_exec($ch));

        if (!$out) {
            throw new Exception(curl_error($ch));
        }
        curl_close($ch);

        return $out;
    }

    /**
     * @param $out
     * @return array we need the first element ($matches[0])
     */
    public function countResult($out)
    {
        $html = HtmlDomParser::str_get_html( $out );
        $result = $html->find("[class=sresult]", 0)->outertext;
        if ($result === null) {
            return $matches[0] = 'not ¯\_(ツ)_/¯ found';
        } else {
            preg_match ('%\d+%', $result, $matches);
            return $matches[0];
        }
    }
}