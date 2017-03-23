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
     * Select action on controller
     * If there is no such action - default indexAction will work
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
     * Controller entry point
     */
    public function run()
    {
        return $this->selectAction();
    }

}
