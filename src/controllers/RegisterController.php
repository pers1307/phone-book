<?php
/**
 * RegisterController.php
 *
 * @author      Pereskokov Yurii
 * @copyright   2020 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @link        https://github.com/pers1307/phone-book
 */

namespace pers1307\phoneBook\controllers;

use pers1307\phoneBook\exception\FormNotValidException;
use pers1307\phoneBook\exception\NoPostArgumentException;
use pers1307\phoneBook\forms\RegisterForm;
use pers1307\phoneBook\repository\UserRepository;
use pers1307\phoneBook\service\ConvertFormToEntity;
use pers1307\phoneBook\service\Redirect;
use pers1307\phoneBook\service\Request;

class RegisterController extends AbstractController
{
    public function registerAction()
    {
        try {
            /** @var Request $request */
            $request = (new Request)->createFromGlobals();
            $registerForm = new RegisterForm();

            if (!is_null($request->getPost())) {
                $registerForm = $registerForm->getDataFromRequest($request);
                $registerForm->validate();

                $user = (new ConvertFormToEntity())->registerFormToUserEntity($registerForm);

                (new UserRepository())->insert($user);
                (new Redirect())->gotoUrl('/register-success');
            }

            $result = $this->render('register.php', ['registerForm' => $registerForm]);
            echo $result;
        } catch (FormNotValidException $exception) {
            $result = $this->render('register.php', [
                'registerForm' => $registerForm,
                'errors'       => $registerForm->getErrors(),
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

    public function registerSuccessAction()
    {
        $result = $this->render('register_success.php', []);
        echo $result;
    }
}