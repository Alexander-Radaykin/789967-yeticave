<?php
date_default_timezone_set("Europe/Moscow");
require_once('functions.php');

session_start();

$title = 'Вход';

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

$form = [];
$required = ['email' => 'Укажите Ваш Email', 'password' => 'Введите пароль'];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$form = $_POST;
	
	if (empty($_POST['email'])) {
			$errors['email'] = 'Укажите Ваш Email';
	}
			
	$email = mysqli_real_escape_string($con, $form['email']);
	$sql_email = "SELECT * FROM users WHERE email = '$email'";
	$res_email = mysqli_query($con, $sql_email);
	
	$user = $res_email ? mysqli_fetch_array($res_email, MYSQLI_ASSOC) : null;

	if (!count($errors) and $user) {
		if (empty($_POST['password'])) {
			$errors['password'] = 'Введите пароль';
		}
		elseif (password_verify($form['password'], $user['password'])) {
			$_SESSION['user'] = $user;
		}
		else {
			$errors['password'] = 'Неверный пароль';
		}
	}
	else {
		$errors['email'] = 'Пользователь не найден';
	}

	if (count($errors)) {
		$content = include_template('login_main.php', compact('categories', 'form', 'errors'));
	}
	else {
		$location = isset($_SESSION['cur_page']) ? $_SESSION['cur_page'] : "/index.php";
		
		header("Location: $location");
		exit();
		}
}
else {
	$content = include_template('login_main.php', compact('categories', 'form', 'errors'));
}

$layout = include_template('pages_layout.php', compact('content', 'categories', 'title'));

print($layout);