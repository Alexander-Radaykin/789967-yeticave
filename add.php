<?php
date_default_timezone_set("Europe/Moscow");
require_once('functions.php');

session_start();

if (isset($_SESSION['user'])) {
	$user_name = $_SESSION['user']['name'];
	$user_avatar = $_SESSION['user']['avatar_link'] ? $_SESSION['user']['avatar_link'] : 'img/user.jpg';
}
else {
	$_SESSION['cur_page'] = "/add.php";
	header ("Location: /login.php");
	exit();
}

$title = 'Добавление лота';

$con = mysqli_connect('localhost', 'root', '', 'yeticave');
	if(!$con) {
		print("Ошибка подключения: " . mysqli_connect_error());
  	}
mysqli_set_charset($con, "utf8");

$sql_get_cat = "SELECT id, name FROM categories";
$res_get_cat = mysqli_query($con, $sql_get_cat);
  	if(!$res_get_cat) {
    	$error = mysqli_error($con);
    	print("Ошибка MySQL: " . $error);
  	}
$categories = mysqli_fetch_all($res_get_cat, MYSQLI_ASSOC);
$lot = [];
$required = ['lot-name' => 'Укажите наименование', 'message' => 'Введите описание', 'lot-rate' => 'Укажите начальную цену', 'lot-step' => 'Укажите шаг ставки', 'lot-date' => 'Укажите дату окончания торгов'];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  	$lot = $_POST;
    
  	foreach ($required as $key => $value) {
    	if (empty($_POST[$key])) {
			$errors[$key] = $value;
    	}
  	}
		
  	$ts_day = strtotime("+1 day") - time();
  	$f_options = ['options' => ['min_range' => 1, 'max_range' => 6]];
  	foreach ($_POST as $key => $value) {
    	if ($key == "category") {
			if (!filter_var($value, FILTER_VALIDATE_INT, $f_options)) {
        	$errors[$key] = 'Выберите категорию';
      		}
		}
		elseif ($key == "lot-rate" || $key == "lot-step") {
			$f_options = ['options' => ['min_range' => 1]];
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
		if (!$finfo) {
    		echo "Открытие базы данных fileinfo не удалось";
    		exit();
		}
    	$file_type = finfo_file($finfo, $tmp_name);
  
    	if ($file_type !== "image/png" && $file_type !== "image/jpeg") { 
			$errors['lot_img'] = 'Загрузите изображение в формате JPEG или PNG';
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
    	$content = include_template('add_main.php', compact('categories', 'errors', 'lot'));
  	}
	else {
		$sql_add_lot = "INSERT INTO lots (create_date, title, description, img_link, starting_price, end_date, bet_step, author_id, category_id)
		VALUES (NOW(), ?, ?, ?, ?, ?, ?, 1, ?)";
		
    	$stmt = db_get_prepare_stmt($con, $sql_add_lot, [$lot['lot-name'], $lot['message'], $lot['path'], $lot['lot-rate'], $lot['lot-date'], $lot['lot-step'], $lot['category']]);
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
  	$content = include_template('add_main.php', compact('categories', 'errors', 'lot'));
}

$layout = include_template('pages_layout.php', compact('title', 'user_name', 'user_avatar', 'content', 'categories'));
print($layout);