<?php
namespace Bleicker\FastRoute\RequestHandler\Routes;

/**
 * Class Route
 *
 * @package Bleicker\FastRoute\RequestHandler\Routes
 */
interface RoutesInterface
{

    /**
     * @param string $requestMethod
     * @param string $pathPattern
     * @param string $controllerClassName
     * @param string $methodName
     *
     * @return void
     */
    public static function add($requestMethod, $pathPattern, $controllerClassName, $methodName);
}
