<?php

namespace app\models;

/**
 * Description of Model
 *
 * @author original
 */
abstract class Model
{
    public function __construct(array $config = [])
    {
        foreach ($config as $key => $value) {
            if (isset($this->$key)) {
                $this->$key = $value;
            }
        }
    }
}
