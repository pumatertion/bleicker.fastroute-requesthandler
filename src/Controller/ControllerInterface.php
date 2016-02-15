<?php
namespace Bleicker\FastRoute\RequestHandler\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface ControllerInterface
 *
 * @package Bleicker\FastRoute\RequestHandler\Controller
 */
interface ControllerInterface
{

    /**
     * @param RequestInterface  $request
     * @param                   $methodName
     * @param array             $methodArguments
     *
     * @return ResponseInterface
     */
    public function processRequest($methodName, $methodArguments, RequestInterface $request);
}
