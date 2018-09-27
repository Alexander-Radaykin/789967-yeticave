USE yeticave;

-- Запрос на добавление значений в таблицу categories в поле name
INSERT INTO categories (name) VALUES
('Доски и лыжи'),
('Крепления'),
('Ботинки'),
('Одежда'),
('Инструменты'),
('Разное');

/* Запрос на добавление значений в таблицу users */
INSERT INTO users (email, name, password, contacts) VALUES
('ivan.b@mail.ru', 'Иван', 'birthday', 'Мобильный: +79631156723, Skype: VanoB'),
('semen.1985@mail.ru', 'Семён', 'mycatsname' 'Мобильный: +79261315541, Skype: Semen85');

