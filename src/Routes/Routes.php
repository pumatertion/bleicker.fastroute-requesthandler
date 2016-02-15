<?php

namespace Bleicker\FastRoute\RequestHandler\Routes;

use Bleicker\FastRoute\RequestHandler\Controller\ControllerInterface;
use Bleicker\FastRoute\RequestHandler\Routes\Exceptions\NoRoutableControllerException;
use Bleicker\FastRoute\RequestHandler\Routes\Exceptions\NoRoutableMethodException;
use Bleicker\FastRoute\RequestHandler\Routes\Exceptions\RouteAlreadyExistsException;
use ReflectionClass;

/**
 * Class Route
 *
 * @package Bleicker\FastRoute\RequestHandler\Routes
 */
class Routes implements RoutesInterface
{

    /**
     * @var Route[]
     */
    public static $routeRegister = [];

    /**
     * @param string $requestMethod
     * @param string $pathPattern
     * @param string $controllerClassName
     * @param string $methodName
     *
     * @return void
     * @throws RouteAlreadyExistsException
     * @throws NoRoutableControllerException
     * @throws NoRoutableMethodException
     */
    public static function add($requestMethod, $pathPattern, $controllerClassName, $methodName)
    {
        $route = new Route($requestMethod, $pathPattern, $controllerClassName, $methodName);
        if (array_key_exists($route->getIdentity(), static::$routeRegister)) {
            throw new RouteAlreadyExistsException('Route ' . $route->getIdentity() . ' already exists', 1455199265);
        }

        $controllerClassNameReflection = new ReflectionClass($controllerClassName);
        if (!$controllerClassNameReflection->implementsInterface(ControllerInterface::class)) {
            throw new NoRoutableControllerException($controllerClassName . ' must implement ' . ControllerInterface::class, 1455199942);
        }

        $methodReflection = $controllerClassNameReflection->getMethod($methodName);
        if ($methodReflection->isPrivate()) {
            throw new NoRoutableMethodException($controllerClassName . '::' . $methodName . ' must not be private', 1455199943);
        }
        if ($methodReflection->isStatic()) {
            throw new NoRoutableMethodException($controllerClassName . '::' . $methodName . ' must not be static', 1455199944);
        }
        if ($methodReflection->isProtected()) {
            throw new NoRoutableMethodException($controllerClassName . '::' . $methodName . ' must not be protected', 1455199945);
        }

        static::$routeRegister[$route->getIdentity()] = $route;
    }

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }

    /**
     * @codeCoverageIgnore
     */
    private function __clone()
    {
    }
}
