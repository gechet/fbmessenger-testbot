<?php

namespace gechet\controllers;

use gechet\app\App;
use app\models\Message;

/**
 *
 * @author Serhii Chepela <scheoriginal@gmail.com>
 */
class IndexController extends Controller
{

    /**
     * Basic webhook action
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
                $request = App::$request->body();
                App::log($request);
                if ($request['object'] == 'page') {
                    foreach ($request['entry'] as $entry) {
                        foreach ($entry['messaging'] as $post) {
                            if (!empty($post['message'])) {
                                (new Message($post))->answer();
                            } elseif (!empty($post['postback'])) {
                                
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
