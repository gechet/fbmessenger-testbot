<?php

namespace gechet\controllers;

use gechet\app\App;

/**
 *
 * @author Serhii Chepela <scheoriginal@gmail.com>
 */
class IndexController extends Controller
{

    /**
     * 
     */
    public function indexAction()
    {
        switch (App::$request->getMethod()) {
            case 'GET':
                echo file_get_contents(__DIR__ . '/../views/auth.php');
                break;
            case 'POST':
                $request = App::$request->post();
                
                break;

            default:
                break;
        }
        return;
    }

}
