<?php
date_default_timezone_set("Europe/Moscow");
require_once('functions.php');

$title = 'Регистрация';

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
$user = [];
$required = ['email' => 'Укажите Ваш Email', 'password' => 'Укажите пароль', 'name' => 'Укажите Ваше имя', 'message' => 'Укажите контактные данные'];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$user = $_POST;
	
	foreach ($required as $field => $alert) {
		if (empty($_POST[$field])) {
			$errors[$field] = $alert;
		}
	}
	
	if (!empty($user['email']) && !filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
		$errors['email'] = 'Укажите корректный Email';
	}
	else {
		$email = mysqli_real_escape_string($con, $user['email']);
		$sql_exist_email = "SELECT id FROM users
		WHERE email = '$email'";
		$res_exist_email = mysqli_query($con, $sql_exist_email);
		
		if (!$res_exist_email) {
			$error = mysqli_error($con);
    		print("Ошибка MySQL: " . $error);
		}
		elseif (mysqli_num_rows($res_exist_email) > 0) {
			$errors['email'] = 'Пользователь с данным Email уже зарегистрирован';
		}
	}
	
	$pass = password_hash($user['password'], PASSWORD_DEFAULT);
	
	if (empty($_FILES['avatar']['name'])) {
		$user['path'] = '';
	}
	else {
		$tmp_name = $_FILES['avatar']['tmp_name'];
    	$path = $_FILES['avatar']['name'];
    	$finfo = finfo_open(FILEINFO_MIME_TYPE);
		if (!$finfo) {
    		echo "Открытие базы данных fileinfo не удалось";
    		exit();
		}
    	$file_type = finfo_file($finfo, $tmp_name);
  
    	if ($file_type !== "image/png" && $file_type !== "image/jpeg") { 
			$errors['avatar'] = 'Загрузите изображение в формате JPEG или PNG';
    	}
		else {
			move_uploaded_file($tmp_name, 'img/' . $path);
			$user['path'] = 'img/' . $path;
		}
	}
	
	if (count($errors)) {
    	$content = include_template('sign-up_main.php', compact('categories', 'errors', 'user'));
    	$layout = include_template('pages_layout.php', compact('title', 'content', 'categories'));
    	print ($layout);
  	}
	else {		
		$sql_add_user = "INSERT INTO users (reg_date, email, name, password, avatar_link, contacts)
		VALUES (NOW(), ?, ?, ?, ?, ?)";
		
		$stmt = db_get_prepare_stmt($con, $sql_add_user, [$user['email'], $user['name'], $pass, $user['path'], $user['message']]);
		$res_add_user = mysqli_stmt_execute($stmt);
		
		if (!$res_add_user) {
			$error = mysqli_error($con);
			print("Ошибка MySQL: " . $error);
		}
		else {
			header("Location: /login.php");
		}
	}
}
else {
	$content = include_template('sign-up_main.php', compact('categories', 'user', 'errors'));
	$layout = include_template('pages_layout.php', compact('title', 'content', 'categories'));
	print($layout);
}
