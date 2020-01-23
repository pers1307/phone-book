<?php
/**
 * PhoneListController.php
 *
 * @author      Pereskokov Yurii
 * @copyright   2020 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @link        https://github.com/pers1307/phone-book
 */

namespace pers1307\phoneBook\controllers;

use pers1307\phoneBook\exception\InvalidAutorizationException;
use pers1307\phoneBook\repository\PhoneRepository;
use pers1307\phoneBook\service\Autorization;

class PhoneListController extends AbstractController
{
    public function indexAction()
    {
        try {
            Autorization::getInstance()->checkAutorizationWithException();

            $userId = Autorization::getInstance()->getCurrentUserId();
            $phones = (new PhoneRepository())->findAllByUserId($userId);

            $result = $this->render('phone_list.php', ['phones' => $phones]);
            echo $result;
        } catch (InvalidAutorizationException $exception) {
            $result = $this->render('autorize_error.php', []);
            echo $result;
        } catch (\Exception $exception) {
            $result = $this->render('server_error.php', []);
            echo $result;
        }

        return '';
    }
}