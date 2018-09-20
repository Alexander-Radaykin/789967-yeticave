<?php
require_once('functions.php');

$is_auth = rand(0, 1);

$user_name = 'Александр';
$user_avatar = 'img/user.jpg';
$lots_categories = ['Доски и лыжи', 'Крепления', 'Ботинки', 'Одежда', 'Инструменты', 'Разное'];
$ads = [
  [ 
  'category' => 0,
      'name' => '2014 Rossignol District Snowboard',
     'price' => 10999,
  'img_link' => 'img/lot-1.jpg'
  ],
  
  [ 
  'category' => 0,
      'name' => 'DC Ply Mens 2016/2017 Snowboard',
     'price' => 159999,
  'img_link' => 'img/lot-2.jpg'
  ],
  
  [ 
  'category' => 1,
      'name' => 'Крепления Union Contact Pro 2015 года размер L/XL',
     'price' => 8000,
  'img_link' => 'img/lot-3.jpg'
  ],
  
  [ 
  'category' => 2,
      'name' => 'Ботинки для сноуборда DC Mutiny Charocal',
     'price' => 10999,
  'img_link' => 'img/lot-4.jpg'
  ],
  
  [ 
  'category' => 3,
      'name' => 'Куртка для сноуборда DC Mutiny Charocal',
     'price' => 7500,
  'img_link' => 'img/lot-5.jpg'
  ],
  
  [ 
  'category' => 5,
      'name' => 'Маска Oakley Canopy',
     'price' => 5400,
  'img_link' => 'img/lot-6.jpg'
  ]
];

$page_content = include_template('index.php', ['lots_categories' => $lots_categories, 'ads' => $ads]);
$layout_content = include_template('layout.php', ['content' => $page_content, 'lots_categories' => $lots_categories, 'is_auth' => $is_auth, 'title' => 'YetiCave', 'user_name' => $user_name, 'user_avatar' => $user_avatar]);

print($layout_content);
?>