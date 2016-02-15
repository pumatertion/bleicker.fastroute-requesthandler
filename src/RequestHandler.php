<?php

namespace Bleicker\FastRoute\RequestHandler;

use Bleicker\FastRoute\RequestHandler\Controller\ControllerInterface;
use Bleicker\FastRoute\RequestHandler\Routes\Exceptions\NotAllowedException;
use Bleicker\FastRoute\RequestHandler\Routes\Exceptions\NotFoundException;
use Bleicker\FastRoute\RequestHandler\Routes\Route;
use Bleicker\FastRoute\RequestHandler\Routes\Routes;
use FastRoute\Dispatcher;
use FastRoute;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class RequestHandler
 *
 * @package Bleicker\FastRoute\RequestHandler
 */
class RequestHandler
{

    /**
     * @param RequestInterface $request
     *
     * @return ResponseInterface
     * @throws NotFoundException
     * @throws NotAllowedException
     */
    public function handleRequest(RequestInterface $request)
    {
        $routeInfo = $this->getRouteDispatcher()->dispatch($request->getMethod(), $request->getUri()->getPath());

        switch ($routeInfo[0]) {
            case FastRoute\Dispatcher::NOT_FOUND:
                throw new NotFoundException('Route does not exists', 1454960908);
            case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                throw new NotAllowedException('Method not allowed', 1454960909);
        }

        /** @var Route $route */
        $route = $routeInfo[1];

        $controllerClassName = $route->getControllerClassName();
        $methodName = $route->getMethodName();
        $methodArguments = $routeInfo[2];

        /** @var ControllerInterface $controller */
        $controller = new $controllerClassName();

        return $controller->processRequest(
            $methodName,
            $methodArguments,
            $request
        );
    }

    /**
     * @return Dispatcher
     */
    protected function getRouteDispatcher()
    {
        $dispatcher = FastRoute\simpleDispatcher(
            function (FastRoute\RouteCollector $r) {
                $routes = Routes::$routeRegister;
                foreach ($routes as $route) {
                    $r->addRoute(
                        $route->getRequestMethod(),
                        $route->getPathPattern(),
                        $route
                    );
                }
            }
        );
        return $dispatcher;
    }
}
