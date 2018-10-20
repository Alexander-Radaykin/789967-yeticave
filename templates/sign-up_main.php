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
<form class="form container<?=$form_class;?>" action="sign-up.php" method="post" enctype="multipart/form-data">
  <h2>Регистрация нового аккаунта</h2>
  <?php $cva = edit_class_value_alert($errors, $user, 'email');?>
  <div class="form__item<?=$cva['class_name'];?>">
    <label for="email">E-mail*</label>
    <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?=htmlspecialchars($cva['value']);?>">
    <span class="form__error"><?=$cva['alert'];?></span>
  </div>
  <?php $cva = edit_class_value_alert($errors, $user, 'password');?>
  <div class="form__item<?=$cva['class_name'];?>">
    <label for="password">Пароль*</label>
    <input id="password" type="password" name="password" placeholder="Введите пароль">
    <span class="form__error"><?=$cva['alert'];?></span>
  </div>
  <?php $cva = edit_class_value_alert($errors, $user, 'name');?>
  <div class="form__item<?=$cva['class_name'];?>">
    <label for="name">Имя*</label>
    <input id="name" type="text" name="name" placeholder="Введите имя" value="<?=htmlspecialchars($cva['value']);?>">
    <span class="form__error"><?=$cva['alert'];?></span>
  </div>
  <?php $cva = edit_class_value_alert($errors, $user, 'message');?>
  <div class="form__item<?=$cva['class_name'];?>">
    <label for="message">Контактные данные*</label>
    <textarea id="message" name="message" placeholder="Напишите как с вами связаться"><?=htmlspecialchars($cva['value']);?></textarea>
    <span class="form__error"><?=$cva['alert'];?></span>
  </div>
  <?php $class_name = isset($user['path']) ? " form__item--uploaded" : "";
  $img_preview = isset($user['path']) ? $user['path'] : "";?>
  <div class="form__item form__item--file form__item--last<?=$class_name;?>">
    <label>Аватар</label>
    <div class="preview">
      <button class="preview__remove" type="button" name="preview_img">x</button>
      <div class="preview__img">
        <img src="<?=$img_preview;?>" width="113" height="113" alt="Ваш аватар">
      </div>
    </div>
    <div class="form__input-file">
      <input class="visually-hidden" type="file" id="photo2" name="avatar" value="">
      <label for="photo2">
        <span>+ Добавить</span>
      </label>
    </div>
  </div>
  <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
  <button type="submit" class="button" name="create_acc">Зарегистрироваться</button>
  <a class="text-link" href="login.php">Уже есть аккаунт</a>
</form>