DROP DATABASE IF EXISTS todolist;

CREATE DATABASE todolist;

USE todolist;

CREATE TABLE user(
	id 		INT AUTO_INCREMENT PRIMARY KEY,
	name	VARCHAR(255) NOT NULL,
	email	VARCHAR(255) NULL NULL UNIQUE,
	password TEXT
)engine=InnoDB;

DESCRIBE user;

INSERT INTO user(name, email, password)VALUES
('Temso Jeano', 'jeano@email.com', '12345678'),
('Jeatsa Romeo', 'romeo@email.com', '12345678'),
('Taboua Rene', 'rene@email.com', '12345678');

CREATE TABLE todo(
	id 		INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	title	VARCHAR(255) NOT NULL,
	statut	ENUM('UNFINISHED', 'FINISHED') DEFAULT 'UNFINISHED',
	createdAt DATETIME DEFAULT NOW(),
	userId	INT NOT NULL,
	CONSTRAINT fk_todo_user
	FOREIGN KEY (userId)
	REFERENCES user(id)
)engine=InnoDB;

INSERT INTO todo(title, userId) VALUES
('Apprendre Laravel', 1),
('Apprendre JS', 1),
('Apprendre JAVA', 2),
('Apprendre Laravel', 2),
('Apprendre Spring boot', 3),
('Apprendre Django', 3);