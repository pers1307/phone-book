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
                    <li class="nav-item has-treeview">
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
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Контакт</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Редактирование контакта</h3>
                        </div>

                        <form role="form" method="post" action="" enctype="multipart/form-data">
                            <div class="card-body">

                                <? if(!empty($phoneForm->pathImage)): ?>
                                    <div class="text-center">
                                        <a class="thumbnail">
                                            <img width="200" src="<?= $phoneForm->pathImage ?>" alt="<?= $phoneForm->name ?>">
                                        </a>
                                    </div>
                                <? endif; ?>

                                <div class="form-group">
                                    <label for="exampleInputFile">Фото</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="photo" id="photoId">
                                            <label class="custom-file-label" for="photoId">Выберете файл</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="">Загрузка</span>
                                        </div>
                                    </div>

                                    <span>Рекомендуемый размер изображения 200x200</span>
                                    <br>
                                    <? if(!empty($errors['photo'])): ?>
                                        <span class="error invalid-feedback"><?= $errors['photo'] ?></span>
                                    <? endif; ?>
                                </div>

                                <div class="form-group">
                                    <label for="nameId">Имя</label>
                                    <input type="text" name="name" class="form-control <?= !empty($errors['name']) ? 'is-invalid' : '' ?>" id="nameId" value="<?= $phoneForm->name ?>">

                                    <? if(!empty($errors['name'])): ?>
                                        <span class="error invalid-feedback"><?= $errors['name'] ?></span>
                                    <? endif; ?>
                                </div>

                                <div class="form-group">
                                    <label for="surnameId">Фамилия</label>
                                    <input type="text" name="surname" class="form-control <?= !empty($errors['surname']) ? 'is-invalid' : '' ?>" id="surnameId" value="<?= $phoneForm->surname ?>">

                                    <? if(!empty($errors['surname'])): ?>
                                        <span class="error invalid-feedback"><?= $errors['surname'] ?></span>
                                    <? endif; ?>
                                </div>

                                <div class="form-group">
                                    <label for="phoneId">Телефон</label>
                                    <input type="text" name="phone" class="form-control <?= !empty($errors['phone']) ? 'is-invalid' : '' ?>" id="phoneId" value="<?= $phoneForm->phone ?>">

                                    <? if(!empty($errors['phone'])): ?>
                                        <span class="error invalid-feedback"><?= $errors['phone'] ?></span>
                                    <? endif; ?>
                                </div>

                                <div class="form-group">
                                    <label for="emailId">Email</label>
                                    <input type="text" name="email" class="form-control <?= !empty($errors['email']) ? 'is-invalid' : '' ?>" id="emailId" value="<?= $phoneForm->email ?>">

                                    <? if(!empty($errors['email'])): ?>
                                        <span class="error invalid-feedback"><?= $errors['email'] ?></span>
                                    <? endif; ?>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Записать</button>
                            </div>
                        </form>
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

<!-- jQuery -->
<script src="/js/vendors/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/js/vendors/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="/js/vendors/jquery.dataTables.min.js"></script>
<script src="/js/vendors/dataTables.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="/js/vendors/adminlte.min.js"></script>

</body>
</html>
