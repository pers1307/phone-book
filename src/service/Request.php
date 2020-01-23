<?php
/**
 * Request.php
 *
 * @author      Pereskokov Yurii
 * @copyright   2020 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @link        https://github.com/pers1307/phone-book
 */

namespace pers1307\phoneBook\service;

class Request
{
    /**
     * @var array
     */
    protected $postParams;

    /**
     * @var array
     */
    protected $getParams;

    /**
     * @var array
     */
    protected $filesParams;

    /**
     * @return Request
     */
    public function createFromGlobals()
    {
        if (isset($_GET) && !empty($_GET)) {
            $this->getParams = $_GET;
        }

        if (isset($_POST) && !empty($_POST)) {
            $this->postParams = $_POST;
        }

        if (isset($_FILES) && !empty($_FILES)) {
            $this->filesParams = $_FILES;
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getPost()
    {
        return $this->postParams;
    }

    /**
     * @return array
     */
    public function getGet()
    {
        return $this->getParams;
    }

    /**
     * @return array
     */
    public function getFiles()
    {
        return $this->filesParams;
    }
}