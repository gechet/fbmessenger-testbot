<?php

namespace gechet\controllers;

use gechet\app\App;

/**
 *
 * @author Serhii Chepela <scheoriginal@gmail.com>
 */
class LoginController extends Controller
{

    /**
     * 
     */
    public function indexAction()
    {
        switch (App::$request->getMethod()) {
            case 'GET':
                echo file_get_contents(__DIR__ . '/../views/auth.html');
                break;
            case 'POST':
                $request = App::$request->post();
                $response = [];
                if (!empty($request['login']) 
                        && !empty($request['login'])
                        && $request['login'] == 'root'
                        && $request['password'] == '111111'
                ) {
                    $response['code'] = uniqid();
                }
                $response['redirectUrl'] = App::$request->get('redirect_uri');
                $response['linkingToken'] = App::$request->get('account_linking_token');
                header('Location: https://www.facebook.com/messenger_platform/account_linking?' . http_build_query($response));
                break;

            default:
                break;
        }
        return;
    }

}
