<?php
/**
 * RouterCollector.php
 *
 * @author      Pereskokov Yurii
 * @copyright   2020 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @link        https://github.com/pers1307/phone-book
 */

namespace pers1307\phoneBook\service;

class RouterCollector
{
    /**
     * @var array
     */
    protected $routes;

    /**
     * @param string $route
     * @param string $class
     * @param string $method
     */
    public function addRoute($route, $class, $method)
    {
        $this->routes[$route] = [$class, $method];
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->routes;
    }
}