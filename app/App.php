<?php

namespace gechet\app;

use gechet\app\Request;

/**
 * Collection of objects and common methods
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
    
    /**
     * Log data
     * @param array|string $data
     */
    public static function log($data)
    {
        $log = fopen(__DIR__ . '/app.log', 'a+');
        fwrite($log, json_encode(['data - ' . date('Y-m-d H:i:s') => $data]) . PHP_EOL);
        fclose($log);
    }

}
