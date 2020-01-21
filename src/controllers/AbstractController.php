<?php
/**
 * Controller.php
 *
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @link        https://github.com/pers1307/Blog_v_2.0
 */

namespace pers1307\phoneBook\controllers;

abstract class AbstractController
{
    /**
     * @param string $templateFile
     * @param array $params
     *
     * @return string
     */
    protected function render($templateFile, $params)
    {
        ob_start();
        ob_implicit_flush(false);
        extract($params, EXTR_OVERWRITE);

        $viewDirectory = __DIR__ . '/../../views/';
        require $viewDirectory . $templateFile;

        return ob_get_clean();
    }
}