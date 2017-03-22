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
     */
    public function run()
    {
        (new IndexController())->indexAction();
    }

}
