<div class="col-md-8 order-md-1">
  <h4 class="mb-3">Заполните данные</h4>
  <form class="col-md-12" method="post" action="../checker.php">
    <div class="row">
      <div class="col-md-6 mb-3">
        <label for="firstName">Имя</label>
        <input type="text" name="f_name" class="form-control" id="inputf_name" placeholder="" required>
        <div class="invalid-feedback">
          Valid first name is required.
        </div>
      </div>
      <div class="col-md-6 mb-3">
        <label for="lastName">Фамилия</label>
        <input type="text" name="l_name" class="form-control" id="inputf_name" placeholder="" required>
        <div class="invalid-feedback">
          Valid last name is required.
        </div>
      </div>
    </div>
    <div class="mb-3">
      <label for="username">Логин</label>
      <div class="input-group">
        <input type="text" name="login" class="form-control" id="username" placeholder="" name='user_login' required>
        <div class="invalid-feedback" style="width: 100%;">
          Your username is required.
        </div>
      </div>
    </div>
    <div class="mb-3">
      <label for="password">Пароль</label>
      <input type="password" name='password' class="form-control" id="inputPassword" placeholder="" required>
      <div class="invalid-feedback">
        Password is required
      </div>
    </div>
    <hr class="mb-4">
    <h4 class="mb-3">Уровень привилегий</h4>
    <div class="mb-3">
      <label for="password">Уровень привилегий</label>
      <input type="num" name='level_p' class="form-control" id="inputlevelp" placeholder="1-3(исправлю на радио)" required>
      <div class="invalid-feedback">
        Обязательно
      </div>
    </div>
    <hr class="mb-4">
    <button class="btn btn-primary btn-lg btn-block" type="submit" name='form-insert' >Добавить</button>
  </form>
</div>
