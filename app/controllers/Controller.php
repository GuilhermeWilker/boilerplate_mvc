<?php

namespace app\controllers;

use core\library\TemplateEngine;
use Throwable;

abstract class Controller 
{
    public function view (string $view, array $data = [])
    {
        try {
            $templateEngine = new TemplateEngine;
            echo $templateEngine->render($view, $data);
        } catch(Throwable $t) {
            var_dump($t->getMessage());
        }
    }
}