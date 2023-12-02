/*CREATE DATABASE MovieMingle;
USE MovieMingle;
*/

CREATE TABLE genre (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       name VARCHAR(255) NOT NULL
);

CREATE TABLE status (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        status VARCHAR(255) NOT NULL
);

CREATE TABLE user (
                      id INT AUTO_INCREMENT PRIMARY KEY,
                      username VARCHAR(255) NOT NULL UNIQUE,
                      password VARCHAR(255) NOT NULL,
                      isadmin BOOLEAN NOT NULL
);

CREATE TABLE `cast` (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        firstname VARCHAR(255) NOT NULL,
                        lastname VARCHAR(255) NOT NULL
);

CREATE TABLE film (
                      id INT AUTO_INCREMENT PRIMARY KEY,
                      title VARCHAR(255) NOT NULL,
                      duration INT NOT NULL,
                      releasedate DATETIME NOT NULL,
                      genre_id INT,
                      FOREIGN KEY (genre_id) REFERENCES genre(id)
);

CREATE TABLE film_cast (
                           id INT AUTO_INCREMENT PRIMARY KEY,
                           film_id INT NOT NULL,
                           cast_id INT NOT NULL,
                           role VARCHAR(255) NOT NULL,
                           FOREIGN KEY (film_id) REFERENCES film(id),
                           FOREIGN KEY (cast_id) REFERENCES `cast`(id)
);

-- Inserting genres
INSERT INTO genre (name) VALUES
                             ('Action'),
                             ('Comedy'),
                             ('Drama'),
                             ('Fantasy'),
                             ('Horror'),
                             ('Romance'),
                             ('Science Fiction'),
                             ('Thriller'),
                             ('Documentary'),
                             ('Crime');

-- Inserting statuses
INSERT INTO status (status) VALUES
                                ('Favorite'),
                                ('WatchLater'),
                                ('Both');
-- Inserting users
INSERT INTO user (username, password, isadmin) VALUES
                                                   ('alice', 'hashed_password1', FALSE),
                                                   ('bob', 'hashed_password2', TRUE),
                                                   ('charlie', 'hashed_password3', FALSE),
                                                   ('david', 'hashed_password4', FALSE),
                                                   ('eva', 'hashed_password5', TRUE),
                                                   ('frank', 'hashed_password6', FALSE),
                                                   ('grace', 'hashed_password7', FALSE),
                                                   ('henry', 'hashed_password8', TRUE),
                                                   ('irene', 'hashed_password9', FALSE),
                                                   ('jack', 'hashed_password10', FALSE);

-- Inserting cast members
INSERT INTO cast (firstname, lastname) VALUES
                                           ('Emma', 'Stone'),
                                           ('Ryan', 'Gosling'),
                                           ('Leonardo', 'DiCaprio'),
                                           ('Kate', 'Winslet'),
                                           ('Tom', 'Hardy'),
                                           ('Christian', 'Bale'),
                                           ('Margot', 'Robbie'),
                                           ('Brad', 'Pitt'),
                                           ('Angelina', 'Jolie'),
                                           ('Johnny', 'Depp');

-- Inserting films
INSERT INTO film (title, duration, releasedate, genre_id) VALUES
                                                              ('Inception', 148, '2010-07-16', 3),
                                                              ('Titanic', 195, '1997-12-19', 5),
                                                              ('The Dark Knight', 152, '2008-07-18', 1),
                                                              ('The Wolf of Wall Street', 180, '2013-12-25', 10),
                                                              ('La La Land', 128, '2016-12-09', 6),
                                                              ('Mad Max: Fury Road', 120, '2015-05-15', 1),
                                                              ('The Revenant', 156, '2015-12-25', 4),
                                                              ('Gone Girl', 149, '2014-10-03', 10),
                                                              ('The Great Gatsby', 143, '2013-05-10', 6),
                                                              ('Django Unchained', 165, '2012-12-25', 10);


-- Inserting film_cast entries
INSERT INTO film_cast (film_id, cast_id, role) VALUES
                                                   (1, 3, 'Dom Cobb'),
                                                   (2, 4, 'Rose DeWitt Bukater'),
                                                   (3, 6, 'Bruce Wayne'),
                                                   (4, 3, 'Jordan Belfort'),
                                                   (5, 2, 'Sebastian Wilder'),
                                                   (5, 1, 'Mia Dolan'),
                                                   (6, 5, 'Max Rockatansky'),
                                                   (7, 3, 'Hugh Glass'),
                                                   (8, 4, 'Amy Dunne'),
                                                   (9, 3, 'Jay Gatsby'),
                                                   (10, 3, 'Django'),
                                                   (2, 3, 'Jack Dawson'),
                                                   (3, 5, 'Bane'),
                                                   (7, 5, 'John Fitzgerald'),
                                                   (8, 6, 'Nick Dunne');


