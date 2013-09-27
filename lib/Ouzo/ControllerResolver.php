<?php
namespace Ouzo;

use Ouzo\Routing\RouteRule;
use Ouzo\Utilities\Strings;

class ControllerResolver
{
    function __construct($controllerPath = "\\Controller\\")
    {
        $globalConfig = Config::getValue('global');
        $this->_defaultAction = $globalConfig['action'];
        $this->controllerPath = $controllerPath;
    }

    public function getController(RouteRule $routeRule, $action)
    {
        $controller = $routeRule->getController();
        $controllerName = Strings::underscoreToCamelCase($controller);
        $controller = $this->controllerPath . $controllerName . "Controller";

        $this->_validateControllerExists($controller);

        return new $controller($action, $routeRule);
    }

    private function _validateControllerExists($controller)
    {
        if (!class_exists($controller)) {
            throw new FrontControllerException('Controller does not exist: ' . $controller);
        }
    }
}