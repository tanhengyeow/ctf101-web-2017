#!/bin/bash

service mysql start
service apache2 start
mysql -u root -pAdmin2015 -e """
drop database exampleDB;
SET PASSWORD = PASSWORD('jmmGn9YjzCdPhwGN3x4jDhSNS%A!4S');
CREATE USER 'unionIsLife'@'localhost' IDENTIFIED BY 'K&tv9d?PJ7uLEJkqmDFu+-buBNwFwE';
GRANT SELECT, INSERT, CREATE ON storeDB.* TO 'unionIsLife'@'localhost';
CREATE DATABASE storeDB;
USE storeDB;
CREATE TABLE items (id INT NOT NULL AUTO_INCREMENT, name varchar(15) NOT NULL, price INT NOT NULL, PRIMARY KEY (id));
INSERT INTO items VALUES (1, 'pen',1);
INSERT INTO items VALUES (2, 'pencil case',2);
INSERT INTO items VALUES (3, 'apple',1);
INSERT INTO items VALUES (4, 'banana',1);
INSERT INTO items VALUES (5, 'orange',1);
INSERT INTO items VALUES (7, 'textbook',30);
INSERT INTO items VALUES (8, 'chicken rice',4);
INSERT INTO items VALUES (9, 'cooking oil',3);
INSERT INTO items VALUES (10, 'mouse',15);
INSERT INTO items VALUES (11, 'ZA1N0NLYFLA9',168);
"""

tail -f /dev/null
