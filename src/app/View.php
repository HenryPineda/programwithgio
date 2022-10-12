<?php

namespace App;

class View
{
    public function __construct(protected string $view, protected array $params = [])
    {
    }

    public function render()
    {
        $pathFile = VIEW_PATH . '/'. $this->view . '.php';

        if(!file_exists($pathFile)){
            throw new NotFoundViewException();
        }

        ob_start();

        foreach ($this->params as $key => $value){
            $$key = $value;
        }

        include $pathFile;

       return (string) ob_get_clean();
    }

    public static function make(string $view, array $params = [])
    {
        return new static($view, $params);
    }

    public function __toString(): string
    {
        return $this->render();
    }

    public function __get(string $name)
    {

        if(isset($this->params[$name])){
            return $this->params[$name];
        }

        return null;
    }

}