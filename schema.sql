CREATE DATABASE yeticave
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;
  
CREATE TABLE users(
  id INT AUTO_INCREMENT PRIMARY KEY,
  reg_date DATETIME,
  email CHAR(60),
  name CHAR,
  password CHAR(64),
  avatar_link CHAR,
  added_lots_id INT,
  bets_id INT
);

CREATE TABLE categories(
  id INT AUTO_INCREMENT PRIMARY KEY,
  name CHAR(20)
);

CREATE TABLE lots(
  id INT AUTO_INCREMENT PRIMARY KEY,
  create_date DATETIME,
  title CHAR(100),
  description TEXT,
  img_link CHAR,
  starting_price INT,
  end_date DATETIME,
  bet_step INT,
  author_id INT,
  winner_id INT,
  category_id INT
);

