<nav class="nav">
      <ul class="nav__list container">
        <?php foreach($categories as $key => $val):?>
        <li class="nav__item">
        <a href="pages/all-lots.html"><?=$val['name'];?></a>
        </li>
        <?php endforeach;?>
      </ul>
    </nav>
      <?php $form_class = !empty($errors) ? "form--invalid" : "";?>
    <form class="form form--add-lot container <?=$form_class;?>" action="add.php" method="post" enctype="multipart/form-data">
      <h2>Добавление лота</h2>
      <div class="form__container-two">
        <?php $class_name = isset($errors['lot-name']) ? "form__item--invalid" : "";
        $value = isset($lot['lot-name']) ? $lot['lot-name'] : "";
        $alert = isset($errors['lot-name']) ? $errors['lot-name'] : "";?>
        <div class="form__item <?=$class_name;?>">
          <label for="lot-name">Наименование</label>
          <input id="lot-name" type="text" name="lot-name" placeholder="Введите наименование лота" value="<?=$value;?>" required>
          <span class="form__error"><?=$alert;?></span>
        </div>
        <?php $class_name = isset($errors['category']) ? "form__item--invalid" : "";
        $value = isset($lot['category']) ? $lot['category'] : "";
        $alert = isset($errors['category']) ? $errors['category'] : "";?>
        <div class="form__item <?=$class_name;?>">
          <label for="category">Категория</label>
          <select id="category" name="category" required>
            <option>Выберите категорию</option>
            <?php foreach($categories as $key => $val):?>
            <option value="<?=$val['id'];?>"><?=$val['name'];?></option>
            <?php endforeach;?>
          </select>
          <span class="form__error"><?=$alert;?></span>
        </div>
      </div>
      <?php $class_name = isset($errors['message']) ? "form__item--invalid" : "";
      $value = isset($lot['message']) ? $lot['message'] : "";
      $alert = isset($errors['message']) ? $errors['message'] : "";?>
      <div class="form__item form__item--wide <?=$class_name;?>">
        <label for="message">Описание</label>
        <textarea id="message" name="message" placeholder="Напишите описание лота" value="<?=$value;?>" required></textarea>
        <span class="form__error"><?=$alert;?></span>
      </div>
      <?php $class_name = isset($errors['lot_img']) ? "form__item--invalid" : "form__item--uploaded";
      $img_preview = isset($lot['path']) ? $lot['path'] : "";?>
      <div class="form__item form__item--file <?=$class_name;?>">
        <label>Изображение</label>
        <div class="preview">
          <button class="preview__remove" type="button">x</button>
          <div class="preview__img">
            <img src="<?=$img_preview;?>" width="113" height="113" alt="Изображение лота">
          </div>
        </div>
        <div class="form__input-file">
          <input class="visually-hidden" type="file" id="photo2" name="lot_img" value="">
          <label for="photo2">
            <span>+ Добавить</span>
          </label>
        </div>
      </div>
      <div class="form__container-three">
        <?php $class_name = isset($errors['lot-rate']) ? "form__item--invalid" : "";
        $value = isset($lot['lot-rate']) ? $lot['lot-rate'] : "";
        $alert = isset($errors['lot-rate']) ? $errors['lot-rate'] : "";?>
        <div class="form__item form__item--small <?=$class_name;?>">
          <label for="lot-rate">Начальная цена</label>
          <input id="lot-rate" type="number" name="lot-rate" placeholder="0" value="<?=$value;?>" required>
          <span class="form__error"><?=$alert;?></span>
        </div>
        <?php $class_name = isset($errors['lot-step']) ? "form__item--invalid" : "";
        $value = isset($lot['lot-step']) ? $lot['lot-step'] : "";
        $alert = isset($errors['lot-step']) ? $errors['lot-step'] : "";?>
        <div class="form__item form__item--small <?=$class_name;?>">
          <label for="lot-step">Шаг ставки</label>
          <input id="lot-step" type="number" name="lot-step" placeholder="0" value="<?=$value;?>" required>
          <span class="form__error"><?=$alert;?></span>
        </div>
        <?php $class_name = isset($errors['lot-date']) ? "form__item--invalid" : "";
        $value = isset($lot['lot-date']) ? $lot['lot-date'] : "";
        $alert = isset($errors['lot-date']) ? $errors['lot-date'] : "";?>
        <div class="form__item <?=$class_name;?>">
          <label for="lot-date">Дата окончания торгов</label>
          <input class="form__input-date" id="lot-date" type="date" name="lot-date" value="<?=$value;?>" required>
          <span class="form__error"><?=$alert;?></span>
        </div>
      </div>
      <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
      <button type="submit" name="add_lot_submit" class="button">Добавить лот</button>
    </form>