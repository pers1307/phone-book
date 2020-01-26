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

use pers1307\phoneBook\controllers\AbstractController;
use pers1307\phoneBook\exception\FormNotValidException;
use pers1307\phoneBook\exception\InvalidAutorizationException;
use pers1307\phoneBook\exception\NoPostArgumentException;
use pers1307\phoneBook\exception\NotFoundFileException;
use pers1307\phoneBook\forms\PhoneForm;
use pers1307\phoneBook\forms\PhoneIdForm;
use pers1307\phoneBook\forms\PhoneRemoveForm;
use pers1307\phoneBook\forms\SortForm;
use pers1307\phoneBook\repository\PhoneRepository;
use pers1307\phoneBook\service\Autorization;
use pers1307\phoneBook\service\ConvertFormToEntity;
use pers1307\phoneBook\service\PhoneToText;
use pers1307\phoneBook\service\Request;
use pers1307\phoneBook\service\Response;

class PhoneController extends AbstractController
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

                /** @var PhoneRepository $phoneRepository */
                $phoneRepository = new PhoneRepository();

                $phone = $phoneRepository->findById($phoneRemoveForm->id);
                (new ConvertFormToEntity())->removeFileByPhoto($phone);

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
            $response = new Response(Response::HTTP_INTERNAL_SERVER_ERROR, Response::CONTENT_JSON);
            $response->setContent(json_encode(['error' => 'Что то пошло не так!']));
            return $response;
        } catch (NoPostArgumentException $exception) {
            $response = new Response(Response::HTTP_INTERNAL_SERVER_ERROR, Response::CONTENT_JSON);
            $response->setContent(json_encode(['error' => 'Что то пошло не так!']));
            return $response;
        } catch (NotFoundFileException $exception) {
            $response = new Response(Response::HTTP_INTERNAL_SERVER_ERROR, Response::CONTENT_JSON);
            $response->setContent(json_encode(['error' => 'Что то пошло не так!']));
            return $response;
        } catch (\Exception $exception) {
            $response = new Response(Response::HTTP_INTERNAL_SERVER_ERROR, Response::CONTENT_JSON);
            $response->setContent(json_encode(['error' => 'Что то пошло не так!']));
            return $response;
        }
    }

    public function addAction()
    {
        try {
            Autorization::getInstance()->checkAutorizationWithException();

            /** @var Request $request */
            $request = (new Request)->createFromGlobals();
            $phoneForm = new PhoneForm();

            if (!is_null($request->getPost())) {
                $phoneForm = $phoneForm->getDataFromRequest($request);
                $phoneForm->validate();

                $phone = (new ConvertFormToEntity())->phoneFormToPhoneEntity(
                    $phoneForm,
                    Autorization::getInstance()->getCurrentUserId()
                );

                $phone = (new PhoneRepository())->insert($phone);
            }

            $response = new Response(200, Response::CONTENT_JSON);
            $response->setContent(json_encode([
                'row' => $this->render('templates/phone_row.php', ['phone' => $phone, 'phoneToText' => (new PhoneToText())])
            ]));
            return $response;
        } catch (InvalidAutorizationException $exception) {
            $response = new Response(Response::HTTP_UNAUTHORIZED, Response::CONTENT_JSON);
            $response->setContent(json_encode(['error' => $exception->getMessage()]));
            return $response;
        } catch (FormNotValidException $exception) {
            $response = new Response(Response::HTTP_INTERNAL_SERVER_ERROR, Response::CONTENT_JSON);
            $response->setContent(json_encode(['errors' => $phoneForm->getErrors()]));
            return $response;
        } catch (NoPostArgumentException $exception) {
            $response = new Response(Response::HTTP_INTERNAL_SERVER_ERROR, Response::CONTENT_JSON);
            $response->setContent(json_encode(['error' => 'Что то пошло не так!']));
            return $response;
        } catch (\Exception $exception) {
            $response = new Response(Response::HTTP_INTERNAL_SERVER_ERROR, Response::CONTENT_JSON);
            $response->setContent(json_encode(['error' => 'Что то пошло не так!']));
            return $response;
        }
    }

    public function updateTemplateAction()
    {
        try {
            Autorization::getInstance()->checkAutorizationWithException();

            /** @var Request $request */
            $request = (new Request)->createFromGlobals();
            $phoneIdForm = new PhoneIdForm();

            if (!is_null($request->getPost())) {
                $phoneIdForm = $phoneIdForm->getDataFromRequest($request);
                $phoneIdForm->validate();
            }

            $phone = (new PhoneRepository())->findById($phoneIdForm->id);

            $response = new Response(200, Response::CONTENT_JSON);
            $response->setContent(json_encode([
                'row' => $this->render('templates/phone_row_update_form.php', ['phone' => $phone])
            ]));
            return $response;
        } catch (InvalidAutorizationException $exception) {
            $response = new Response(Response::HTTP_UNAUTHORIZED, Response::CONTENT_JSON);
            $response->setContent(json_encode(['error' => $exception->getMessage()]));
            return $response;
        } catch (FormNotValidException $exception) {
            $response = new Response(Response::HTTP_INTERNAL_SERVER_ERROR, Response::CONTENT_JSON);
            $response->setContent(json_encode(['error' => 'Что то пошло не так!']));
            return $response;
        } catch (NoPostArgumentException $exception) {
            $response = new Response(Response::HTTP_INTERNAL_SERVER_ERROR, Response::CONTENT_JSON);
            $response->setContent(json_encode(['error' => 'Что то пошло не так!']));
            return $response;
        } catch (\Exception $exception) {
            $response = new Response(Response::HTTP_INTERNAL_SERVER_ERROR, Response::CONTENT_JSON);
            $response->setContent(json_encode(['error' => 'Что то пошло не так!']));
            return $response;
        }
    }

    public function updateAction()
    {
        try {
            Autorization::getInstance()->checkAutorizationWithException();

            /** @var Request $request */
            $request = (new Request)->createFromGlobals();
            $phoneForm = new PhoneForm();
            $phoneIdForm = new PhoneIdForm();

            if (!is_null($request->getPost())) {
                $phoneForm = $phoneForm->getDataFromRequest($request);
                $phoneForm->validate();

                $phoneIdForm = $phoneIdForm->getDataFromRequest($request);
                $phoneIdForm->validate();

                $phone = (new ConvertFormToEntity())->phoneFormToPhoneEntity(
                    $phoneForm,
                    Autorization::getInstance()->getCurrentUserId()
                );

                $phone->setId($phoneIdForm->id);
                (new PhoneRepository())->update($phone);

                $phone = (new PhoneRepository())->findById($phone->getId());
            }

            $response = new Response(200, Response::CONTENT_JSON);
            $response->setContent(json_encode([
                'row' => $this->render('templates/phone_row.php', ['phone' => $phone, 'phoneToText' => (new PhoneToText())])
            ]));
            return $response;
        } catch (InvalidAutorizationException $exception) {
            $response = new Response(Response::HTTP_UNAUTHORIZED, Response::CONTENT_JSON);
            $response->setContent(json_encode(['error' => $exception->getMessage()]));
            return $response;
        } catch (FormNotValidException $exception) {
            $response = new Response(Response::HTTP_INTERNAL_SERVER_ERROR, Response::CONTENT_JSON);
            $response->setContent(json_encode(['errors' => $phoneForm->getErrors()]));
            return $response;
        } catch (NoPostArgumentException $exception) {
            $response = new Response(Response::HTTP_INTERNAL_SERVER_ERROR, Response::CONTENT_JSON);
            $response->setContent(json_encode(['error' => 'Что то пошло не так!']));
            return $response;
        } catch (\Exception $exception) {
            $response = new Response(Response::HTTP_INTERNAL_SERVER_ERROR, Response::CONTENT_JSON);
            $response->setContent(json_encode(['error' => 'Что то пошло не так!']));
            return $response;
        }
    }

    public function sortAction()
    {
        try {
            Autorization::getInstance()->checkAutorizationWithException();

            /** @var Request $request */
            $request = (new Request)->createFromGlobals();
            $sortForm = new SortForm();

            if (!is_null($request->getPost())) {
                $sortForm = $sortForm->getDataFromRequest($request);
                $sortForm->validate();
            }


            $userId = Autorization::getInstance()->getCurrentUserId();
            $phones = (new PhoneRepository())->findAllByUserIdAndSort($userId, $sortForm->name, $sortForm->next);

            $response = new Response(200, Response::CONTENT_JSON);
            $response->setContent(json_encode([
                'table' => $this->render('templates/phone_table.php', [
                    'phones'      => $phones,
                    'phoneToText' => (new PhoneToText()),
                    'name'        => $sortForm->name,
                    'next'        => $sortForm->next,
                ])
            ]));
            return $response;
        } catch (InvalidAutorizationException $exception) {
            $response = new Response(Response::HTTP_UNAUTHORIZED, Response::CONTENT_JSON);
            $response->setContent(json_encode(['error' => $exception->getMessage()]));
            return $response;
        } catch (FormNotValidException $exception) {
            $response = new Response(Response::HTTP_INTERNAL_SERVER_ERROR, Response::CONTENT_JSON);
            $response->setContent(json_encode(['error' => 'Что то пошло не так!']));
            return $response;
        } catch (NoPostArgumentException $exception) {
            $response = new Response(Response::HTTP_INTERNAL_SERVER_ERROR, Response::CONTENT_JSON);
            $response->setContent(json_encode(['error' => 'Что то пошло не так!']));
            return $response;
        } catch (\Exception $exception) {
            $response = new Response(Response::HTTP_INTERNAL_SERVER_ERROR, Response::CONTENT_JSON);
            $response->setContent(json_encode(['error' => 'Что то пошло не так!']));
            return $response;
        }
    }

    public function getRowForNewPhone()
    {
        $response = new Response(200, Response::CONTENT_JSON);
        $response->setContent(json_encode([
            'template' => $this->render('templates/phone_row_form.php', [])
        ]));
        return $response;
    }
}