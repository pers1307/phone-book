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

use pers1307\phoneBook\entity\Phone;
use pers1307\phoneBook\exception\FormNotValidException;
use pers1307\phoneBook\exception\NoPostArgumentException;
use pers1307\phoneBook\service\Request;

class PhoneIdForm extends AbstractForm
{
    /**
     * @var string
     */
    public $id;

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

        if (!isset($postData['id'])) {
            throw new NoPostArgumentException('id parameter doesn\'t exist in POST array');
        }

        $this->id = htmlspecialchars($postData['id']);

        return $this;
    }

    public function validate()
    {
        $this->errors = [];

        if (empty($this->id)) {
            $this->errors['id'] = 'id записи отсутствует';
        }

        if (!empty($this->errors)) {
            throw new FormNotValidException('Form not valid');
        }
    }
}