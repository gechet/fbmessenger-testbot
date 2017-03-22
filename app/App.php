<?php

namespace gechet\app;

use gechet\app\Request;

/**
 * Collection of objects
 *
 * @author Serhii Chepela <scheoriginal@gmail.com>
 */
class App
{
    
    /**
     * Request obj
     * @var Request 
     */
    public static $request;
    
    /**
     * Config array
     * @var array 
     */
    public static $config;
    
    public static function log($string)
    {
        $log = fopen(__DIR__ . '/app.log', 'a+');
        fwrite($log, json_encode(['data' => $string]) . PHP_EOL);
        fclose($log);
    }

}
