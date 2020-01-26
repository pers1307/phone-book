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
use pers1307\phoneBook\service\PhoneToText;
use pers1307\phoneBook\service\Response;

class PhoneListController extends AbstractController
{
    public function indexAction()
    {
        try {
            Autorization::getInstance()->checkAutorizationWithException();

            $userId = Autorization::getInstance()->getCurrentUserId();
            $phones = (new PhoneRepository())->findAllByUserId($userId);

            $response = new Response(200);
            $response->setContent(
                $this->render('phone_list.php', [
                    'phones'      => $phones,
                    'phoneToText' => (new PhoneToText()),
                ])
            );
            return $response;
        } catch (InvalidAutorizationException $exception) {
            $response = new Response(200);
            $response->setContent(
                $this->render('autorize_error.php', [])
            );
            return $response;
        } catch (\Exception $exception) {
            $response = new Response(200);
            $response->setContent(
                $this->render('server_error.php', [])
            );
            return $response;
        }
    }
}