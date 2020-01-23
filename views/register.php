<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Телефонная книга</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/css/vendors/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="/css/vendors/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/css/vendors/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition register-page">
<div class="register-box">
    <div class="register-logo">
        <b>Телефонная</b> книга
    </div>

    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Регистрация</p>

            <form action="/register" method="post">
                <div class="input-group mb-3">
                    <input type="text" name="login" class="form-control <?= !empty($errors['login']) ? 'is-invalid' : '' ?>" placeholder="Логин" value="<?= $registerForm->login ?>">
                    <div class="input-group-append">
                        <div class="input-group-text"></div>
                    </div>

                    <? if(!empty($errors['login'])): ?>
                        <span class="error invalid-feedback"><?= $errors['login'] ?></span>
                    <? endif; ?>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control <?= !empty($errors['password']) ? 'is-invalid' : '' ?>" placeholder="Пароль" value="<?= $registerForm->password ?>">
                    <div class="input-group-append">
                        <div class="input-group-text"></div>
                    </div>

                    <? if(!empty($errors['password'])): ?>
                        <span class="error invalid-feedback"><?= $errors['password'] ?></span>
                    <? endif; ?>
                </div>

                <div class="input-group mb-3">
                    <input type="password" name="password_repeat" class="form-control <?= !empty($errors['password_repeat']) ? 'is-invalid' : '' ?>" placeholder="Подтверждение пароля" value="<?= $registerForm->repeatPassword ?>">
                    <div class="input-group-append">
                        <div class="input-group-text"></div>
                    </div>

                    <? if(!empty($errors['password_repeat'])): ?>
                        <span class="error invalid-feedback"><?= $errors['password_repeat'] ?></span>
                    <? endif; ?>
                </div>

                <div class="input-group mb-3">
                    <input type="text" name="email" class="form-control <?= !empty($errors['email']) ? 'is-invalid' : '' ?>" placeholder="email" value="<?= $registerForm->email ?>">
                    <div class="input-group-append">
                        <div class="input-group-text"></div>
                    </div>

                    <? if(!empty($errors['email'])): ?>
                        <span class="error invalid-feedback"><?= $errors['email'] ?></span>
                    <? endif; ?>
                </div>

                <div class="input-group mb-3">
                    <img src="<?= $registerForm->getCapchaImage() ?>">
                </div>

                <div class="input-group mb-3">
                    <input type="text" name="capcha" class="form-control <?= !empty($errors['capchaUser']) ? 'is-invalid' : '' ?>" placeholder="Код с картинки" value="<?= $registerForm->capchaUser ?>">
                    <div class="input-group-append">
                        <div class="input-group-text"></div>
                    </div>

                    <? if(!empty($errors['capchaUser'])): ?>
                        <span class="error invalid-feedback"><?= $errors['capchaUser'] ?></span>
                    <? endif; ?>

                    <input style="display: none" type="text" name="capchaId" class="form-control" value="<?= $registerForm->capchaId ?>">
                </div>

                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Зарегистрироваться</button>
                    </div>
                </div>
            </form>

            <br>
            <a href="/" class="text-center">Я уже зарегистрировался</a>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="/js/vendors/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/js/vendors/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/js/vendors/adminlte.min.js"></script>
</body>
</html>
