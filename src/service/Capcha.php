<?php
/**
 * Capcha.php
 *
 * @author      Pereskokov Yurii
 * @copyright   2020 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @link        https://github.com/pers1307/phone-book
 */

namespace pers1307\phoneBook\service;


class Capcha
{
    protected $capchaArray = [
        [
            'image' => '/img/capcha/capcha1.gif',
            'code'  => 'fdec',
        ],
        [
            'image' => '/img/capcha/capcha2.gif',
            'code'  => 'bdcf',
        ],
        [
            'image' => '/img/capcha/capcha3.gif',
            'code'  => 'ecdg',
        ],
        [
            'image' => '/img/capcha/capcha4.gif',
            'code'  => 'dacf',
        ],
        [
            'image' => '/img/capcha/capcha5.gif',
            'code'  => 'efef',
        ],
    ];

    public function getRandCapchaId()
    {
        return mt_rand(0, 4);
    }

    public function getCapchaById($id)
    {
        return $this->capchaArray[$id];
    }
}