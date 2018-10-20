<?php
date_default_timezone_set("Europe/Moscow");
require_once('functions.php');

if(isset($_GET['lot_id'])) {
  	$lot_id = intval($_GET['lot_id']);
}
else {
  	http_response_code(404);
  	require_once('templates/error_404.php');
	exit;
}

$con = mysqli_connect('localhost', 'root', '', 'yeticave');
  	if(!$con) {
    	print("Ошибка подключения: " . mysqli_connect_error());
  	}
mysqli_set_charset($con, "utf8");

$sql_get_cat = "SELECT name FROM categories";
$sql_get_lot = "SELECT l.id, l.create_date, l.title, l.description, l.img_link, l.starting_price, l.end_date, l.bet_step, l.author_id, l.winner_id, l.category_id, c.name 'category'
FROM lots l
JOIN categories c ON l.category_id = c.id
WHERE l.id = '$lot_id'";
$sql_get_bets = "SELECT COUNT(b.id) 'total_count', b.bet_date, MAX(b.cost) 'cur_price', b.cost, b.lot_id, u.name
FROM bets b
LEFT JOIN users u ON b.user_id = u.id
WHERE b.lot_id = '$lot_id'
GROUP BY b.bet_date, b.cost, b.lot_id, u.name ORDER BY total_count ASC";

$res_get_cat = mysqli_query($con, $sql_get_cat);
  	if(!$res_get_cat) {
		$error = mysqli_error($con);
    	print("Ошибка MySQL: " . $error);
  	}
$res_get_lot = mysqli_query($con, $sql_get_lot);
  	if(!$res_get_lot) {
    	$error = mysqli_error($con);
    	print("Ошибка MySQL: " . $error);
  	}
$res_get_bets = mysqli_query($con, $sql_get_bets);
  	if(!$res_get_bets) {
    	$error = mysqli_error($con);
    	print("Ошибка MySQL: " . $error);
  	}

$categories = mysqli_fetch_all($res_get_cat, MYSQLI_ASSOC);
$lot = mysqli_fetch_assoc($res_get_lot);
if (empty($lot)) {
  	http_response_code(404);
  	require_once('templates/error_404.php');
	exit;
}
$bets = mysqli_fetch_all($res_get_bets, MYSQLI_ASSOC);

$title = $lot['title'];


$content = include_template('lot_main.php', compact('categories', 'lot', 'bets'));
$layout = include_template('pages_layout.php', compact('title', 'content', 'categories', 'lot'));
    
print($layout);