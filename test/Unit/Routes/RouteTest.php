<?php

namespace Bleicker\FastRoute\RequestHandler\Tests\Unit\Routes;

use Bleicker\FastRoute\RequestHandler\Routes\Route;
use Bleicker\FastRoute\RequestHandler\Tests\Unit\Fixtures\Controller\RoutableController;
use PHPUnit_Framework_TestCase as UnitTestCase;

/**
 * Class RouteTest
 *
 * @package Bleicker\FastRoute\RequestHandler\Tests\Unit\Routes
 */
class RouteTest extends UnitTestCase
{

    /**
     * @test
     */
    public function routeTest()
    {
        $route = new Route('get', 'foo/bar/baz', RoutableController::class, 'exampleAction');
        $this->assertEquals('get', $route->getRequestMethod());
        $this->assertEquals('foo/bar/baz', $route->getPathPattern());
        $this->assertEquals(RoutableController::class, $route->getControllerClassName());
        $this->assertEquals('exampleAction', $route->getMethodName());
        $this->assertEquals(
            'get foo/bar/baz => Bleicker\FastRoute\RequestHandler\Tests\Unit\Fixtures\Controller\RoutableController::exampleAction',
            $route->getIdentity()
        );
    }
}
