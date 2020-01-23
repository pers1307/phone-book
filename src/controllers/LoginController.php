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

class LoginController extends AbstractController
{
    public function loginAction()
    {
        try {
            /** @var Request $request */
            $request = (new Request)->createFromGlobals();
            $loginForm = new LoginForm();

            if (!is_null($request->getPost())) {
                $loginForm = $loginForm->getDataFromRequest($request);
                $loginForm->validate();

                Autorization::getInstance()->signIn($loginForm->login, $loginForm->password);
                (new Redirect())->gotoUrl('/phones');
            }

            $result = $this->render('login.php', ['loginForm' => $loginForm]);
            echo $result;
        } catch (NotFoundEntityException $exception) {
            $loginForm->setErrorLogin($exception->getMessage());

            $result = $this->render('login.php', [
                'loginForm' => $loginForm,
                'errors'    => $loginForm->getErrors(),
            ]);
            echo $result;
        } catch (WrongPasswordException $exception) {
            $loginForm->setErrorPassword($exception->getMessage());

            $result = $this->render('login.php', [
                'loginForm' => $loginForm,
                'errors'    => $loginForm->getErrors(),
            ]);
            echo $result;
        } catch (FormNotValidException $exception) {
            $result = $this->render('login.php', [
                'loginForm' => $loginForm,
                'errors'    => $loginForm->getErrors(),
            ]);
            echo $result;
        } catch (NoPostArgumentException $exception) {
            $result = $this->render('server_error.php', []);
            echo $result;
        } catch (\Exception $exception) {
            $result = $this->render('server_error.php', []);
            echo $result;
        }

        return '';
    }

    public function unloginAction()
    {
        Autorization::getInstance()->exitSession();

        (new Redirect())->gotoUrl('/');
    }
}