<?php

namespace pers1307\phoneBook;

use pers1307\phoneBook\service\Autorization;
use pers1307\phoneBook\service\Dispatcher;
use pers1307\phoneBook\service\Response;
use pers1307\phoneBook\service\RouterCollector;

require __DIR__ . '/vendor/autoload.php';

Autorization::getInstance()->starSession();

$router = new RouterCollector();
$router->addRoute('/', 'pers1307\phoneBook\controllers\LoginController', 'loginAction');
$router->addRoute('/unlogin', 'pers1307\phoneBook\controllers\LoginController', 'unloginAction');
$router->addRoute('/register', 'pers1307\phoneBook\controllers\RegisterController', 'registerAction');
$router->addRoute('/register-success', 'pers1307\phoneBook\controllers\RegisterController', 'registerSuccessAction');
$router->addRoute('/phones', 'pers1307\phoneBook\controllers\PhoneListController', 'indexAction');
$router->addRoute('/phone/{id}', 'pers1307\phoneBook\controllers\PhoneItemController', 'viewAction');
$router->addRoute('/phone/delete/{id}', 'pers1307\phoneBook\controllers\PhoneItemController', 'deleteAction');
$router->addRoute('/phone/create', 'pers1307\phoneBook\controllers\PhoneItemController', 'createAction');
$router->addRoute('/phone/edit/{id}', 'pers1307\phoneBook\controllers\PhoneItemController', 'editAction');

$router->addRoute('/api/phone/remove', 'pers1307\phoneBook\api\PhoneController', 'removeAction');
$router->addRoute('/api/phone/sort', 'pers1307\phoneBook\api\PhoneController', 'sortAction');
$router->addRoute('/api/phone/add', 'pers1307\phoneBook\api\PhoneController', 'addAction');
$router->addRoute('/api/phone/update', 'pers1307\phoneBook\api\PhoneController', 'updateAction');

$router->addRoute('/api/phone/table/row/template', 'pers1307\phoneBook\api\PhoneController', 'getRowForNewPhone');

$dispatcher = new Dispatcher($router->getData());

/** @var Response $response */
$response = $dispatcher->dispatch(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

if (!is_null($response)) {
    $response->send();
}