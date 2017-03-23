<?php

namespace gechet\app;

/**
 *
 * @author Serhii Chepela <scheoriginal@gmail.com>
 */
class Request
{

    /**
     * Get GET data
     * @param string $name
     * @return mixed 
     */
    public function get($name = null)
    {
        return $this->getData('get', $name);
    }

    /**
     * Get body request data
     * @param string $name
     * @return mixed
     */
    public function body($name = null)
    {
        return $this->getData('body', $name);
    }
    
    /**
     * Get POST data
     * @param string $name
     * @return mixed
     */
    public function post($name = null)
    {
        return $this->getData('post', $name);
    }
    
    /**
     * Get data from selected source by name or just all data
     * @param string $type
     * @param string $name
     * @return string|array
     */
    protected function getData($type, $name)
    {
        switch ($type) {
            case 'get':
                $data = $_GET;
                break;
            case 'post':
                $data = $_POST;
                break;
            case 'body':
                $data = json_decode(file_get_contents('php://input'), true);
                break;
            default :
                $data = $_GET;
                break;
        }
        if ($name) {
            $value = isset($data[$name]) ? $data[$name] : null;
        } else {
            $value = $data;
        }
        return $value ? $this->clearData($value) : null;
    }
    
    /**
     * Clear data from html special chars
     * @param array|string $data
     * @return array|string
     */
    protected function clearData($data)
    {
        if (!is_array($data)) {
            return htmlspecialchars($data);
        }
        $temp = [];
        foreach ($data as $key => $value) {
            $temp[$key] = $this->clearData($value);
        }
        return $temp;
    }
    
    /**
     * Get current method
     * @return string
     */
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
     * Get route to current action
     * @return array
     */
    public function getRoute()
    {
        $route = $this->get('r');
        if (!$route) {
            return ['controller' => 'index', 'action' => 'index'];
        }
        $route = explode('/', $route);
        return ['controller' => $route[0], 'action' => isset($route[1]) ? $route[1] : 'index'];
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
