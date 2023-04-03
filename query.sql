CREATE DATABASE Grocery;

USE Grocery;

CREATE TABLE admin(
  user_id INT PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(100) NOT NULL,
  password VARCHAR(100) NOT NULL
);

CREATE TABLE user_info(
  user_id INT NOT NULL AUTO_INCREMENT,
  user_name VARCHAR(80) NOT NULL,
  user_phone VARCHAR(14) NOT NULL,
  FOREIGN KEY (user_id) REFERENCES admin(user_id)
);

CREATE TABLE healthy_snacks(
  item_id INT PRIMARY KEY AUTO_INCREMENT,
  item_name VARCHAR(100) NOT NULL,
  item_price INT NOT NULL
);

CREATE TABLE unhealthy_snacks(
  item_id INT PRIMARY KEY AUTO_INCREMENT,
  item_name VARCHAR(100) NOT NULL,
  item_price INT NOT NULL
);
