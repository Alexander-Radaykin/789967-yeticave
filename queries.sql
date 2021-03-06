USE yeticave;

/* Запрос на добавление значений в таблицу categories в поле name */
INSERT INTO categories (name) VALUES
('Доски и лыжи'),
('Крепления'),
('Ботинки'),
('Одежда'),
('Инструменты'),
('Разное');

/* Запрос на добавление значений в таблицу users */
INSERT INTO users (reg_date, email, name, password, contacts) VALUES
('2018-09-21 18:41:02', 'ivan.b@mail.ru', 'Иван', 'birthday', 'Мобильный: +79631156723, Skype: VanoB'),
('2018-09-21 20:58:31', 'semen.1985@mail.ru', 'Семён', 'mycatsname', 'Мобильный: +79261315541, Skype: Semen85');

/* Запрос на добавление значений в таблицу lots */
INSERT INTO lots (create_date, title, description, img_link, starting_price, end_date, bet_step, author_id, category_id) VALUES
('2018-09-25 18:53:00', '2014 Rossignol District Snowboard', 'Отличная доска.', 'img/lot-1.jpg', 10999, '2018-10-19 00:00:00', 200, 1, 1),
('2018-09-25 19:00:07', 'DC Ply Mens 2016/2017 Snowboard', 'Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив снег мощным щелчком и четкими дугами. Стекловолокно Bi-Ax, уложенное в двух направлениях, наделяет этот снаряд отличной гибкостью и отзывчивостью, а симметричная геометрия в сочетании с классическим прогибом кэмбер позволит уверенно держать высокие скорости. А если к концу катального дня сил совсем не останется, просто посмотрите на Вашу доску и улыбнитесь, крутая графика от Шона Кливера еще никого не оставляла равнодушным.', 'img/lot-2.jpg', 159999, '2018-10-19 00:00:00', 1000, 1, 1),
('2018-09-25 19:12:53', 'Крепления Union Contact Pro 2015 года размер L/XL', 'Профессионалы оценят!', 'img/lot-3.jpg', 8000, '2018-10-19 00:00:00', 150, 1, 2),
('2018-09-25 19:16:23', 'Ботинки для сноуборда DC Mutiny Charocal', 'Теплые и удобные ботинки', 'img/lot-4.jpg', 10999, '2018-10-19 00:00:00', 200, 1, 3),
('2018-09-25 19:24:45', 'Куртка для сноуборда DC Mutiny Charocal', 'В этой куртке холод вам будет неведан, при этом она довольно легкая и не сковывает движения', 'img/lot-5.jpg', 7500, '2018-10-19 00:00:00', 150, 1, 4),
('2018-09-25 19:32:08', 'Маска Oakley Canopy', 'Очень удобная УФ-непроницаемая маска', 'img/lot-6.jpg', 5400, '2018-10-19 00:00:00', 100, 1, 6);

/* Запрос на добавление значений в таблицу bets */
INSERT INTO bets (bet_date, cost, user_id, lot_id) VALUES
('2018-09-26 07:41:15', 11199, 2, 1),
('2018-09-26 08:15:00', 8150, 2, 3);

/* Запрос на получение всех категорий из таблицы categories */
SELECT name FROM categories;

/* Запрос на получение самых новых открытых лотов с указанием названия, стартовой цены, ссылки на изображение, текущую цену, количество ставок, название категории */
SELECT l.title 'Название', l.starting_price 'Стартовая цена', l.img_link 'Ссылка на изображение', b.cost 'Цена', COUNT(b.cost) 'Количество ставок', c.name 'Категория'
FROM lots l
LEFT JOIN bets b ON l.id = b.lot_id
JOIN categories c ON l.category_id = c.id
WHERE l.end_date > NOW() AND l.create_date > '2018-09-24 00:00:00'
GROUP BY l.title, l.starting_price, l.img_link, b.cost, c.name
ORDER BY l.title ASC;

/* Запрос на получение лота и названия его категории по id лота */
SELECT l.id, l.create_date 'Дата создания', l.title 'Название', l.description 'Описание', l.starting_price 'Стартовая цена', l.img_link 'Ссылка на изображение', l.end_date 'Дата окончания', l. bet_step 'Шаг ставки', l.author_id, l.winner_id, l.category_id, c.name 'Категория'
FROM lots l
JOIN categories c ON l.category_id = c.id
WHERE l.id = 3;

/* Запрос на изменение названия лота по его id */
UPDATE lots SET title = '2015 Rossignol District Snowboard'
WHERE id = 1;

/* Запрос на получение списка самых свежих ставок для лота по его id */
SELECT * FROM bets
WHERE lot_id = 3
ORDER BY id DESC
LIMIT 3;