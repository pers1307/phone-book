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


//    /**
//     * @return int
//     *
//     * @throws InvalidAutorizationException
//     */
//    protected function checkUser()
//    {
//        $request = Request::createFromGlobals();
//
//        if ($request->query->has('exit')) {
//            Autorization::getInstance()->exitSession();
//        }
//
//        if ($request->request->has('login') && $request->request->has('password')) {
//            if ($request->request->get('login') === '' || $request->request->get('password') === '') {
//                throw new InvalidAutorizationException('Поля пусты');
//            }
//
//            if (Autorization::getInstance()->signIn($request->request->get('login'), $request->request->get('password'))) {
//                $user = (new UserRepository())->findByCreditionals($request->request->get('login'));
//                Autorization::getInstance()->setCurrentUserId($user->getId());
//                header('Location: /articlesDesk');
//                exit();
//            } else {
//                throw new InvalidAutorizationException('Такой пользователь не зарегистрирован');
//            }
//        }
//
//        return Autorization::getInstance()->checkAutorization();
//    }
//
//    /**
//     * @return int
//     */
//    protected function pager()
//    {
//        $request = Request::createFromGlobals();
//
//        if ($request->query->has('page')) {
//            return 1;
//        } else {
//            if ($request->query->get('page') <= 0) {
//                return 1;
//            } else {
//                return $request->query->get('page');
//            }
//        }
//    }
//
//    /**
//     * @param int $currentPage
//     * @param int $postOnPage
//     *
//     * @return Array
//     * @throws \InvalidArgumentException
//     */
//    protected function getArticles(&$currentPage, $postOnPage)
//    {
//        Assert::assert($currentPage, 'currentPage')->notEmpty()->int();
//        Assert::assert($postOnPage, 'postOnPage')->notEmpty()->int();
//
//        $res['block'] = '';
//        if ($currentPage === 1) {
//            $res['block'] = 'start';
//        }
//
//        $article = new ArticleRepository();
//        $countArticles = $article->count();
//
//        if ($currentPage > floor($countArticles / $postOnPage)) {
//            $currentPage = ceil($countArticles / $postOnPage);
//        }
//        $offset = ($currentPage - 1) * $postOnPage;
//
//        if ($offset < 0) {
//            $offset = 0;
//        }
//        $articles = $article->findByLimit((int)$postOnPage, (int)$offset);
//
//        if (count($articles) < $postOnPage) {
//            $res['block'] = 'end';
//        }
//
//        if ((int)$countArticles === (int)($currentPage * $postOnPage)) {
//            $res['block'] = 'end';
//        }
//        $res['cutArticles'] = $articles;
//        $res['countPage'] = ceil($countArticles / $postOnPage);
//
//        return $res;
//    }
}