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
     * Login action
     */
    public function indexAction()
    {
        switch (App::$request->getMethod()) {
            case 'GET':
                echo file_get_contents(__DIR__ . '/../views/auth.html');
                break;
            case 'POST':
                $request = App::$request->post();
                $code = false;
                if (!empty($request['login']) 
                        && !empty($request['password'])
                        && $request['login'] == 'root'
                        && $request['password'] == '111111'
                ) {
                    //We should store this code with user, because we need link messenger id with our account id during account_linking process
                    $code = uniqid();
                }
                $redirectUrl = App::$request->get('redirect_uri');
                header('Location: ' .  $redirectUrl . ($code ? '&authorization_code=' . $code : ''));
                break;

            default:
                break;
        }
        return;
    }

}
