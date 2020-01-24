<?php
/**
 * PhoneToText.php
 *
 * @author      Pereskokov Yurii
 * @copyright   2020 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @link        https://github.com/pers1307/phone-book
 */

namespace pers1307\phoneBook\service;


class PhoneToText
{
    /**
     * @var array
     */
    protected $hundred = [
        '',
        'сто',
        'двести',
        'триста',
        'четыреста',
        'пятьсот',
        'шестьсот',
        'семьсот',
        'восемьсот',
        'девятьсот'
    ];

    /**
     * @var array
     */
    protected $tens = [
        '',
        '',
        'двадцать',
        'тридцать',
        'сорок',
        'пятьдесят',
        'шестьдесят',
        'семьдесят',
        'восемьдесят',
        'девяносто'
    ];

    /**
     * @var array
     */
    protected $tensBefore20 = [
        '10' => 'десять',
        '11' => 'одиннадцать',
        '12' => 'двенадцать',
        '13' => 'тринадцать',
        '14' => 'четырнадцать',
        '15' => 'пятнадцать',
        '16' => 'шестнадцать',
        '17' => 'семнадцать',
        '18' => 'восемнадцать',
        '19' => 'девятнадцать'
    ];

    /**
     * @var array
     */
    protected $oneses = [
        '',
        'один',
        'два',
        'три',
        'четыре',
        'пять',
        'шесть',
        'семь',
        'восемь',
        'девять'
    ];

    /**
     * @var array
     */
    protected $unit = [
        '',
        'тысяч',
        'миллионов',
        'миллиардов',
    ];

    /**
     * @param string $phone
     *
     * @return string
     */
    protected function clearPhone($phone)
    {
        $phone = str_replace('+', '', $phone);
        $phone = str_replace('(', '', $phone);
        $phone = str_replace(')', '', $phone);
        $phone = str_replace('-', '', $phone);
        $phone = str_replace(' ', '', $phone);

        return $phone;
    }


    public function convertPhoneToText($phone)
    {
        $phone = $this->clearPhone($phone);

        $reversPhone = strrev($phone);
        $splitPhone  = str_split($reversPhone,3);
        foreach ($splitPhone as $key => &$value) {
            $value = strrev($value);
        }

        $result = '';
        foreach ($splitPhone as $key => $splitPhoneItem) {
            $bufResult = '';

            $bufResult .= ' ' . $this->hundred[$splitPhoneItem[0]];

            if ($splitPhoneItem[1] == '1') {
                $keyFor20 = $splitPhoneItem[1] . $splitPhoneItem[2];

                $bufResult .= ' ' . $this->tensBefore20[$keyFor20];
            } else {
                $bufResult .= ' ' . $this->tens[$splitPhoneItem[1]];
                $bufResult .= ' ' . $this->oneses[$splitPhoneItem[2]];
            }

            if ($key >= 1) {
                if (!(
                    $splitPhoneItem[0] == 0
                    && $splitPhoneItem[1] == 0
                    && $splitPhoneItem[2] == 0
                    )
                ) {
                    $bufResult .= ' ' . $this->unit[$key];
                }
            }

            $result = $bufResult . $result;
        }

        return $result;
    }
}