<?php
require_once('functions.php');
require_once('data.php');

$is_auth = rand(0, 1);

$user_name = 'Александр';
$user_avatar = 'img/user.jpg';

$page_content = include_template('index.php', ['lots_categories' => $lots_categories, 'ads' => $ads]);

$layout_content = include_template('layout.php', ['content' => $page_content, 'lots_categories' => $lots_categories, 'is_auth' => $is_auth, 'title' => 'Главная', 'user_name' => $user_name, 'user_avatar' => $user_avatar]);

print($layout_content);
?>