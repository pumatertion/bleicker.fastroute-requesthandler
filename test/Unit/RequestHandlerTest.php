<?php

namespace Bleicker\FastRoute\RequestHandler\Tests\Unit;

use Bleicker\FastRoute\RequestHandler\RequestHandler;
use Bleicker\FastRoute\RequestHandler\Routes\Routes;
use Bleicker\FastRoute\RequestHandler\Tests\Unit\Fixtures\Controller\RoutableController;
use PHPUnit_Framework_TestCase as UnitTestCase;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Request;

/**
 * Class RequestHandlerTest
 *
 * @package Bleicker\FastRoute\RequestHandler\Tests\Unit
 */
class RequestHandlerTest extends UnitTestCase
{

    protected function tearDown()
    {
        parent::tearDown();
        Routes::$routeRegister = [];
    }

    /**
     * @test
     * @expectedException \Bleicker\FastRoute\RequestHandler\Routes\Exceptions\NotFoundException
     */
    public function noMatchingRouteFoundForUriTest()
    {
        Routes::add('get', '/api/{foo}/bar/{baz}', RoutableController::class, 'routableAction');
        $request = new Request('http://www.google.de/typo3/', 'get');
        $requestHandler = new RequestHandler();
        $requestHandler->handleRequest($request);
    }

    /**
     * @test
     * @expectedException \Bleicker\FastRoute\RequestHandler\Routes\Exceptions\NotAllowedException
     */
    public function noMatchingRouteFoundForMethodTest()
    {
        Routes::add('get', '/api/{foo}/bar/{baz}', RoutableController::class, 'routableAction');
        $request = new Request('http://www.google.de/api/foo/bar/baz', 'post');
        $requestHandler = new RequestHandler();
        $requestHandler->handleRequest($request);
    }

    /**
     * @test
     */
    public function handleTest()
    {
        Routes::add('get', '/api/{foo}/bar/{baz}', RoutableController::class, 'routableAction');
        $request = new Request('http://www.google.de/api/foo/bar/baz', 'get');
        $requestHandler = new RequestHandler();

        /** @var RequestHandler $requestHandler */
        $this->assertInstanceOf(ResponseInterface::class, $requestHandler->handleRequest($request));
    }
}
