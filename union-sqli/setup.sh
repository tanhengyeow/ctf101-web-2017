#!/bin/bash

service mysql start
service apache2 start
mysql -u root -pAdmin2015 -e """
drop database exampleDB;
SET PASSWORD = PASSWORD('jmmGn9YjzCdPhwGN3x4jDhSNS%A!4S');
CREATE USER 'unionIsLove'@'localhost' IDENTIFIED BY 'K&tv9d?PJ7uLEJkqmDFu+-buBNwFwE';
GRANT SELECT, INSERT, CREATE ON displayDB.* TO 'unionIsLove'@'localhost';
CREATE DATABASE displayDB;

USE displayDB;
CREATE TABLE faq (id INT NOT NULL AUTO_INCREMENT, type varchar(20) NOT NULL, frequency INT NOT NULL, question text NOT NULL, answer text NOT NULL, PRIMARY KEY (id));
INSERT INTO faq VALUES (1, 'clarifying','200','What is NUS Greyhats?', 'Visit our website here https://nusgreyhats.org/ to know more.');
INSERT INTO faq VALUES (2, 'clarifying','200','What is the difference between NUS Hackers and NUS Greyhats?', 'NUS Hackers hack cool stuff together. NUS Greyhats break cool stuff apart.');
INSERT INTO faq VALUES (3, 'clarifying','200','What is CTF101?', 'Didn\'t you know what you signed up for...? But anyway, you can find out more about that on our website too.');
INSERT INTO faq VALUES (4, 'open','200','How do I solve this challenge?', 'Think harder about what was taught just now. Clarify any doubts you have fast!');
INSERT INTO faq VALUES (5, 'clarifying','200','Where can I find the answer?', 'Google is your best friend.');
INSERT INTO faq VALUES (6, 'probing','200','Who can tell me the answer?', 'Hints will be given but attempt to solve the challenge yourself first!');

CREATE TABLE questionBank (id INT NOT NULL AUTO_INCREMENT, question text NOT NULL, answer text NOT NULL, PRIMARY KEY (id));
INSERT INTO questionBank VALUES (1, 'Why are there no pines or apples in pineapples?', 'I hope you did not dwell too much into this looool.');
INSERT INTO questionBank VALUES (2, 'Why are there no eggs in eggplants?', 'Sorry if you flipped a table...');
INSERT INTO questionBank VALUES (3, 'Why am I asking these questions?', 'Now, submit these answers and get your flag.');
"""

tail -f /dev/null
