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
                if (empty($request['hub.mode']) 
                        || empty($request['hub.verify_token'])
                        || $request['hub.mode'] != 'subscribe'
                        || $request['hub.verify_token'] != App::$config['verifyToken']
                ) {
                    return false;
                }
                return $request['hub.challenge'];
            case 'POST':


                break;

            default:
                break;
        }
    }

}
