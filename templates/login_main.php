<nav class="nav">
  <ul class="nav__list container">
  <?php foreach($categories as $key => $val):?>
	<li class="nav__item">
	  <a href="pages/all-lots.html"><?=$val['name'];?></a>
	</li>
  <?php endforeach;?>
  </ul>
</nav>
<?php $form_class = !empty($errors) ? " form--invalid" : "";?>
<form class="form container<?=$form_class;?>" action="login.php" method="post">
  <h2>Вход</h2>
  <?php $cva = edit_class_value_alert($errors, $form, 'email');?>
  <div class="form__item<?=$cva['class_name'];?>">
    <label for="email">E-mail*</label>
    <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?=htmlspecialchars($cva['value']);?>">
    <span class="form__error"><?=$cva['alert'];?></span>
  </div>
  <?php $cva = edit_class_value_alert($errors, $form, 'password');?>
  <div class="form__item form__item--last<?=$cva['class_name'];?>">
    <label for="password">Пароль*</label>
    <input id="password" type="password" name="password" placeholder="Введите пароль">
    <span class="form__error"><?=$cva['alert'];?></span>
  </div>
  <button name="login" type="submit" class="button">Войти</button>
</form>