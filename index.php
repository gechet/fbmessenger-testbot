<?php

function __autoload($class)
{
    $parts = explode('\\', $class);
    for ($i = 1; $i < count($parts); $i++) {
        $sdn .= $parts[$i] . '/';
    }
    $sdn = substr($sdn, 0, -1) . '.php';
    require_once($sdn);
}

$bootstrap = (new gechet\app\Bootstrap())->run();
