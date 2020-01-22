<?php
/**
 * RegisterForm.php
 *
 * @author      Pereskokov Yurii
 * @copyright   2020 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @link        https://github.com/pers1307/phone-book
 */

namespace pers1307\phoneBook\forms;

use pers1307\phoneBook\exception\FormNotValidException;
use pers1307\phoneBook\exception\NoPostArgumentException;
use pers1307\phoneBook\service\Request;

class RegisterForm extends AbstractForm
{
    /**
     * @var string
     */
    public $login;

    /**
     * @var string
     */
    public $password;

    /**
     * @var string
     */
    public $repeatPassword;

    /**
     * @var string
     */
    public $email;

    /**
     * @var array
     */
    public $errors;

    /**
     * @param Request $request
     * @return RegisterForm
     *
     * @throws NoPostArgumentException
     */
    public function getDataFromRequest($request)
    {
        $postData = $request->getPost();

        if (!isset($postData['login'])) {
            throw new NoPostArgumentException('login parameter doesn\'t exist in POST array');
        }

        if (!isset($postData['password'])) {
            throw new NoPostArgumentException('password parameter doesn\'t exist in POST array');
        }

        if (!isset($postData['password_repeat'])) {
            throw new NoPostArgumentException('password_repeat parameter doesn\'t exist in POST array');
        }

        if (!isset($postData['email'])) {
            throw new NoPostArgumentException('email parameter doesn\'t exist in POST array');
        }

        $this->login          = htmlspecialchars($postData['login']);
        $this->password       = htmlspecialchars($postData['password']);
        $this->repeatPassword = htmlspecialchars($postData['password_repeat']);
        $this->email          = htmlspecialchars($postData['email']);

        return $this;
    }

    public function validate()
    {
        $this->errors = [];

        if (empty($this->login)) {
            $this->errors['login'] = 'Поле не может быть пустым';
        }

        if (!ctype_alnum($this->login)) {
            $this->errors['login'] = 'Поле должно содержать только латинские буквы и цифры';
        }

        if (preg_match('/(?=.*[0-9])(?=.*[a-zA-Z])/', $this->password) == 0) {
            $this->errors['password'] = 'Поле должно содержать как минимум одну букву и цифру';
        }

        if (strlen($this->password) < 6) {
            $this->errors['password'] = 'Поле должно содержать минимум 6 символов';
        }

        if ($this->password != $this->repeatPassword) {
            $this->errors['password_repeat'] = 'Пароли не совпадают';
        }

        if (empty($this->email)) {
            $this->errors['email'] = 'Поле не может быть пустым';
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Адрес указан не верно';
        }

        if (!empty($this->errors)) {
            throw new FormNotValidException('Form not valid');
        }
    }


}