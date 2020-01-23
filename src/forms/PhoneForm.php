<?php
/**
 * PhoneForm.php
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

class PhoneForm extends AbstractForm
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $surname;

    /**
     * @var string
     */
    public $phone;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $pathImage;

    /**
     * @var array
     */
    public $errors;

    /**
     * @var array
     */
    public $files;

    /**
     * @param Request $request
     * @return PhoneForm
     *
     * @throws NoPostArgumentException
     */
    public function getDataFromRequest($request)
    {
        $postData = $request->getPost();

        if (!isset($postData['name'])) {
            throw new NoPostArgumentException('name parameter doesn\'t exist in POST array');
        }

        if (!isset($postData['surname'])) {
            throw new NoPostArgumentException('surname parameter doesn\'t exist in POST array');
        }

        if (!isset($postData['phone'])) {
            throw new NoPostArgumentException('phone parameter doesn\'t exist in POST array');
        }

        if (!isset($postData['email'])) {
            throw new NoPostArgumentException('email parameter doesn\'t exist in POST array');
        }

        $this->name     = htmlspecialchars($postData['name']);
        $this->surname  = htmlspecialchars($postData['surname']);
        $this->phone    = htmlspecialchars($postData['phone']);
        $this->email    = htmlspecialchars($postData['email']);

        $files = $request->getFiles();
        if (!empty($files) && ($files['photo']['size'] !== 0)) {
            $this->files = $files;
        }

        return $this;
    }

    public function validate()
    {
        $this->errors = [];

        if (empty($this->name)) {
            $this->errors['name'] = 'Поле не может быть пустым';
        }

        if (empty($this->surname)) {
            $this->errors['surname'] = 'Поле не может быть пустым';
        }

        if (empty($this->phone)) {
            $this->errors['phone'] = 'Поле не может быть пустым';
        }

        if (empty($this->email)) {
            $this->errors['email'] = 'Поле не может быть пустым';
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Адрес указан не верно';
        }

        if (isset($this->files['photo'])) {
            if (
                $this->files['photo']['type'] !== 'image/png'
                && $this->files['photo']['type'] !== 'image/jpg'
                && $this->files['photo']['type'] !== 'image/jpeg'
            ) {
                $this->errors['photo'] = 'Файл должен иметь формат jpg или png';
            }

            if ($this->files['photo']['size'] > 2000000) {
                $this->errors['photo'] = 'Файл должен размером не более 2 Мб';
            }
        }

        if (!empty($this->errors)) {
            throw new FormNotValidException('Form not valid');
        }
    }
}