<?php
/**
 * Dispatcher.php
 *
 * @author      Pereskokov Yurii
 * @copyright   2020 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @link        https://github.com/pers1307/phone-book
 */

namespace pers1307\phoneBook\service;

class Dispatcher
{
    /**
     * @var array
     */
    protected $routes;

    /**
     * Dispatcher constructor.
     * @param array $routes
     */
    public function __construct($routes)
    {
        $this->routes = $routes;
    }

    public function dispatch($uri)
    {
        if (isset($this->routes[$uri])) {
            $className  = $this->routes[$uri][0];
            $methodName = $this->routes[$uri][1];

            $controller = new $className;

            return $controller->$methodName();

//            return call_user_func_array($this->routes[$uri], []);
        }

        return '';
    }
}