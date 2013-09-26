<?php
namespace Ouzo\Routing;

use Ouzo\Uri;
use Ouzo\Utilities\Arrays;

class RouteRule
{
    private $_method;
    private $_uri;
    private $_action;

    public function __construct($method, $uri, $action)
    {
        $this->_method = $method;
        $this->_uri = $uri;
        $this->_action = $action;
    }

    public function getMethod()
    {
        return $this->_method;
    }

    public function getUri()
    {
        return $this->_uri;
    }

    public function getController()
    {
        $elements = explode('#', $this->_action);
        return $elements[0];
    }

    public function getAction()
    {
        $elements = explode('#', $this->_action);
        return Arrays::getValue($elements, 1);
    }

    public function matches($uri)
    {
        if ($this->_isEqualOrAnyMethod()) {
            return $this->_matches($uri);
        }
        return false;
    }

    private function _isEqualOrAnyMethod()
    {
        return is_array($this->_method) ? in_array(Uri::getRequestType(), $this->_method) : Uri::getRequestType() == $this->_method;
    }

    private function _matches($uri)
    {
        if ($this->getUri() == $uri) {
            return true;
        }
        if (preg_match('#:\w*#', $this->getUri())) {
            $replacedUri = preg_replace('#:\w*#', '\w*', $this->getUri());
            return preg_match('#^' . $replacedUri . '$#', $uri);
        }
        if (!$this->getAction()) {
            return preg_match('#' . $this->getUri() . '#', $uri);
        }
        return false;
    }
}