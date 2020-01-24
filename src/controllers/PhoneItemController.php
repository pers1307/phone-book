<?php/** * PhoneItemController.php * * @author      Pereskokov Yurii * @copyright   2020 Pereskokov Yurii * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php * @link        https://github.com/pers1307/phone-book */namespace pers1307\phoneBook\controllers;use pers1307\phoneBook\exception\FormNotValidException;use pers1307\phoneBook\exception\InvalidAutorizationException;use pers1307\phoneBook\exception\NoPostArgumentException;use pers1307\phoneBook\exception\NotFoundEntityException;use pers1307\phoneBook\forms\PhoneForm;use pers1307\phoneBook\repository\PhoneRepository;use pers1307\phoneBook\service\Autorization;use pers1307\phoneBook\service\ConvertFormToEntity;use pers1307\phoneBook\service\Redirect;use pers1307\phoneBook\service\Request;class PhoneItemController extends AbstractController{    /**     * @param $id     * @return string     */    public function editAction($id)    {        try {            Autorization::getInstance()->checkAutorizationWithException();            $phone = (new PhoneRepository())->findById($id);            if (is_null($phone)) {                throw new NotFoundEntityException('Phone number with this id not found');            }            /** @var Request $request */            $request = (new Request)->createFromGlobals();            $phoneForm = new PhoneForm();            if (!is_null($request->getPost())) {                $phoneForm = $phoneForm->getDataFromRequest($request);                $phoneForm->validate();                $phone = (new ConvertFormToEntity())->phoneFormToPhoneEntity(                    $phoneForm,                    Autorization::getInstance()->getCurrentUserId()                );                $phone->setId($id);                (new PhoneRepository())->update($phone);                (new Redirect())->gotoUrl('/phone/' . $phone->getId());            } else {                $phoneForm->fromEntityPhone($phone);            }            $result = $this->render('phone_item_form.php', ['phoneForm' => $phoneForm]);            echo $result;        } catch (NotFoundEntityException $exception) {            /**             * Выдать 404             */        } catch (InvalidAutorizationException $exception) {            $result = $this->render('autorize_error.php', []);            echo $result;        } catch (FormNotValidException $exception) {            $result = $this->render('phone_item_form.php', [                'phoneForm' => $phoneForm,                'errors'    => $phoneForm->getErrors(),            ]);            echo $result;        } catch (NoPostArgumentException $exception) {            $result = $this->render('server_error.php', []);            echo $result;        } catch (\Exception $exception) {            $result = $this->render('server_error.php', []);            echo $result;        }        return '';    }    public function createAction()    {        try {            Autorization::getInstance()->checkAutorizationWithException();            /** @var Request $request */            $request = (new Request)->createFromGlobals();            $phoneForm = new PhoneForm();            if (!is_null($request->getPost())) {                $phoneForm = $phoneForm->getDataFromRequest($request);                $phoneForm->validate();                $phone = (new ConvertFormToEntity())->phoneFormToPhoneEntity(                    $phoneForm,                    Autorization::getInstance()->getCurrentUserId()                );                $phone = (new PhoneRepository())->insert($phone);                (new Redirect())->gotoUrl('/phone/' . $phone->getId());            }            $result = $this->render('phone_item_form.php', ['phoneForm' => $phoneForm]);            echo $result;        } catch (InvalidAutorizationException $exception) {            $result = $this->render('autorize_error.php', []);            echo $result;        } catch (FormNotValidException $exception) {            $result = $this->render('phone_item_form.php', [                'phoneForm' => $phoneForm,                'errors'    => $phoneForm->getErrors(),            ]);            echo $result;        } catch (NoPostArgumentException $exception) {            $result = $this->render('server_error.php', []);            echo $result;        } catch (\Exception $exception) {            $result = $this->render('server_error.php', []);            echo $result;        }        return '';    }    /**     * @param $id     * @return string     */    public function viewAction($id)    {        try {            Autorization::getInstance()->checkAutorizationWithException();            $phone = (new PhoneRepository())->findById($id);            if (is_null($phone)) {                throw new NotFoundEntityException('Phone number with this id not found');            }            $result = $this->render('phone_item_view.php', ['phone' => $phone]);            echo $result;        } catch (InvalidAutorizationException $exception) {            $result = $this->render('autorize_error.php', []);            echo $result;        } catch (NotFoundEntityException $exception) {            /**             * Выдать 404             */        } catch (\Exception $exception) {            $result = $this->render('server_error.php', []);            echo $result;        }        return '';    }}