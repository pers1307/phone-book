<?php
/**
 * Autorization.php
 *
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @link        https://github.com/pers1307/Blog_v_2.0
 */

namespace pers1307\phoneBook\service;

use pers1307\phoneBook\entity\User;
use pers1307\phoneBook\exception\InvalidAutorizationException;
use pers1307\phoneBook\exception\NotFoundEntityException;
use pers1307\phoneBook\exception\WrongPasswordException;
use pers1307\phoneBook\repository\UserRepository;

class Autorization
{
    /** @var Autorization */
    private static $instance;

    private function __construct()
    {

    }

    private function __clone()
    {

    }

    public function starSession()
    {
        session_start();
    }

    /**
     * @return Autorization
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @param string $login
     * @param string $password
     *
     * @return bool
     *
     * @throws NotFoundEntityException
     * @throws WrongPasswordException
     */
    public function signIn($login, $password)
    {
        $userRepository = new UserRepository();

        /** @var User $user */
        $user = $userRepository->findByCreditionals($login);

        if (is_null($user)) {
            throw new NotFoundEntityException('Такого пользователя не существует');
        }

        if (md5($password) !== $user->getPassword()) {
            throw new WrongPasswordException('Неверный пароль');
        }

        $this->setCurrentUserId($user->getId());

        return true;
    }

    /**
     * @param int $userId
     *
     * @throws \InvalidArgumentException
     */
    public function setCurrentUserId($userId)
    {
        $_SESSION['userId'] = $userId;
    }

    /**
     * @return UserRepository|null
     */
    public function getCurrentUserId()
    {
        return $_SESSION['userId'];
    }

    public function exitSession()
    {
        unset($_SESSION['userId']);
    }

    /**
     * @return bool
     */
    public function checkAutorization()
    {
        if (isset($_SESSION['userId'])) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     *
     * @throws InvalidAutorizationException
     */
    public function checkAutorizationWithException()
    {
        if (!isset($_SESSION['userId'])) {
            throw new InvalidAutorizationException(
                'У вас нет доступа к этой странице. Пожалуйста, авторизируйтесь.'
            );
        }

        return true;
    }
}