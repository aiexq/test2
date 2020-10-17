<?
// Страница регистрации нового пользователя

// Соединямся с БД
$link=mysqli_connect("localhost", "proger7545_serv", "20002011m", "proger7545_serv");

if (isset($_POST['insert'])) {
header("location:insert.php");
}

if(isset($_POST['delete'])){
header("location:delete.php");
}

if(isset($_POST['form-insert']))
{
$err = [];

// проверям логин
if(!preg_match("/^[a-zA-Z0-9.]+$/",$_POST['login']))
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
$login = trim($_POST['login']);
$levelp = $_POST['level_p'];
// Убераем лишние пробелы и делаем двойное хеширование
$password = md5(md5(trim($_POST['password'])));

mysqli_query($link,"INSERT INTO users_test SET f_name = '".$fname."', l_name = '".$lname."', user_login='".$login."', user_password='".$password."', level_p = '".$levelp."'");
header("Location:cabinet.php");
exit();
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


if (isset($_POST['get_task'])) {
  $userExe = $_POST['get_task'];
  $executorId = $_POST['executor_id'];
  $taskTheme = $_POST['task_theme'];
  $taskText = $_POST['task_text'];
  mysqli_query($link, "INSERT INTO Tasks SET executor_id = '".$userExe."', task_theme = '".$taskTheme."', task_text = '".$taskText."', status = 'false'");
  header('location:cabinet.php');
}


if(isset($_POST['delFromAdminList'])){
  $userId = $_POST['delFromAdminList'];
  mysqli_query($link, "DELETE FROM users_test WHERE user_id = $userId");
  header('location:cabinet.php');
}

if(isset($_POST['change_status'])){
  $TaskStatus = $_POST['change_status'];
  mysqli_query($link, "UPDATE Tasks set status = 'true' where task_id = $TaskStatus");
  header('location:personal_page.php');
}
/*
if(isset($_POST['GoVisitorPage'])){
  header('location:visitor_page.php');

}
*/


?>
