#!/bin/bash

service apache2 start
service mysql start
mysql -u root -pAdmin2015 -e """
drop database exampleDB;
SET PASSWORD = PASSWORD('Uuu&bkg!wtUNgCNCqZ6GZR?D^q6x!G');
CREATE USER 'xss'@'localhost' IDENTIFIED BY 'K&tv9d?PJ7uLEJkqmDFu+-buBNwFwE';
GRANT SELECT, INSERT, CREATE, UPDATE ON xss.* TO 'xss'@'localhost';
CREATE DATABASE xss;
USE xss;
CREATE TABLE users (id INT NOT NULL AUTO_INCREMENT, uid varchar(20) NOT NULL, username varchar(30) NOT NULL, password varchar(64) NOT NULL, wall varchar(1024) DEFAULT '', description varchar(1024) DEFAULT '', PRIMARY KEY (id));
INSERT INTO users (uid, username, password) VALUES ('tmgn75RrISmhyxGeZEUa', 'admin', md5('ItMustBeAPW1CanRmb2'));
"""

tail -f /dev/null
