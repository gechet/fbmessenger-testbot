<?php

namespace app\models;

use gechet\app\App;

/**
 * Description of Model
 *
 * @author original
 */
abstract class Model
{
    public function __construct(array $config = [])
    {
        App::log($config);
        foreach ($config as $key => $value) {
            if (isset($this->$key)) {
                $this->$key = $value;
            }
        }
    }
}
