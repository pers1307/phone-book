<?php
/**
 * Log.php
 *
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @link        https://github.com/pers1307/Blog_v_2.0
 */

namespace pers1307\blog\service;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Log
{
    /** @var Log */
    private static $instance;

    /** @var Logger */
    private $log;

    private function __construct()
    {
        $this->log = new Logger('log');
        $today = date('d-m-Y');
        $path = 'app/logs/' . $today . '.log';
        $this->log->pushHandler(new StreamHandler($path, Logger::ERROR));
    }

    /**
     * @return Log
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @param string $message
     */
    public function addError($message)
    {
        $this->log->addError($message);
    }
}
