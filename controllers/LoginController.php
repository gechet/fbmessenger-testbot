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
                App::log($request);
                $code = false;
                if (!empty($request['login']) 
                        && !empty($request['password'])
                        && $request['login'] == 'root'
                        && $request['password'] == '111111'
                ) {
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
