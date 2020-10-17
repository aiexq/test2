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
        <a class='nav-link' href='personal_page.php'>$row2</a>
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
        <a class='nav-link' href='personal_page.php'>$row2</a>
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
        <a class='nav-link' href='personal_page.php'>$row2</a>
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
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Главная</h1>
        <div class="btn-toolbar mb-2 mb-md-0">

          <div class="btn-group mr-2">
            <form action="checker.php" method="post">

              <?
              if($userdata['level_p'] == 3){


                echo "<button type='submit' class='btn btn-sm btn-outline-secondary mr-1' name='insert'>Добавить сотрудника</button>";
              }
              ?>

            </form>
          </div>
        </div>
      </div>
              <?

              if($userdata['level_p'] == 3 ){
                  echo "<div class='container mt-3'>
              <br>
              <ul class='nav nav-tabs'>
                <li class='nav-item'>
                  <a class='nav-link active' data-toggle='tab' href='#home'>Задачи</a>
                </li>
                <li class='nav-item'>
                  <a class='nav-link' data-toggle='tab' href='#menu1'>Сотрудники</a>
                </li>
              </ul>
              <div class='tab-content'>
                <div id='home' class='container tab-pane active'><br>";

            
                  
                  echo "<div class='tab-content' id='myTabContent'>
                    <table class='table table-stripped table-sm' style='border-top: 2px solid white;'>
                       <thead>
                          <tr>
                             <th>id</th>
                                <th>Исполнитель</th>
                                <th>email</th>
                                <th>Тема задачи</th>
                                <th>Текст задачи</th>
                                <th>Статус<th>
                          </tr>
                        </thead>
                        <tbody>";
                      
                        $paginationQuery = 'SELECT task_id, executor_id, task_theme, task_text, case when status = "True" then "Выполнено" when status = "False" then "Не выполнено" end status FROM Tasks';
                        $loginQuery = 'select Tasks.task_id, Tasks.executor_id, users_test.user_id, Tasks.status, Tasks.task_theme, Tasks.task_text, users_test.user_login from users_test, Tasks where Tasks.executor_id = users_test.user_id';
                        $mainLoginQuery = mysqli_query($link, $loginQuery);

                      while($tableTask = mysqli_fetch_array($mainLoginQuery)){
                        $taskId = $tableTask['task_id'];
                        $executorId = $tableTask['executor_id'];
                        $loginUser = $tableTask['user_login'];
                        $taskTheme = $tableTask['task_theme'];
                        $taskText = $tableTask['task_text'];
                        $taskStatus = $tableTask['status'];
                        echo "
                        <tr>
                      <td>$taskId</td>
                      <td>$executorId</td>
                      <td>$loginUser</td>
                      <td>$taskTheme</td>
                      <td>$taskText</td>
                      <td>$taskStatus</td>
                      <td></td>
                    </tr>";
                      }
                      echo "
                      </tbody>
                      </table>
                      </div>";
                      
                
                  echo "</div>
                <div id='menu1' class='container tab-pane fade'><br>


                  
                  
                  <div class='tab-content' id='myTabContent'>
                    <table class='table table-striped table-sm' style='border-top: 2px solid white;'>
                      <thead>
                        <tr>
                          <th>id</th>
                          <th>Имя</th>
                          <th>Фамилия</th>
                          <th>Логин</th>
                          <th>Уровень</th>
                          <th></th>
                          <th></th>
                        </tr>
                      </thead>
                    <tbody>";
                    $result=mysqli_query($link, "SELECT user_id, f_name, l_name, user_login,  case when level_p = 1 then 'Сотрудник' when level_p = 2 then 'Менеджер' when level_p = 3 then 'Администратор' end level FROM users_test");
                    $result2=mysqli_query($link, "SELECT * from Tasks");
                    while($row = mysqli_fetch_array($result)){

                      $executorId=$row['user_id'];
                      $taskTheme=$column['task_theme'];
                      $taskText=$column['task_text'];

                      $userId=$row['user_id'];
                      $fname=$row['f_name'];
                      $lname=$row['l_name'];
                      $levelp=$row['level'];
                      $userLogin=$row['user_login'];
                      echo "
                      <tr>
                        <td>$userId</td>
                        <td>$fname</td>
                        <td>$lname</td>
                        <td>$userLogin</td>
                        <td>$levelp</td>
                        <td>
                          <div class='dropdown'>
                            <button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenu2' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            Подробно
                            </button>
                            <div class='dropdown-menu' aria-labelledby='dropdownMenu2'>
                              <form method='post' action='visitor_page.php'>
                                <button class='dropdown-item' type='submit' name='GoVisitorPage' value='$userId' >Профиль</button>

                                <button type='button' class='dropdown-item' data-toggle='modal' data-target='#model$userId' data-whatever='@mdo'>Создать новое задание</button>


                              </form>

                            </div>
                          </div>

                        </td>

                        <!--задание-->
                        <div class='modal fade' id='model$userId' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                          <div class='modal-dialog' role='document'>
                            <div class='modal-content'>
                              <div class='modal-header'>
                                <h5 class='modal-title' id='exampleModalLabel'>Новое задание</h5>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                  <span aria-hidden='true'>&times;</span>
                                </button>
                              </div>
                              <div class='modal-body'>
                                <form method='post' action='checker.php'>
                                  <div class='form-group'>
                                    <label for='recipient-name' class='col-form-label'>Тема задания:</label>
                                    <input type='text' class='form-control' name='task_theme' id='recipient-name'>
                                  </div>
                                  <div class='form-group'>
                                    <label for='message-text' class='col-form-label'>Текст задания:</label>
                                    <textarea class='form-control' id='message-text' name='task_text'></textarea>
                                  </div>
                                  <div class='modal-footer'>
                                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Отмена</button>
                                    <button type='submit' class='btn btn-primary' name='get_task' value='$userId'>Отправить задачу</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>

                        <td>
                        ";
                        ?>

                        <?
                        $query3 = mysqli_query($link, "SELECT *,INET_NTOA(user_ip) AS user_ip FROM users_test WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
                        $userdata3 = mysqli_fetch_assoc($query3);


                        $localId = $userdata3['user_id'];

                        if($levelp != "Администратор"){
                          echo "<form method='post' action='checker.php'>
                          <button type='submit' class='btn btn-sm btn-outline-secondary' name='delFromAdminList' value ='$userId'>Удалить</button>
                          </form>";
                        }
                        echo "

                        </td>
                        <td></td>
                      </tr>";

                    }

                echo "</tbody></table>";
                  echo "
                  <div class='tab-pane fade' id='tasks' role='tabpanel' aria-labelledby='profile-tab'>";

                  $userList = $userdata['user_id'];
                  $userOneQuery=mysqli_query($link, "SELECT user_id, task_id, executor_id, task_theme, task_text FROM Tasks, users_test WHERE Tasks.executor_id = $userList and Tasks.executor_id = users_test.user_id");
                  //$userTwoQuery=mysqli_query($link, "SELECT *,INET_NTOA(user_ip) AS user_ip FROM users_test WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
                   echo "<div class='row'>";
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
                      <form>
                      <button type='button' class='btn btn-sm btn-outline-secondary' data-toggle='modal' data-target='#modal$taskId'>Подробнее</button>
                      <button type='button' class='btn btn-sm btn-outline-secondary'>Отправить</button>
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
                      <small class='text-muted'>9 mins</small>
                    </div>
                  </div>
                </div>
              </div>";
            }

                    echo "
                  </div>
                  <div class='tab-pane fade' id='contact' role='tabpanel' aria-labelledby='contact-tab'>
                    ...
                  </div>
                </div>";
                echo "</div>
              </div>
            </div>";
          }

            //Права менеджера
            if($userdata['level_p'] == 2 ){
              //Вкладки


              echo "<div class='tab-content' id='myTabContent'>


                  <table class='table table-striped table-sm' style='border-top: 2px solid white;'>
                    <thead>
                      <tr>
                        <th>id</th>
                        <th>Имя</th>
                        <th>Фамилия</th>
                        <th>Логин</th>
                        <th>Уровень</th>
                        <th></th>
                      </tr>
                    </thead>
                  <tbody>";
                  $result=mysqli_query($link, "SELECT user_id, f_name, l_name, user_login,  case when level_p = 1 then 'Сотрудник' when level_p = 2 then 'Менеджер' when level_p = 3 then 'Администратор' end level FROM users_test");
                  $result2=mysqli_query($link, "SELECT * from Tasks");


                  while($row = mysqli_fetch_array($result)){




                    $executorId=$row['user_id'];
                    $taskTheme=$column['task_theme'];
                    $taskText=$column['task_text'];



                    $userId=$row['user_id'];
                    $fname=$row['f_name'];
                    $lname=$row['l_name'];
                    $levelp=$row['level'];
                    $userLogin=$row['user_login'];
                    echo "
                    <tr>
                      <td>$userId</td>
                      <td>$fname</td>
                      <td>$lname</td>
                      <td>$userLogin</td>
                      <td>$levelp</td>
                      <td>
                        <div class='dropdown'>
                          <button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenu2' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                          Подробно
                          </button>
                          <div class='dropdown-menu' aria-labelledby='dropdownMenu2'>
                            <form method='post'>
                              <button class='dropdown-item' type='button'>Профиль</button>

                              <button type='button' class='dropdown-item' data-toggle='modal' data-target='#model$userId' data-whatever='@mdo'>Создать новое задание</button>


                            </form>

                          </div>
                        </div>

                      </td>

                      <!--задание-->
                      <div class='modal fade' id='model$userId' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                        <div class='modal-dialog' role='document'>
                          <div class='modal-content'>
                            <div class='modal-header'>
                              <h5 class='modal-title' id='exampleModalLabel'>Новое задание</h5>
                              <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                              </button>
                            </div>
                            <div class='modal-body'>
                              <form method='post' action='checker.php'>
                                <div class='form-group'>
                                  <label for='recipient-name' class='col-form-label'>Тема задания:</label>
                                  <input type='text' class='form-control' name='task_theme' id='recipient-name'>
                                </div>
                                <div class='form-group'>
                                  <label for='message-text' class='col-form-label'>Текст задания:</label>
                                  <textarea class='form-control' id='message-text' name='task_text'></textarea>
                                </div>
                                <div class='modal-footer'>
                                  <button type='button' class='btn btn-secondary' data-dismiss='modal'>Отмена</button>
                                  <button type='submit' class='btn btn-primary' name='get_task' value='$userId'>Отправить задачу</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>


                      <td></td>
                    </tr>";

                  }

              echo "</tbody></table>";
                echo "

                <div class='tab-pane fade' id='tasks' role='tabpanel' aria-labelledby='profile-tab'>";

                $userList = $userdata['user_id'];
                $userOneQuery=mysqli_query($link, "SELECT user_id, task_id, executor_id, task_theme, task_text FROM Tasks, users_test WHERE Tasks.executor_id = $userList and Tasks.executor_id = users_test.user_id");
                //$userTwoQuery=mysqli_query($link, "SELECT *,INET_NTOA(user_ip) AS user_ip FROM users_test WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
                echo "<div class='row'>";
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
                      <form>
                      <button type='button' class='btn btn-sm btn-outline-secondary' data-toggle='modal' data-target='#modal$taskId'>Подробнее</button>
                      <button type='button' class='btn btn-sm btn-outline-secondary'>Отправить</button>
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
                      <small class='text-muted'>9 mins</small>
                    </div>
                  </div>
                </div>
              </div>";
            }

                  echo "
                  </div>
                </div>
                <div class='tab-pane fade' id='contact' role='tabpanel' aria-labelledby='contact-tab'>
                  ...
                </div>
              </div>";
          }
            //Права сотрудника

            if($userdata['level_p'] == 1){
                $userList = $userdata['user_id'];
                $userOneQuery=mysqli_query($link, "SELECT user_id, task_id, executor_id, task_theme, task_text FROM Tasks, users_test WHERE Tasks.executor_id = $userList and Tasks.executor_id = users_test.user_id");
                //$userTwoQuery=mysqli_query($link, "SELECT *,INET_NTOA(user_ip) AS user_ip FROM users_test WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
                while($tasks = mysqli_fetch_array($userOneQuery)){
                  $taskId=$tasks['task_id'];
                  $executorId=$tasks['executor_id'];
                  $taskTheme=$tasks['task_theme'];
                  $taskText=$tasks['task_text'];


        ?>

        <?
            }
          }

          ?>




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
