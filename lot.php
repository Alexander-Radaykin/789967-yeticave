<?php
date_default_timezone_set("Europe/Moscow");
require_once('functions.php');

$con = mysqli_connect('localhost', 'root', '', 'yeticave');
  if(!$con) {
    print("Ошибка подключения: " . mysqli_connect_error());
  }
mysqli_set_charset($con, "utf8");

$sql_get_cat = "SELECT name FROM categories";
$sql_get_lot = "SELECT l.id, l.create_date, l.title, l.description, l.img_link, l.starting_price, l.end_date, l.bet_step, l.author_id, l.winner_id, l.category_id, c.name 'category', b.bet_date, b.cost, u.name
FROM lots l
JOIN categories c ON l.category_id = c.id
LEFT JOIN bets b ON b.tot_id = l.id
JOIN users u ON b.user_id = u.id
WHERE l.id = <?=lot_id;?>";
$sql_get_bets = "SELECT COUNT(b.id) 'total_count', b.bet_date, MAX(b.cost) 'cur_price', u.name
FROM bets b
LEFT JOIN users u ON b.user_id = u.id
WHERE b.lot_id = <?=lot_id;?>";

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
$lot = mysqli_fetch_all($res_get_lot, MYSQLI_ASSOC);
$bets = mysqli_fetch_all($res_get_bets, MYSQLI_ASSOC);

$lot_main_content = include_template('lot_main.php', compact('categories', 'lot', 'bets', 'time_remaining'));
$lot_lay_content = include_template('lot_layout.php', compact('categories'));
    
print($lot_lay_content);