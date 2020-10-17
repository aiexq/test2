<?
// Скрипт проверки

// Соединямся с БД
$link=mysqli_connect("localhost", "proger7545_serv", "20002011m", "proger7545_serv");
if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])){
    $query = mysqli_query($link, "SELECT *,INET_NTOA(user_ip) AS user_ip FROM users_test WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
    $userdata = mysqli_fetch_assoc($query);


    if(($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['id']) or (($userdata['user_ip'] !== $_SERVER['REMOTE_ADDR'])  and ($userdata['user_ip'] !== "0"))){
        setcookie("id", "", time() - 3600*24*30*12, "/");
        setcookie("hash", "", time() - 3600*24*30*12, "/", null, null, true); // httponly !!!
        print "Хм, что-то не получилось";
    }
    else{
        //$levelp = $userdata['.level_p.'];
    }
}
else{
    header("location:index.php");
}

?>

<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">
    <title>Test-Savin-Mikhail</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/dashboard/">

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
    <link href="dashboard.css" rel="stylesheet">
    <link href="album.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">Test</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100" type="text" placeholder="" aria-label="">

  <?
  if($userdata['level_p'] == 3){
    $result3 = mysqli_query($link, "SELECT *,INET_NTOA(user_ip) AS user_ip FROM users_test WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
    $userdata2 = mysqli_fetch_array($result3);
    $row2 = $userdata2['user_login'];


    echo "
    <ul class='navbar-nav px-3'>
    <li class='nav-item text-nowrap'>
      <a class='nav-link' href='#'>Администратор</a>
    </li></ul><ul class='navbar-nav px-3'>
      <li class='nav-item text-nowrap'>
        <a class='nav-link' href='#'>$row2</a>
      </li>

    </ul>
    "
    ;
  }
  if($userdata['level_p'] == 2){
    $result3 = mysqli_query($link, "SELECT *,INET_NTOA(user_ip) AS user_ip FROM users_test WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
    $userdata2 = mysqli_fetch_array($result3);
    $row2 = $userdata2['user_login'];

    echo "
    <ul class='navbar-nav px-3'>
    <li class='nav-item text-nowrap'>
      <a class='nav-link' href='#'>Менеджер</a>
    </li></ul><ul class='navbar-nav px-3'>
      <li class='nav-item text-nowrap'>
        <a class='nav-link' href='#'>$row2</a>
      </li>

    </ul>
    "
    ;
  }
  if($userdata['level_p'] == 1){
    $result3 = mysqli_query($link, "SELECT *,INET_NTOA(user_ip) AS user_ip FROM users_test WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
    $userdata2 = mysqli_fetch_array($result3);
    $row2 = $userdata2['user_login'];

    echo "
    <ul class='navbar-nav px-3'>
    <li class='nav-item text-nowrap'>
      <a class='nav-link' href='#'>Сотрудник</a>
    </li></ul><ul class='navbar-nav px-3'>
      <li class='nav-item text-nowrap'>
        <a class='nav-link' href='#'>$row2</a>
      </li>

    </ul>
    "
    ;
  }
  ?>


  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="logout.php">Выход</a>
    </li>

  </ul>


</nav>

<div class="container-fluid">
  <div class="row">
    
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
        <!--Блок с фото-->
        <div class="row mt-4">
          <?php
          if($userdata['level_p'] > 0){
            $result3 = mysqli_query($link, "SELECT *,INET_NTOA(user_ip) AS user_ip FROM users_test WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
            $result=mysqli_query($link, "SELECT user_id, f_name, l_name, user_login,  case when level_p = 1 then 'Сотрудник' when level_p = 2 then 'Менеджер' when level_p = 3 then 'Администратор' end level FROM users_test");
            $userdata2 = mysqli_fetch_array($result3);
            $userdata3 = mysqli_fetch_array($result);
            $login = $userdata2['user_login'];
            $user_id = $userdata2['user_id'];
            $userFname = $userdata2['f_name'];
            $userLname = $userdata2['l_name'];
            $userLevel = $userdata3['level'];

            echo "<div class='col-lg-2'>
              <img class='rounded-circle' src='data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==' alt='Generic placeholder image' width='140' height='140'>

            </div>
            <div class='col-lg-4'>
              <h2>$userFname $userLname</h2>
              <p>О сотруднике</p>
            </div>
            <div class='col-lg-3'>
              <h6>Уровень:</h6>
              <p>$userLevel</p>
              <h6>Логин:</h6>
              <p>$login</p>
              <h6>ID</h6>
              <p>$user_id</p>
            </div>";

            ?>

            <?
            $userList = $userdata['user_id'];
            $userOneQuery=mysqli_query($link, "SELECT user_id, task_id, executor_id, task_theme, task_text FROM Tasks, users_test WHERE Tasks.executor_id = $userList and Tasks.executor_id = users_test.user_id and Tasks.status = 'false'");
            ?><?
            echo "
            </div>
            <div>
            <h2>Доступные задания</h2>
            <div class='row'>";

            while($tasks = mysqli_fetch_array($userOneQuery)){
              $taskId=$tasks['task_id'];
              $executorId=$tasks['executor_id'];
              $taskTheme=$tasks['task_theme'];
              $taskText=$tasks['task_text'];

              echo "
              <div class='col-md-3 mt-1'>
            <div class='card mb-4 shadow-sm'>
              <svg class='bd-placeholder-img card-img-top' width='100%' height='225' xmlns='http://www.w3.org/2000/svg' preserveAspectRatio='xMidYMid slice' focusable='false' role='img' aria-label='Placeholder: Thumbnail'><title>Placeholder</title><rect width='100%' height='100%' fill='#55595c'/><text x='50%' y='50%' fill='#eceeef' dy='.3em'>$taskTheme</text></svg>
              <div class='card-body'>
                <p class='card-text text-truncate'>$taskText</p>
                <div class='d-flex justify-content-between align-items-center'>
                  <div class='btn-group'>
                  <form method='post' action='checker.php'>
                    <button type='button' class='btn btn-sm btn-outline-secondary' data-toggle='modal' data-target='#modal$taskId'>Подробнее</button>
                    <button type='submit' name='change_status' class='btn btn-sm btn-outline-secondary' value='$taskId'>Отправить</button>
                  </form>


                  <!--задание-->
                  <div class='modal fade' id='modal$taskId' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
                  <div class='modal-dialog modal-dialog-centered' role='document'>
                  <div class='modal-content'>
                  <div class='modal-header'>
                  <h5 class='modal-title' id='exampleModalLongTitle'>$taskTheme</h5>
                  <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                  </button>
                  </div>
                  <div class='modal-body'>
                  <p style=''>$taskText</p>
                  </div>
                  <div class='modal-footer'>
                  <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                  <button type='button' class='btn btn-primary'>Save changes</button>
                  </div>
                  </div>
                  </div>
                  </div>


                  </div>
                  
                </div>
              </div>
            </div>
          </div>";
        }

        echo "
        </div>";

          }
          echo "
          <div>
          <h2>Выполненные</h2>
          <div class='row'>";
          $userList = $userdata['user_id'];
          $userOneQuery=mysqli_query($link, "SELECT user_id, task_id, executor_id, task_theme, task_text FROM Tasks, users_test WHERE Tasks.executor_id = $userList and Tasks.executor_id = users_test.user_id and Tasks.status = 'true'");

          while($tasks = mysqli_fetch_array($userOneQuery)){
            $taskId=$tasks['task_id'];
            $executorId=$tasks['executor_id'];
            $taskTheme=$tasks['task_theme'];
            $taskText=$tasks['task_text'];

            echo "
            <div class='col-md-3 mt-1'>
          <div class='card mb-4 shadow-sm'>
            <svg class='bd-placeholder-img card-img-top' width='100%' height='225' xmlns='http://www.w3.org/2000/svg' preserveAspectRatio='xMidYMid slice' focusable='false' role='img' aria-label='Placeholder: Thumbnail'><title>Placeholder</title><rect width='100%' height='100%' fill='#55595c'/><text x='50%' y='50%' fill='#eceeef' dy='.3em'>$taskTheme</text></svg>
            <div class='card-body'>
              <p class='card-text text-truncate'>$taskText</p>
              <div class='d-flex justify-content-between align-items-center'>
                <div class='btn-group'>
                <form method='post' action='checker.php'>
                  <button type='button' class='btn btn-sm btn-outline-secondary' data-toggle='modal' data-target='#modal$taskId'>Подробнее</button>

                </form>


                <!--задание-->
                <div class='modal fade' id='modal$taskId' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
                <div class='modal-dialog modal-dialog-centered' role='document'>
                <div class='modal-content'>
                <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLongTitle'>$taskTheme</h5>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button>
                </div>
                <div class='modal-body'>
                <p style=''>$taskText</p>
                </div>
                <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                <button type='button' class='btn btn-primary'>Save changes</button>
                </div>
                </div>
                </div>
                </div>


                </div>
              </div>
            </div>
          </div>
        </div>";
      }

      echo "
      </div>";

          ?>

        </div>

        <!--Блок с Информацией о пользователе-->






    </main>
  </div>
</div>
<script type="text/javascript">
$('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body input').val(recipient)
})
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery.slim.min.js"><\/script>')</script>
        <script src="assets/js/bootstrap.bundle.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
        <script src="dashboard.js"></script></body>
</html>
