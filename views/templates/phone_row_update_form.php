<?php
/**
 * @var Phone $phone
 */
use pers1307\phoneBook\entity\Phone;

?>
<tr class="js-new-row-phone">
    <td>
        <form id="js-new-row-phone-form" role="form" method="post" action="/api/phone/update" enctype="multipart/form-data">

            <? if(!empty($phone->getPathImage())): ?>
                <div class="text-center">
                    <a class="thumbnail">
                        <img width="200" src="<?= $phone->getPathImage() ?>" alt="<?= $phone->getName() ?>">
                    </a>
                </div>

                <br>
            <? endif; ?>

            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="photo" id="photoId">
                    <label class="custom-file-label" for="photoId">Выберете файл</label>
                </div>
            </div>
        </form>
    </td>
    <td>
        <input form="js-new-row-phone-form" type="text" name="name" class="form-control" id="nameId" value="<?= $phone->getName() ?>">
    </td>
    <td>
        <input form="js-new-row-phone-form" type="text" name="surname" class="form-control" id="surnameId" value="<?= $phone->getSurname() ?>">
    </td>
    <td>
        <input form="js-new-row-phone-form" type="text" name="phone" class="form-control" id="phoneId" value="<?= $phone->getPhone() ?>">
    </td>
    <td>
        <input form="js-new-row-phone-form" type="text" name="email" class="form-control" id="emailId" value="<?= $phone->getEmail() ?>">
        <input form="js-new-row-phone-form" type="hidden" name="id" class="form-control" value="<?= $phone->getId() ?>">
    </td>
    <td>
        <button form="js-new-row-phone-form" type="submit" class="btn btn-primary">Обновить</button>
    </td>
</tr>