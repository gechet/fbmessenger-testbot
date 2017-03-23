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
        $action = App::$request->getRoute()['action'] . 'Action';

        if (method_exists($this, $action)) {
            return $this->$action();
        } else {
            return $this->indexAction();
        }
    }

    /**
     * 
     */
    public function run()
    {
        return $this->selectAction();
    }

}
