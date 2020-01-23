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

use pers1307\phoneBook\entity\Phone;
use pers1307\phoneBook\entity\User;
use pers1307\phoneBook\forms\PhoneForm;
use pers1307\phoneBook\forms\RegisterForm;

class ConvertFormToEntity
{
    /**
     * @var string
     */
    protected $pathToUploadDirectory = '/upload/';

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

    /**
     * @param PhoneForm $phoneForm
     * @return Phone
     *
     * @throws \Exception
     */
    public function phoneFormToPhoneEntity($phoneForm)
    {
        $pathToUrl = '';

        if (!empty($phoneForm->files)) {
            $newName = $this->translit($phoneForm->files['photo']['name']);

            $pathToUrl       = $this->pathToUploadDirectory . $newName;
            $pathToDirectory = __DIR__ . '/../..' . $pathToUrl;

            if (!move_uploaded_file($phoneForm->files['photo']['tmp_name'], $pathToDirectory)) {
                throw new \Exception('File not move');
            }
        }

        $phone = (new Phone())
            ->setName($phoneForm->name)
            ->setSurname($phoneForm->surname)
            ->setPhone($phoneForm->phone)
            ->setEmail($phoneForm->email)
            ->setPathImage($pathToUrl);

        return $phone;
    }

    /**
     * @param $string
     * @param string $spaceSymbol
     *
     * @return mixed|string
     */
    protected function translit($string, $spaceSymbol = '-')
    {
        $string = mb_strtolower($string);

        $converter = [
            'а' => 'a',    'б' => 'b',    'в' => 'v',    'г' => 'g',    'д' => 'd',
            'е' => 'e',    'ё' => 'e',    'ж' => 'zh',   'з' => 'z',    'и' => 'i',
            'й' => 'y',    'к' => 'k',    'л' => 'l',    'м' => 'm',    'н' => 'n',
            'о' => 'o',    'п' => 'p',    'р' => 'r',    'с' => 's',    'т' => 't',
            'у' => 'u',    'ф' => 'f',    'х' => 'h',    'ц' => 'c',    'ч' => 'ch',
            'ш' => 'sh',   'щ' => 'sch',  'ь' => '',     'ы' => 'y',    'ъ' => '',
            'э' => 'e',    'ю' => 'yu',   'я' => 'ya',   ' ' => $spaceSymbol
        ];

        $value = strtr($string, $converter);

        return $value;
    }
}