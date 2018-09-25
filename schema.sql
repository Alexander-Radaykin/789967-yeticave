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

