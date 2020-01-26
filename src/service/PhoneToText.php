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
    protected $onesesForAlonePosition = [
        '',
        'одна',
        'две',
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
    protected $unitAfterFive = [
        '',
        'тысяч',
        'миллионов',
        'миллиардов',
    ];

    protected $unitOne = [
        '',
        'тысяча',
        'миллион',
        'миллиард',
    ];

    protected $unitTwoTreeFour = [
        '',
        'тысячи',
        'миллиона',
        'миллиарда',
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
            $splitPhoneItem = $this->normalizeSplitPhoneItem($splitPhoneItem);
            $unitForUse     = $this->useUnit($splitPhoneItem);
            $bufResult = '';

            $bufResult .= ' ' . $this->hundred[$splitPhoneItem[0]];

            if ($splitPhoneItem[1] == '1') {
                $keyFor20 = $splitPhoneItem[1] . $splitPhoneItem[2];

                $bufResult .= ' ' . $this->tensBefore20[$keyFor20];
            } else {
                $bufResult .= ' ' . $this->tens[$splitPhoneItem[1]];

                // Для тысяч
                if ($key == 1) {
                    $bufResult .= ' ' . $this->onesesForAlonePosition[$splitPhoneItem[2]];
                } else {
                    $bufResult .= ' ' . $this->oneses[$splitPhoneItem[2]];
                }

            }

            if ($key >= 1) {
                if (!(
                    $splitPhoneItem[0] == 0
                    && $splitPhoneItem[1] == 0
                    && $splitPhoneItem[2] == 0
                    )
                ) {
                    $bufResult .= ' ' . $this->$unitForUse[$key];
                }
            }

            $result = $bufResult . $result;
        }

        return $result;
    }

    /**
     * @param string $splitPhoneItem
     * @return string
     */
    protected function normalizeSplitPhoneItem($splitPhoneItem)
    {
        $count = strlen($splitPhoneItem);

        $addItem = 3 - $count;

        for ($index = 0; $index < $addItem; $index++) {
            $splitPhoneItem = '0' . $splitPhoneItem;
        }

        return $splitPhoneItem;
    }

    /**
     * @param string $splitPhoneItem
     *
     * @return string
     */
    protected function useUnit($splitPhoneItem)
    {
        $countForProcess = strlen($splitPhoneItem);

        $splitPhoneItemNew = $splitPhoneItem;
        for ($index = 0; $index < $countForProcess; $index++) {
            if ($splitPhoneItem[$index] == 0) {
                $splitPhoneItemNew = substr($splitPhoneItemNew, 1);
            } else {
                break;
            }
        }

        $splitPhoneItem = $splitPhoneItemNew;
        $count = strlen($splitPhoneItem);

        if ($count == 1) {
            if ($splitPhoneItem == 1) {
                return 'unitOne';
            }

            if ($splitPhoneItem > 1 && $splitPhoneItem < 5) {
                return 'unitTwoTreeFour';
            }
        }

        return 'unitAfterFive';
    }
}