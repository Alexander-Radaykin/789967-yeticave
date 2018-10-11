<?php
date_default_timezone_set("Europe/Moscow");
require_once('functions.php');

$con = mysqli_connect('localhost', 'root', '', 'yeticave');
	if(!$con) {
		print("Ошибка подключения: " . mysqli_connect_error());
  	}
mysqli_set_charset($con, "utf8");

$sql_get_cat = "SELECT id, name FROM categories";
$sql_add_lot = "INSERT INTO lots (create_date, title, description, img_link, starting_price, end_date, bet_step, author_id, category_id)
VALUES (NOW(), ?, ?, ?, ?, ?, ?, 1, ?)";
$res_get_cat = mysqli_query($con, $sql_get_cat);
  	if(!$res_get_cat) {
    	$error = mysqli_error($con);
    	print("Ошибка MySQL: " . $error);
  	}
$categories = mysqli_fetch_all($res_get_cat, MYSQLI_ASSOC);
$lot = [];
$required = ['lot-name' => 'Укажите наименование', 'category' => 'Выберите категорию', 'message' => 'Введите описание', 'lot-rate' => 'Укажите начальную цену', 'lot-step' => 'Укажите шаг ставки', 'lot-date' => 'Укажите дату окончания торгов'];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  	$lot = $_POST;
    
  	foreach ($required as $key => $value) {
    	if (empty($_POST[$key])) {
			$errors[$key] = $value;
    	}
  	}
  
  	$ts_day = strtotime("+1 day") - time();
  	$f_options = ['options' => ['min_range' => 1]];
  	foreach ($_POST as $key => $value) {
    	if ($key == "lot-rate" || $key == "lot-step") {
      		if (!filter_var($value, FILTER_VALIDATE_INT, $f_options)) {
        	$errors[$key] = 'Значение должно быть натуральным числом';
      		}
		}
		elseif ($key == "lot-date") {
			$ts_lot = strtotime($value);
      		if (($ts_lot - time()) < $ts_day) {
        	$errors[$key] = 'Торги должны длиться не менее 24 часов';
			}
		}
  	}
    
  	if (isset($_FILES['lot_img']['name']) && !empty($_FILES['lot_img']['name'])) {
		$tmp_name = $_FILES['lot_img']['tmp_name'];
    	$path = $_FILES['lot_img']['name'];
    	$finfo = finfo_open(FILEINFO_MIME_TYPE);
    	$file_type = finfo_file($finfo, $tmp_name);
  
    	if ($file_type !== "image/png" || $file_type !== "image/jpeg") {  $errors['lot_img'] = 'Загрузите изображение в формате JPEG или PNG';
    	}
    	else {
      	move_uploaded_file($tmp_name, 'img/' . $path);
      	$lot['path'] = 'img/' . $path;
    	}
  	} 
  	else {
    	$errors['lot_img'] = 'Загрузите файл';
  	}
    
  	if (count($errors)) {
    	$add_main_content = include_template('add_main.php', compact('categories', 'errors', 'lot'));
    	$add_lay_content = include_template('add_layout.php', compact('add_main_content', 'categories'));
    	print ($add_lay_content);
  	}
	else {
    	$stmt = db_get_prepare_stmt($con, $sql_add_lot, [$lot['title'], $lot['description'], $lot['path'], $lot['starting_price'], $lot['end_date'], $lot['end_date'], $lot['bet_step'], $lot['category']]);
    	$res_add_lot = mysqli_stmt_execute($stmt);
    
    	if ($res_add_lot) {
      	$lot_id = mysqli_insert_id($con);
      	header("Location: /lot.php?lot_id=" . $lot_id);
    	}
    	else {
      	$error = mysqli_error($con);
		print("Ошибка MySQL: " . $error);
    	}
  	}
}
else {
  	$add_main_content = include_template('add_main.php', compact('categories'));
  	$add_lay_content = include_template('add_layout.php', compact('add_main_content', 'categories'));
    
  	print($add_lay_content);
}
