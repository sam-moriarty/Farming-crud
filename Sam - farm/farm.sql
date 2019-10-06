sudo /opt/lampp/manager-linux-x64.run
ifconfig
ftp://


sudo /opt/lampp/bin/mysql

********************************************************

DROP DATABASE kingstonrun;
CREATE DATABASE kingstonrun;
USE kingstonrun;
SELECT database();

DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS animals;

********************************************************

CREATE TABLE users
(
	user_id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	email VARCHAR(255) NOT NULL UNIQUE,
	password VARCHAR(255) NOT NULL
);


CREATE TABLE animals 
(
	tag_number INTEGER NOT NULL, 
	user_id INTEGER,
	type_id VARCHAR(255) NOT NULL,
	image LONGBLOB,
	sex VARCHAR(255) NOT NULL,  
	dob DATE, 
	health INTEGER,
	PRIMARY KEY (tag_number),
	CONSTRAINT fk_animals_users FOREIGN KEY (user_id) 
	REFERENCES users(user_id),
);





