<?php

namespace gechet\app;

use gechet\controllers\IndexController;

/**
 *
 * @author Serhii Chepela <scheoriginal@gmail.com>
 */
class Bootstrap
{

    /**
     * @var string 
     */
    protected $controller;

    public function __construct()
    {
        session_start(session_name('fb_bot'));
        if (!is_object(App::$request)) {
            App::$request = new Request();
        }
        App::$config = require __DIR__ . '/../config/main.php';
    }

    /**
     * @return boolean
     */
    protected function checkController()
    {
        $route = App::$request->getRoute();
        $controllerClassName = ucfirst($route['controller']) . 'Controller';
        $filename = 'controllers/' . $controllerClassName . '.php';
        if (file_exists($filename)) {
            $this->controller = 'gechet\\controllers\\' . $controllerClassName;
            return true;
        } else {
            return false;
        }
    }


    /**
     * 
     * @return type
     */
    protected function selectController()
    {
        if ($this->checkController()) {
            $controller = $this->controller;
            $controller = new $controller();
        } else {
            $controller = new IndexController();
        }
        return $controller->run();
    }

    /**
     */
    public function run()
    {
        return $this->selectController();
    }

}
