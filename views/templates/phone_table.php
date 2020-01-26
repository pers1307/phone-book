<?php
/**
 * @var Phone $phone
 * @var string $name
 * @var string $next
 */
use pers1307\phoneBook\entity\Phone;

?>

<table id="phone-table" class="table table-bordered dataTable no-footer">
    <thead>
        <tr>
            <th>Фото</th>

            <th class="js-sort <?= ($name == 'name') ? ($next == 'asc') ? 'sorting_asc' : 'sorting_desc' : 'sorting' ?>" data-name="name" data-next="<?= ($name == 'name' && $next == 'asc') ? 'desc' : 'asc' ?>">Имя</span></th>
            <th class="js-sort <?= ($name == 'surname') ? ($next == 'asc') ? 'sorting_asc' : 'sorting_desc' : 'sorting' ?>" data-name="surname" data-next="<?= ($name == 'surname' && $next == 'asc') ? 'desc' : 'asc' ?>">Фамилия</th>
            <th class="js-sort <?= ($name == 'phone') ? ($next == 'asc') ? 'sorting_asc' : 'sorting_desc' : 'sorting' ?>" data-name="phone" data-next="<?= ($name == 'phone' && $next == 'asc') ? 'desc' : 'asc' ?>">Телефон</th>
            <th class="js-sort <?= ($name == 'email') ? ($next == 'asc') ? 'sorting_asc' : 'sorting_desc' : 'sorting' ?>" data-name="email" data-next="<?= ($name == 'email' && $next == 'asc') ? 'desc' : 'asc' ?>">Email </th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <? foreach($phones as $phone): ?>
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
        <? endforeach; ?>
    </tbody>
</table>