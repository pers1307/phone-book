<?php
/**
 * PhoneController.php
 *
 * @author      Pereskokov Yurii
 * @copyright   2020 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @link        https://github.com/pers1307/phone-book
 */

namespace pers1307\phoneBook\api;

use pers1307\phoneBook\exception\FormNotValidException;
use pers1307\phoneBook\exception\InvalidAutorizationException;
use pers1307\phoneBook\exception\NoPostArgumentException;
use pers1307\phoneBook\forms\PhoneRemoveForm;
use pers1307\phoneBook\repository\PhoneRepository;
use pers1307\phoneBook\service\Autorization;
use pers1307\phoneBook\service\Request;
use pers1307\phoneBook\service\Response;

class PhoneController
{
    public function removeAction()
    {
        try {
            Autorization::getInstance()->checkAutorizationWithException();

            /** @var Request $request */
            $request = (new Request)->createFromGlobals();
            $phoneRemoveForm = new PhoneRemoveForm();

            if (!is_null($request->getPost())) {
                $phoneRemoveForm = $phoneRemoveForm->getDataFromRequest($request);
                $phoneRemoveForm->validate();

                (new PhoneRepository())->removeById($phoneRemoveForm->id);
            }

            $response = new Response(200, Response::CONTENT_JSON);
            $response->setContent(json_encode(['result' => 'ok']));
            return $response;
        } catch (InvalidAutorizationException $exception) {
            $response = new Response(Response::HTTP_UNAUTHORIZED, Response::CONTENT_JSON);
            $response->setContent(json_encode(['error' => $exception->getMessage()]));
            return $response;
        } catch (FormNotValidException $exception) {
            $response = new Response(Response::HTTP_UNAUTHORIZED, Response::CONTENT_JSON);
            $response->setContent(json_encode(['error' => 'Что то пошло не так!']));
            return $response;
        } catch (NoPostArgumentException $exception) {
            $response = new Response(Response::HTTP_UNAUTHORIZED, Response::CONTENT_JSON);
            $response->setContent(json_encode(['error' => 'Что то пошло не так!']));
            return $response;
        } catch (\Exception $exception) {
            $response = new Response(Response::HTTP_UNAUTHORIZED, Response::CONTENT_JSON);
            $response->setContent(json_encode(['error' => 'Что то пошло не так!']));
            return $response;
        }

    }

    public function sortAction()
    {

    }

    public function addAction()
    {

    }

    public function updateAction()
    {

    }




//    public function indexAction()
//    {
//        try {
//            Autorization::getInstance()->checkAutorizationWithException();
//
//            $userId = Autorization::getInstance()->getCurrentUserId();
//            $phones = (new PhoneRepository())->findAllByUserId($userId);
//
//            $response = new Response(200);
//            $response->setContent(
//                $this->render('phone_list.php', [
//                    'phones'      => $phones,
//                    'phoneToText' => (new PhoneToText()),
//                ])
//            );
//            return $response;
//        } catch (InvalidAutorizationException $exception) {
//            $response = new Response(200);
//            $response->setContent(
//                $this->render('autorize_error.php', [])
//            );
//            return $response;
//        } catch (\Exception $exception) {
//            $response = new Response(200);
//            $response->setContent(
//                $this->render('server_error.php', [])
//            );
//            return $response;
//        }
//    }
}