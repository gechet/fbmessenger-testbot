<?php

namespace gechet\controllers;

use gechet\app\App;

/**
 * 
 * @author Serhii Chepela <scheoriginal@gmail.com>
 */
abstract class Controller
{

    abstract public function indexAction();

    /**
     */
    protected function selectAction()
    {
        $action = App::$request->get('action') . 'Action';

        if (method_exists($this, $action)) {
            $this->$action();
        } else {
            $this->indexAction();
        }
    }

    /**
     * Базовый класс контроллера
     */
    public function run()
    {
        $this->selectAction();
    }

}
