<?php

namespace Bleicker\FastRoute\RequestHandler\Tests\Unit\Routes;

use Bleicker\FastRoute\RequestHandler\Routes\Route;
use Bleicker\FastRoute\RequestHandler\Routes\Routes;
use Bleicker\FastRoute\RequestHandler\Tests\Unit\Fixtures\Controller\NotRoutableController;
use Bleicker\FastRoute\RequestHandler\Tests\Unit\Fixtures\Controller\RoutableController;
use PHPUnit_Framework_TestCase as UnitTestCase;

/**
 * Class RoutesTest
 *
 * @package Bleicker\FastRoute\RequestHandler\Tests\Unit\Routes
 */
class RoutesTest extends UnitTestCase
{

    protected function tearDown()
    {
        parent::tearDown();
        Routes::$routeRegister = [];
    }

    /**
     * @test
     */
    public function registerRouteTest()
    {
        Routes::add('get', 'foo/bar/baz', RoutableController::class, 'routableAction');
        $routeRegister = Routes::$routeRegister;
        $route = array_shift($routeRegister);
        $this->assertInstanceOf(Route::class, $route);
    }

    /**
     * @test
     * @expectedException \Bleicker\FastRoute\RequestHandler\Routes\Exceptions\RouteAlreadyExistsException
     */
    public function registerRouteTwiceTest()
    {
        Routes::add('get', 'foo/bar/baz', RoutableController::class, 'routableAction');
        Routes::add('get', 'foo/bar/baz', RoutableController::class, 'routableAction');
    }

    /**
     * @test
     * @expectedException \Bleicker\FastRoute\RequestHandler\Routes\Exceptions\NoRoutableControllerException
     */
    public function targetControllerIsInvalidTest()
    {
        Routes::add('get', 'foo/bar/baz', NotRoutableController::class, 'routableAction');
    }

    /**
     * @test
     * @expectedException \Bleicker\FastRoute\RequestHandler\Routes\Exceptions\NoRoutableMethodException
     */
    public function targetMethodIsPrivateTest()
    {
        Routes::add('get', 'foo/bar/baz', RoutableController::class, 'privateAction');
    }

    /**
     * @test
     * @expectedException \Bleicker\FastRoute\RequestHandler\Routes\Exceptions\NoRoutableMethodException
     */
    public function targetMethodIsStaticTest()
    {
        Routes::add('get', 'foo/bar/baz', RoutableController::class, 'staticAction');
    }

    /**
     * @test
     * @expectedException \Bleicker\FastRoute\RequestHandler\Routes\Exceptions\NoRoutableMethodException
     */
    public function targetMethodIsProtectedTest()
    {
        Routes::add('get', 'foo/bar/baz', RoutableController::class, 'protectedAction');
    }
}
