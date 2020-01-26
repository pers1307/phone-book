<tr class="js-row-phone" data-id="<?= $phone->getId() ?>">
    <td>
        <? if(!empty($phone->getPathImage())): ?>
            <img width="200" src="<?= $phone->getPathImage() ?>" alt="<?= $phone->getName() ?>">
        <? endif; ?>
    </td>
    <td>
        <?= $phone->getName() ?>
    </td>
    <td>
        <?= $phone->getSurname() ?>
    </td>
    <td>
        <?= $phone->getPhone() ?>
        <br>
        <?= $phoneToText->convertPhoneToText($phone->getPhone()) ?>
    </td>
    <td>
        <?= $phone->getEmail() ?>
    </td>
    <td>
        <a href="/phone/edit/<?= $phone->getId() ?>">Редактировать</a>
        <br>
        <a class="js-row-phone-update" href="#" data-id="<?= $phone->getId() ?>">Редактировать через ajax</a>
        <br>
        <a class="js-row-phone-remove" href="#" data-id="<?= $phone->getId() ?>">Удалить</a>
    </td>
</tr>