<?php
date_default_timezone_set("Europe/Moscow");
require_once('functions.php');
require_once('data.php');

$con = mysqli_connect('localhost', 'root', '', 'yeticave');
  	if(!$con) {
    	print("Ошибка подключения: " . mysqli_connect_error());
  	}
mysqli_set_charset($con, "utf8");

$sql_get_lots = "SELECT l.id, l.create_date, l.title, l.description, l.img_link, l.starting_price, l.end_date, l.bet_step, l.author_id, l.winner_id, l.category_id, c.name 'category'
FROM lots l
JOIN categories c ON l.category_id = c.id
WHERE l.end_date > NOW()";
$sql_get_cat = "SELECT name FROM categories";

$res_get_lots = mysqli_query($con, $sql_get_lots);
  	if(!$res_get_lots) {
    	$error = mysqli_error($con);
    	print("Ошибка MySQL: " . $error);
  	}
$res_get_cat = mysqli_query($con, $sql_get_cat);
  	if(!$res_get_cat) {
		$error = mysqli_error($con);
		print("Ошибка MySQL: " . $error);
  	}

$lots = mysqli_fetch_all($res_get_lots, MYSQLI_ASSOC);
$cat = mysqli_fetch_all($res_get_cat, MYSQLI_ASSOC);
$categories = array_combine($classes, $cat);

$title = 'Главная';
$is_auth = rand(0, 1);

$user_name = 'Александр';
$user_avatar = 'img/user.jpg';

$ts_midnight = strtotime('tomorrow');
$qt_sec_to_midnight = $ts_midnight - time();

$hours = floor($qt_sec_to_midnight / 3600);
$minutes = floor(($qt_sec_to_midnight % 3600) / 60);
$time_remaining = sprintf("%02d", $hours) . ' : ' . sprintf("%02d", $minutes);

$content = include_template('index.php', compact('categories', 'lots', 'time_remaining'));
$layout_content = include_template('layout.php', compact('content', 'categories', 'is_auth', 'title', 'user_name', 'user_avatar'));

print($layout_content);
