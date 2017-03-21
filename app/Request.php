<?php

namespace gechet\app;

/**
 *
 * @author Serhii Chepela <scheoriginal@gmail.com>
 */
class Request
{

    /**
     * @param string $name
     * @return mixed 
     */
    public function get($name = '')
    {
        $value = $name && isset($_GET[$name]) ? $_GET[$name] : $_GET;
        return $this->clearData($value);
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function post($name = '')
    {
        $value = $name && isset($_POST[$name]) ? $_POST[$name] : $_POST;
        return $this->clearData($value);
    }
    
    protected function clearData($data)
    {
        if (!is_array($data)) {
            return htmlspecialchars($data);
        }
        $temp = [];
        foreach ($data as $key => $value) {
            $temp[$key] = htmlspecialchars($value);
        }
        return $temp;
    }
    
    public function getMethod()
    {
        if (isset($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'])) {
            return strtoupper($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE']);
        }

        if (isset($_SERVER['REQUEST_METHOD'])) {
            return strtoupper($_SERVER['REQUEST_METHOD']);
        }

        return 'GET';
    }
    
    /**
     * Returns whether this is a GET request.
     * @return bool whether this is a GET request.
     */
    public function isGet()
    {
        return $this->getMethod() === 'GET';
    }

    /**
     * Returns whether this is an OPTIONS request.
     * @return bool whether this is a OPTIONS request.
     */
    public function isOptions()
    {
        return $this->getMethod() === 'OPTIONS';
    }

    /**
     * Returns whether this is a HEAD request.
     * @return bool whether this is a HEAD request.
     */
    public function isHead()
    {
        return $this->getMethod() === 'HEAD';
    }

    /**
     * Returns whether this is a POST request.
     * @return bool whether this is a POST request.
     */
    public function isPost()
    {
        return $this->getMethod() === 'POST';
    }

    /**
     * Returns whether this is a DELETE request.
     * @return bool whether this is a DELETE request.
     */
    public function isDelete()
    {
        return $this->getMethod() === 'DELETE';
    }

    /**
     * Returns whether this is a PUT request.
     * @return bool whether this is a PUT request.
     */
    public function isPut()
    {
        return $this->getMethod() === 'PUT';
    }

    /**
     * Returns whether this is a PATCH request.
     * @return bool whether this is a PATCH request.
     */
    public function isPatch()
    {
        return $this->getMethod() === 'PATCH';
    }

}
