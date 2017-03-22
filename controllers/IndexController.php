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
                App::log('Request: ' . json_encode(['request' => $request, 'config' => App::$config]));
                if (empty($request['hub_mode']) 
                        || empty($request['hub_verify_token'])
                        || $request['hub_mode'] != 'subscribe'
                        || $request['hub_verify_token'] != App::$config['verifyToken']
                ) {
                    return false;
                }
                return $request['hub_challenge'];
            case 'POST':


                break;

            default:
                break;
        }
    }

}
