<?php
/**
 * LoginForm.php
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

class LoginForm extends AbstractForm
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
     * @var array
     */
    public $errors;

    /**
     * @param Request $request
     * @return LoginForm
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

        $this->login    = htmlspecialchars($postData['login']);
        $this->password = htmlspecialchars($postData['password']);

        return $this;
    }

    public function validate()
    {
        $this->errors = [];

        if (empty($this->login)) {
            $this->errors['login'] = 'Поле не может быть пустым';
        }

        if (empty($this->password)) {
            $this->errors['password'] = 'Поле не может быть пустым';
        }

        if (!empty($this->errors)) {
            throw new FormNotValidException('Form not valid');
        }
    }

    /**
     * @param string $errorText
     */
    public function setErrorLogin($errorText)
    {
        $this->errors['login'] = $errorText;
    }

    /**
     * @param string $errorText
     */
    public function setErrorPassword($errorText)
    {
        $this->errors['password'] = $errorText;
    }
}