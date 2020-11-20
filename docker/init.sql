FLUSH PRIVILEGES;

CREATE DATABASE IF NOT EXISTS `black_sport`;

DROP USER IF EXISTS bot;

CREATE USER blacksport IDENTIFIED WITH mysql_native_password BY '1caeZprqnWf6Q7Nb';
GRANT ALL PRIVILEGES ON `black_sport`.* TO blacksport;

DROP USER IF EXISTS phpmyadmin;

CREATE USER phpmyadmin IDENTIFIED WITH mysql_native_password BY '8IUikmw4Ac2O4nck';
GRANT ALL PRIVILEGES ON `black_sport`.* TO phpmyadmin;

