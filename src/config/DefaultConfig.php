<?php
/**
 * DefaultConfig.php
 *
 * @author      Pereskokov Yurii
 * @copyright   2020 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @link        https://github.com/pers1307/phone-book
 */

namespace pers1307\phoneBook\config;

abstract class DefaultConfig
{
    const HTTP_HOST    = 'localhost';
    const PDO_DSN      = 'mysql:dbname=blog;host=127.0.0.1';
    const PDO_USER     = 'root';
    const PDO_PASSWORD = '';
}