<?php

namespace gechet\controllers;

use gechet\controllers\Controller;
use gechet\app\App;
use app\models\Message;

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
                die($request['hub_challenge']);
            case 'POST':
                $request = App::$request->post();
                if ($request['object'] == 'page') {
                    foreach ($request['entry'] as $entry) {
                        foreach ($entry['messaging'] as $post) {
                            if ($post['message']) {
                                (new Message($message))->answer();
                            } elseif ($post['postback']) {
                                
                            }
                        }
                    }
                }
                break;

            default:
                break;
        }
        return;
    }

}
