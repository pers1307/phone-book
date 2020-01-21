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
                        <h1>Контакт</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Редактирование контакта</h3>
                        </div>

                        <form role="form">
                            <div class="card-body">

                                <div class="text-center">
                                    <a class="thumbnail">
                                        <img src="/img/vendor/user.jpg" alt="...">
                                    </a>
                                </div>

                                <!--  todo: тут доработать -->
                                <div class="form-group">
                                    <label for="exampleInputFile">Фото</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Выберете файл</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="">Загрузка</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Имя</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Фамилия</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Телефон</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Email</label>
                                    <input type="email" class="form-control" id="exampleInputPassword1">
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

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/js/vendors/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/js/vendors/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="/js/vendors/jquery.dataTables.min.js"></script>
<script src="/js/vendors/dataTables.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="/js/vendors/adminlte.min.js"></script>

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
