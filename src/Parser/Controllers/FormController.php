<?php

namespace Parser\Controllers;

class FormController
{
    public function actionIndex()
    {
        if (isset($_POST['word'])) {
            $data = $_POST['word'];
        } else {
            $data = null;
        }
        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../view');
        $twig = new \Twig_Environment($loader);
        $template = $twig->load('form/index.html');
        $result = $template->render([
            'data' => $data,
        ]);
        return $result;
    }
}