<?php

namespace Parser\Controllers;

use Parser\Models\Parser;
use Parser\Models\ParserCrawler;

/**
 * Class FormController
 * @package Parser\Controllers
 */
class FormController
{
    /**
     * @return array|string
     */
    public function actionIndex()
    {
        $url = '#';
        if (isset($_POST['word'])) {
            $data = $_POST['word'];
            
            $parsObject = new Parser();
            $crawler = new ParserCrawler($parsObject);
            
            $result = $crawler->mainMixer($url, $data);
            $countResult = $result;
        } else {
            $data = null;
            $countResult = null;
        }
        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../view');
        $twig = new \Twig_Environment($loader);
        $template = $twig->load('form/index.html');
        $result = $template->render([
            'data' => $data,
            'count' => $countResult
        ]);
        
        return $result;
    }
}