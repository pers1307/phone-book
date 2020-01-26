<?php
/**
 * Response.php
 *
 * @author      Pereskokov Yurii
 * @copyright   2020 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @link        https://github.com/pers1307/phone-book
 */

namespace pers1307\phoneBook\service;

class Response
{
    const HTTP_OK = 200;
    const HTTP_NOT_FOUND = 404;
    const HTTP_INTERNAL_SERVER_ERROR = 500;
    const HTTP_UNAUTHORIZED = 401;

    const CONTENT_HTML = 'text/html';
    const CONTENT_JSON = 'application/json';

    /**
     * @var string
     */
    protected $content;

    /**
     * @var int
     */
    protected $code;

    /**
     * Response constructor.
     *
     * @param string $code
     * @param string $content
     */
    public function __construct($code, $content = Response::CONTENT_HTML)
    {
        $this->code    = $code;
        $this->content = $content;
    }

    /**
     * @param $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    public function send()
    {
        http_response_code($this->code);

        if ($this->code === $this::CONTENT_HTML) {
            header('Content-Type: text/html');
        }

        if ($this->code === $this::CONTENT_JSON) {
            header('Content-Type: application/json');
        }

        echo $this->content;

        return $this;
    }
}