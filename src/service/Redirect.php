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

class Redirect
{
    public function gotoUrl($url)
    {
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: " . $url);

        exit();
    }
}