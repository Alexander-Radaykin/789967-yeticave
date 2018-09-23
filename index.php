<?php
date_default_timezone_set("Europe/Moscow");
require_once('functions.php');
require_once('data.php');

$title = 'Главная';
$is_auth = rand(0, 1);

$user_name = 'Александр';
$user_avatar = 'img/user.jpg';

$ts_midnight = strtotime('tomorrow');
$qt_sec_to_midnight = $ts_midnight - time();

$hours = floor($qt_sec_to_midnight / 3600);
$minutes = floor(($qt_sec_to_midnight % 3600) / 60);
$time_remaining = sprintf("%02d", $hours) . ' : ' . sprintf("%02d", $minutes);

$content = include_template('index.php', compact('lots_categories', 'ads', 'time_remaining'));
$layout_content = include_template('layout.php', compact('content', 'lots_categories', 'is_auth', 'title', 'user_name', 'user_avatar'));

print($layout_content);
