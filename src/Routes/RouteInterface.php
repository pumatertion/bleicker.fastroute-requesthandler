<?php
namespace Bleicker\FastRoute\RequestHandler\Routes;

/**
 * Class Route
 *
 * @package Bleicker\FastRoute\RequestHandler\Routes
 */
interface RouteInterface
{

    /**
     * @return string
     */
    public function getControllerClassName();

    /**
     * @return string
     */
    public function getIdentity();

    /**
     * @return string
     */
    public function getPathPattern();

    /**
     * @return string
     */
    public function getMethodName();

    /**
     * @return string
     */
    public function getRequestMethod();
}