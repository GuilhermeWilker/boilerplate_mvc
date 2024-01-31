<?php

namespace core\library;

use Exception;

class TemplateEngine 
{
    private ?string $layout;
    private string $content;
    private array $data;

    private function load()
    {
        return !empty($this->content) ? $this->content : '';
    }

    private function extends(string $view, array $data = [])
    {
        $this->layout = $view;
        $this->data = $data;
    }
    
    public function render (string $view, array $data)
    {
        $view = dirname(__FILE__, 3). "/app/views/{$view}.php";

        if (!file_exists($view)) {
            throw new \Exception("View {$view} not found..");
        }

        ob_start();

        extract($data);

        require $view;
        $content = ob_get_contents();

        ob_end_clean();

        if (!empty($this->layout)) {
            $this->content = $content;
            $data = array_merge($this->data, $data);
            $layout = $this->layout;

            $this->layout = null;

            return $this->render($layout, $this->data);
        }

        return $content;
    }
}