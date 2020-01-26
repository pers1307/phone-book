<tr class="js-new-row-phone">
    <td>
        <form id="js-new-row-phone-form" role="form" method="post" action="/api/phone/add" enctype="multipart/form-data">
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="photo" id="photoId">
                    <label class="custom-file-label" for="photoId">Выберете файл</label>
                </div>
            </div>
        </form>
    </td>
    <td>
        <input form="js-new-row-phone-form" type="text" name="name" class="form-control" id="nameId" value="">
    </td>
    <td>
        <input form="js-new-row-phone-form" type="text" name="surname" class="form-control" id="surnameId" value="">
    </td>
    <td>
        <input form="js-new-row-phone-form" type="text" name="phone" class="form-control" id="phoneId" value="">
    </td>
    <td>
        <input form="js-new-row-phone-form" type="text" name="email" class="form-control" id="emailId" value="">
    </td>
    <td>
        <button form="js-new-row-phone-form" type="submit" class="btn btn-primary">Добавить</button>
    </td>
</tr>