<?php

namespace pers1307\phoneBook;

use pers1307\phoneBook\service\Dispatcher;
use pers1307\phoneBook\service\RouterCollector;

require __DIR__ . '/vendor/autoload.php';

$router = new RouterCollector();
$router->addRoute('/', 'pers1307\phoneBook\controllers\LoginController', 'loginAction');
$router->addRoute('/register', 'pers1307\phoneBook\controllers\RegisterController', 'registerAction');
$router->addRoute('/register-success', 'pers1307\phoneBook\controllers\RegisterController', 'registerSuccessAction');
$router->addRoute('/phones', 'pers1307\phoneBook\controllers\PhoneListController', 'indexAction');
$router->addRoute('/phone/{id}', 'pers1307\phoneBook\controllers\PhoneItemController', 'viewAction');
$router->addRoute('/phone/create', 'pers1307\phoneBook\controllers\PhoneItemController', 'createAction');
$router->addRoute('/phone/edit/{id}', 'pers1307\phoneBook\controllers\PhoneItemController', 'editAction');

$dispatcher = new Dispatcher($router->getData());

$response = $dispatcher->dispatch(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

//if (!is_null($response)) {
//    $response->send();
//}



//use Phroute\Phroute\RouteCollector;
//use Phroute\Phroute\Dispatcher;
//
//Autorization::getInstance()->starSession();
//
//$router = new RouteCollector();
//
//$router->any('/', ['pers1307\blog\controllers\IndexController', 'indexAction']);
//$router->any('/articlesDesk', ['pers1307\blog\controllers\ArticlesDeskController', 'findAllAction']);
//$router->any('/deleteArticle/{id}', ['pers1307\blog\controllers\ArticlesDeskController','deleteArticle']);
//$router->any('/article/{id}', ['pers1307\blog\controllers\ArticleController','findAction']);
//$router->any('/article', ['pers1307\blog\controllers\ArticleController','displayAction']);
//$router->any('/addArticle', ['pers1307\blog\controllers\ArticleController','addArticleAction']);
//
//$dispatcher = new Dispatcher($router->getData());
//$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
//
//if (!is_null($response)) {
//    $response->send();
//}