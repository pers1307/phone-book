<?php
/**
 * AbstractForm.php
 *
 * @author      Pereskokov Yurii
 * @copyright   2020 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @link        https://github.com/pers1307/phone-book
 */

namespace pers1307\phoneBook\forms;

use pers1307\phoneBook\service\Request;

abstract class AbstractForm
{
    /**
     * @var array
     */
    public $errors = [];

    /**
     * @param Request $request
     */
    abstract public function getDataFromRequest($request);

    abstract public function validate();

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }
}