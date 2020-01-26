<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Телефонная книга | Список номеров</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="/css/vendors/all.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="/css/vendors/icheck-bootstrap.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="/css/vendors/dataTables.bootstrap4.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="/css/vendors/adminlte.min.css">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

        <link rel="stylesheet" href="/css/custom.css">
    </head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="/img/vendor/user.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">Логин пользователя</a>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="/phones" class="nav-link">
                            <p>Список номеров</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="/unlogin" class="nav-link">
                            <p>Выход</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Список номеров</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <a href="/phone/create" class="btn btn-primary">Добавить</a>
                        <br>

                        <? if(!empty($phones)): ?>
                            <div class="card-body">
                                <table id="example2" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Фото</th>
                                            <th>Имя</th>
                                            <th>Фамилия</th>
                                            <th>Телефон</th>
                                            <th>Email</th>
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
                                                    <a class="js-row-phone-remove" href="#" data-id="<?= $phone->getId() ?>">Удалить</a>
                                                </td>
                                            </tr>
                                        <? endforeach; ?>

<!--                                        <tr class="js-new-row-phone">-->
<!--                                            <form role="form" method="post" action="" enctype="multipart/form-data">-->
<!---->
<!--                                                <td>-->
<!--                                                    <div class="input-group">-->
<!--                                                        <div class="custom-file">-->
<!--                                                            <input type="file" class="custom-file-input" name="photo" id="photoId">-->
<!--                                                            <label class="custom-file-label" for="photoId">Выберете файл</label>-->
<!--                                                        </div>-->
<!--                                                    </div>-->
<!--                                                </td>-->
<!--                                                <td>-->
<!--                                                    <input type="text" name="name" class="form-control" id="nameId" value="">-->
<!--                                                </td>-->
<!--                                                <td>-->
<!--                                                    <input type="text" name="surname" class="form-control" id="surnameId" value="">-->
<!--                                                </td>-->
<!--                                                <td>-->
<!--                                                    <input type="text" name="phone" class="form-control" id="phoneId" value="">-->
<!--                                                </td>-->
<!--                                                <td>-->
<!--                                                    <input type="text" name="email" class="form-control" id="emailId" value="">-->
<!--                                                </td>-->
<!--                                                <td>-->
<!--                                                    <button type="submit" class="btn btn-primary">Добавить</button>-->
<!--                                                </td>-->
<!--                                            </form>-->
<!--                                        </tr>-->
                                    </tbody>
                                </table>
                            </div>
                        <? endif; ?>

                        <a href="#" class="js-phone-add btn btn-primary">Добавить через ajax</a>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>

    <aside class="control-sidebar control-sidebar-dark"></aside>
</div>

<div class="js-new-row-phone-template">
    <tr class="js-new-row-phone">
        <form role="form" method="post" action="" enctype="multipart/form-data">

            <td>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="photo" id="photoId">
                        <label class="custom-file-label" for="photoId">Выберете файл</label>
                    </div>
                </div>
            </td>
            <td>
                <input type="text" name="name" class="form-control" id="nameId" value="">
            </td>
            <td>
                <input type="text" name="surname" class="form-control" id="surnameId" value="">
            </td>
            <td>
                <input type="text" name="phone" class="form-control" id="phoneId" value="">
            </td>
            <td>
                <input type="text" name="email" class="form-control" id="emailId" value="">
            </td>
            <td>
                <button type="submit" class="btn btn-primary">Добавить</button>
            </td>
        </form>
    </tr>
</div>


<!-- jQuery -->
<script src="/js/vendors/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/js/vendors/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="/js/vendors/jquery.dataTables.min.js"></script>
<script src="/js/vendors/dataTables.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="/js/vendors/adminlte.min.js"></script>

<script src="/js/addPhoneAjax.js"></script>

<!--<script src="/js/addPhoneAjax.js"></script>-->

<!-- page script -->
<script>
//    $(function () {
//        $("#example1").DataTable();
//        $('#example2').DataTable({
//            "paging": true,
//            "lengthChange": false,
//            "searching": false,
//            "ordering": true,
//            "info": true,
//            "autoWidth": false
//        });
//    });
</script>
</body>
</html>
