<?php
/**
 * SortForm.php
 *
 * @author      Pereskokov Yurii
 * @copyright   2020 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @link        https://github.com/pers1307/phone-book
 */

namespace pers1307\phoneBook\forms;

use pers1307\phoneBook\entity\Phone;
use pers1307\phoneBook\exception\FormNotValidException;
use pers1307\phoneBook\exception\NoPostArgumentException;
use pers1307\phoneBook\service\Request;

class SortForm extends AbstractForm
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $next;

    /**
     * @var array
     */
    public $errors;

    /**
     * @param Request $request
     * @return PhoneRemoveForm
     *
     * @throws NoPostArgumentException
     */
    public function getDataFromRequest($request)
    {
        $postData = $request->getPost();

        if (!isset($postData['name'])) {
            throw new NoPostArgumentException('name parameter doesn\'t exist in POST array');
        }

        if (!isset($postData['next'])) {
            throw new NoPostArgumentException('next parameter doesn\'t exist in POST array');
        }

        $this->name = htmlspecialchars($postData['name']);
        $this->next = htmlspecialchars($postData['next']);

        return $this;
    }

    public function validate()
    {
        $this->errors = [];

        if (empty($this->name)) {
            $this->errors['name'] = 'name записи отсутствует';
        }

        if (empty($this->next)) {
            $this->errors['next'] = 'next записи отсутствует';
        }

        if (!empty($this->errors)) {
            throw new FormNotValidException('Form not valid');
        }
    }
}