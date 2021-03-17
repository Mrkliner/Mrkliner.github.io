div class="form-wrap">
  <div class="profile"><img src="https://html5book.ru/wp-content/uploads/2016/10/profile-image.png">
    <h1>Регистрация</h1>
  </div>
  <form method="post" action="form.php">
    <div>
      <label for="name">Имя</label>
      <input type="text" name="name" required>
    </div>
    <div class="radio">
      <span>Пол</span>
      <label>
        <input type="radio" name="sex" value="мужской">мужской
        <div class="radio-control male"></div>
      </label>
      <label>
        <input type="radio" name="sex" value="женский">женский
        <div class="radio-control female"></div>
      </label>
    </div>
    <div>
      <label for="email">E-mail</label>
      <input type="email" name="email" required>
    </div>
    <div>
      <label for="country">Страна</label>
      <select name="country">
        <option>Выберите страну проживания</option>
        <option value="Россия">Россия</option> 
        <option value="Украина">Украина</option> 
        <option value="Беларусь">Беларусь</option> 
      </select> 
      <div class="select-arrow"></div> 
    </div> 
    <button type="submit">Отправить</button> 
  </form> 
</div>
