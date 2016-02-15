<?php

namespace Bleicker\FastRoute\RequestHandler\Routes;

/**
 * Class Route
 *
 * @package Bleicker\FastRoute\RequestHandler\Routes
 */
class Route implements RouteInterface
{

    /**
     * @var string
     */
    protected $pathPattern;

    /**
     * @var string
     */
    protected $controllerClassName;

    /**
     * @var string
     */
    protected $methodName;

    /**
     * @var string
     */
    protected $requestMethod;

    /**
     * @param string $requestMethod
     * @param string $pathPattern
     * @param string $controllerClassName
     * @param string $methodName
     */
    public function __construct($requestMethod, $pathPattern, $controllerClassName, $methodName)
    {
        $this->requestMethod = $requestMethod;
        $this->controllerClassName = $controllerClassName;
        $this->methodName = $methodName;
        $this->pathPattern = $pathPattern;
    }

    /**
     * @return string
     */
    public function getControllerClassName()
    {
        return $this->controllerClassName;
    }

    /**
     * @return string
     */
    public function getMethodName()
    {
        return $this->methodName;
    }

    /**
     * @return string
     */
    public function getPathPattern()
    {
        return $this->pathPattern;
    }

    /**
     * @return string
     */
    public function getRequestMethod()
    {
        return $this->requestMethod;
    }

    /**
     * @return string
     */
    public function getIdentity()
    {
        return $this->getRequestMethod() . ' ' . $this->getPathPattern() . ' => ' . $this->getControllerClassName(
        ) . '::' . $this->getMethodName();
    }
}
