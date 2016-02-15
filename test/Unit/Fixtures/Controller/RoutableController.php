<?php

namespace Bleicker\FastRoute\RequestHandler\Tests\Unit\Fixtures\Controller;

use Bleicker\FastRoute\RequestHandler\Controller\ControllerInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response;

/**
 * Class RoutableController
 *
 * @package Bleicker\FastRoute\RequestHandler\Tests\Unit\Fixtures\Controller
 */
class RoutableController implements ControllerInterface
{

    /**
     * @param RequestInterface  $request
     * @param                   $methodName
     * @param array             $methodArguments
     *
     * @return ResponseInterface
     */
    public function processRequest($methodName, $methodArguments, RequestInterface $request)
    {
        return call_user_func_array(array($this, $methodName), $methodArguments);
    }

    /**
     * @return ResponseInterface
     */
    public function routableAction()
    {
        return new Response();
    }

    /**
     * @return void
     */
    protected function protectedAction()
    {
    }

    /**
     * @return void
     */
    private function privateAction()
    {
    }

    /**
     * @return void
     */
    public static function staticAction()
    {
    }
}
