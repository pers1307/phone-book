<?php
/**
 * ConvertFormToEntity.php
 *
 * @author      Pereskokov Yurii
 * @copyright   2020 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @link        https://github.com/pers1307/phone-book
 */

namespace pers1307\phoneBook\service;

use pers1307\phoneBook\entity\User;
use pers1307\phoneBook\forms\RegisterForm;

class ConvertFormToEntity
{
    /**
     * @param RegisterForm $registerForm
     * @return User
     */
    public function registerFormToUserEntity($registerForm)
    {
        $user = (new User())
            ->setLogin($registerForm->login)
            ->setPassword(md5($registerForm->password))
            ->setEmail($registerForm->email);

        return $user;
    }
}