CREATE DATABASE yeticave
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;
  
USE yeticave;
  
CREATE TABLE users(
  id INT AUTO_INCREMENT PRIMARY KEY,
  reg_date DATETIME,
  email CHAR(60),
  name CHAR(80),
  password CHAR(64),
  avatar_link VARCHAR(255),
  contacts TEXT
);

CREATE TABLE categories(
  id INT AUTO_INCREMENT PRIMARY KEY,
  name CHAR(40)
);

CREATE TABLE lots(
  id INT AUTO_INCREMENT PRIMARY KEY,
  create_date DATETIME,
  title VARCHAR(255),
  description TEXT,
  img_link VARCHAR(255),
  starting_price INT,
  end_date DATETIME,
  bet_step INT,
  author_id INT,
  winner_id INT,
  category_id INT
);

CREATE TABLE bets(
  id INT AUTO_INCREMENT PRIMARY KEY,
  bet_date DATETIME,
  cost INT,
  user_id INT,
  lot_id INT
);

CREATE UNIQUE INDEX email ON users(email);
CREATE UNIQUE INDEX name ON categories(name);
CREATE UNIQUE INDEX img_link ON lots(img_link);
CREATE INDEX name ON users(name);
CREATE INDEX create_date ON lots(create_date);
CREATE INDEX title ON lots(title);
CREATE INDEX starting_price ON lots(starting_price);
CREATE INDEX end_date ON lots(end_date);
CREATE INDEX author_id ON lots(author_id);
CREATE INDEX winner_id ON lots(winner_id);
CREATE INDEX category_id ON lots(category_id);
CREATE INDEX bet_date ON bets(bet_date);
CREATE INDEX user_id ON bets(user_id);
CREATE INDEX lot_id ON bets(lot_id);