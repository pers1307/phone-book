<?php
/**
 * LoginController.php
 *
 * @author      Pereskokov Yurii
 * @copyright   2020 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @link        https://github.com/pers1307/phone-book
 */

namespace pers1307\phoneBook\controllers;

use pers1307\phoneBook\exception\FormNotValidException;
use pers1307\phoneBook\exception\NoPostArgumentException;
use pers1307\phoneBook\exception\NotFoundEntityException;
use pers1307\phoneBook\exception\WrongPasswordException;
use pers1307\phoneBook\forms\LoginForm;
use pers1307\phoneBook\service\Autorization;
use pers1307\phoneBook\service\Redirect;
use pers1307\phoneBook\service\Request;
use pers1307\phoneBook\service\Response;

class LoginController extends AbstractController
{
    public function loginAction()
    {
        try {
            if (Autorization::getInstance()->checkAutorization()) {
                (new Redirect())->gotoUrl('/phones');
            }

            /** @var Request $request */
            $request = (new Request)->createFromGlobals();
            $loginForm = new LoginForm();

            if (!is_null($request->getPost())) {
                $loginForm = $loginForm->getDataFromRequest($request);
                $loginForm->validate();

                Autorization::getInstance()->signIn($loginForm->login, $loginForm->password);
                (new Redirect())->gotoUrl('/phones');
            }

            $response = new Response(200);
            $response->setContent(
                $this->render('login.php', ['loginForm' => $loginForm])
            );
            return $response;
        } catch (NotFoundEntityException $exception) {
            $loginForm->setErrorLogin($exception->getMessage());

            $response = new Response(200);
            $response->setContent(
                $this->render('login.php', [
                    'loginForm' => $loginForm,
                    'errors'    => $loginForm->getErrors(),
                ])
            );
            return $response;
        } catch (WrongPasswordException $exception) {
            $loginForm->setErrorPassword($exception->getMessage());

            $response = new Response(200);
            $response->setContent(
                $this->render('login.php', [
                    'loginForm' => $loginForm,
                    'errors'    => $loginForm->getErrors(),
                ])
            );
            return $response;
        } catch (FormNotValidException $exception) {
            $response = new Response(200);
            $response->setContent(
                $this->render('login.php', [
                    'loginForm' => $loginForm,
                    'errors'    => $loginForm->getErrors(),
                ])
            );
            return $response;
        } catch (NoPostArgumentException $exception) {
            $response = new Response(500);
            $response->setContent($this->render('server_error.php', []));
            return $response;
        } catch (\Exception $exception) {
            $response = new Response(500);
            $response->setContent($this->render('server_error.php', []));
            return $response;
        }
    }

    public function unloginAction()
    {
        Autorization::getInstance()->exitSession();

        (new Redirect())->gotoUrl('/');
    }
}