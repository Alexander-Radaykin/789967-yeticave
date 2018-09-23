<?php
// ставки пользователей, которыми надо заполнить таблицу
$bets = [
    ['name' => 'Иван', 'price' => 11500, 'ts' => strtotime('-' . rand(1, 50) .' minute')],
    ['name' => 'Константин', 'price' => 11000, 'ts' => strtotime('-' . rand(1, 18) .' hour')],
    ['name' => 'Евгений', 'price' => 10500, 'ts' => strtotime('-' . rand(25, 50) .' hour')],
    ['name' => 'Семён', 'price' => 10000, 'ts' => strtotime('last week')]
];

$lots_categories = [
  'boards' => 'Доски и лыжи',
  'attachment' => 'Крепления',
  'boots' => 'Ботинки',
  'clothing' => 'Одежда',
  'tools' => 'Инструменты',
  'other' => 'Разное'
];

$ads = [
  [ 
  'category' => 'Доски и лыжи',
      'name' => '2014 Rossignol District Snowboard',
     'price' => 10999,
  'img_link' => 'img/lot-1.jpg'
  ],
  
  [ 
  'category' => 'Доски и лыжи',
      'name' => 'DC Ply Mens 2016/2017 Snowboard',
     'price' => 159999,
  'img_link' => 'img/lot-2.jpg'
  ],
  
  [ 
  'category' => 'Крепления',
      'name' => 'Крепления Union Contact Pro 2015 года размер L/XL',
     'price' => 8000,
  'img_link' => 'img/lot-3.jpg'
  ],
  
  [ 
  'category' => 'Ботинки',
      'name' => 'Ботинки для сноуборда DC Mutiny Charocal',
     'price' => 10999,
  'img_link' => 'img/lot-4.jpg'
  ],
  
  [ 
  'category' => 'Одежда',
      'name' => 'Куртка для сноуборда DC Mutiny Charocal',
     'price' => 7500,
  'img_link' => 'img/lot-5.jpg'
  ],
  
  [ 
  'category' => 'Разное',
      'name' => 'Маска Oakley Canopy',
     'price' => 5400,
  'img_link' => 'img/lot-6.jpg'
  ]
];