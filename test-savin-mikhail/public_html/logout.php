<?
// Страница разавторизации

// Удаляем куки
setcookie("id", "", time() - 3600*24*30*12, "/");
setcookie("hash", "", time() - 3600*24*30*12, "/",null,null,true); // httponly !!!

// Переадресовываем браузер на страницу проверки нашего скрипта
header("Location: /"); exit;

?>

<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="generator" content="Jekyll v4.0.1">
    <title>Stg-management</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/floating-labels/">

    <!-- Bootstrap core CSS -->
<link href="assets/styles/bootstrap.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="assets/styles/floating-labels.css" rel="stylesheet">
  </head>
  <body>
    <form class="form-signin" action="" method="post">
  <div class="text-center mb-4">
    <img class="mb-4" src="assets/images/logo-b.png" alt="" width="150" height="91">
    <h1 class="h3 mb-3 font-weight-normal">Авторизация</h1>
  </div>

  <div class="form-label-group">
    <input name="login" type="text" id="inputEmail" class="form-control" placeholder="Логин" required>
    <label for="inputLogin">Логин</label>
  </div>

  <div class="form-label-group">
    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Пароль" required>
    <label for="inputPassword">Пароль</label>
  </div>

  <div class="checkbox mb-3">
    <label>
      <input type="checkbox" value="remember-me"> Запомнить меня
    </label>
  </div>
  <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Войти</button>
  <p class="mt-5 mb-3 text-muted text-center">&copy;Copyrigth 2020-2021</p>
</form>
</body>
</html>
