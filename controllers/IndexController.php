<?php

namespace gechet\controllers;

use gechet\controllers\Controller;
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
                $request = App::$request->get();
                App::log($request);
                if (empty($request['hub_mode']) 
                        || empty($request['hub_verify_token'])
                        || $request['hub_mode'] != 'subscribe'
                        || $request['hub_verify_token'] != App::$config['verifyToken']
                ) {
                    return false;
                }
                echo $request['hub_challenge'];
            case 'POST':
                $request = App::$request->post();
                App::log($request);

                break;

            default:
                break;
        }
    }

}
