<?
$link=mysqli_connect("localhost", "proger7545_serv", "20002011m", "proger7545_serv");
?>

<?if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])){
    $query = mysqli_query($link, "SELECT *,INET_NTOA(user_ip) AS user_ip FROM users_test WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
    $userdata = mysqli_fetch_assoc($query);

    if(($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['id']) or (($userdata['user_ip'] !== $_SERVER['REMOTE_ADDR'])  and ($userdata['user_ip'] !== "0"))){
        setcookie("id", "", time() - 3600*24*30*12, "/");
        setcookie("hash", "", time() - 3600*24*30*12, "/", null, null, true); // httponly !!!
        print "Хм, что-то не получилось";
    }
    else{
        /*

        В это место нужно попробовать добавить html

        */
        //файл insert.php
        if(isset($_POST['submit']))
        {
            $err = [];

            // проверям логин
            if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))
            {
                $err[] = "Логин может состоять только из букв английского алфавита и цифр";
            }

            if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30)
            {
                $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
            }

            // проверяем, не сущестует ли пользователя с таким именем
            $query = mysqli_query($link, "SELECT user_id FROM users_test WHERE user_login='".mysqli_real_escape_string($link, $_POST['login'])."'");
            if(mysqli_num_rows($query) > 0)
            {
                $err[] = "Пользователь с таким логином уже существует в базе данных";
            }

            // Если нет ошибок, то добавляем в БД нового пользователя
            if(count($err) == 0)
            {
                $fname = $_POST['f_name'];
                $lname = $_POST['l_name'];
                $login = $_POST['login'];
                $levelp = $_POST['level_p'];
                // Убераем лишние пробелы и делаем двойное хеширование
                $password = md5(md5(trim($_POST['password'])));

                mysqli_query($link,"INSERT INTO users_test SET f_name = '".$fname."', l_name = '".$lname."', user_login='".$login."', user_password='".$password."', level_p = '".$levelp."'");
                header("Location:../cabinet.php"); exit();
            }
            else
            {
                print "<b>При регистрации произошли следующие ошибки:</b><br>";
                foreach($err AS $error)
                {
                    print $error."<br>";
                }
            }
        }
        //конец insert.php
    }
}
else{
    print "Необходимо зарегистрироваться";
}
?>

<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">
    <title>Checkout example · Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/checkout/">

    <!-- Bootstrap core CSS -->
<link href="../assets/styles/bootstrap.css" rel="stylesheet">

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
    <link href="../form-validation.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    <div class="container">
  <div class="py-5 text-center">
    <img class="mb-4" src="../assets/images/logo-b.png" alt="" width="150" height="91">
    <h2>Добавление сотрудника</h2>
    <p class="lead">Below is an example form built entirely with Bootstrap’s form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p>
  </div>
  <div class="row">

    <?if($userdata['level_p'] == 3){
      include("redeem-insert.php");
      include("form-insert.php");
    }



    ?>

  </div>

  <?
    include("footer-insert.php");
  ?>


</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.js"></script>
        <script src="../form-validation.js"></script></body>
</html>
