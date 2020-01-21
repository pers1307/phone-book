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

use pers1307\phoneBook\service\Request;

class RegisterForm
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
     * @param Request $request
     * @return RegisterForm
     */
    public function getDataFromRequest($request)
    {
        $postData = $request->getPost();

        /**
         * todo: тут ещё валидация параметров
         */




        $r = 1;

        if (!empty($postData[''])) {

        }


        return $this;
    }

    public function validate()
    {
        /**
         * Прямо тут и проверить
         */

        /**
         * И выкидывать Exception
         */
    }
}