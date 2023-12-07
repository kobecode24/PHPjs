-- Create the MovieMingle Database
CREATE DATABASE IF NOT EXISTS MovieMingle;
USE MovieMingle;

-- Create the 'genre' table
CREATE TABLE IF NOT EXISTS genre (
                                     id INT AUTO_INCREMENT PRIMARY KEY,
                                     name VARCHAR(255) NOT NULL
);

-- Create the 'user' table
CREATE TABLE IF NOT EXISTS user (
                                    id INT AUTO_INCREMENT PRIMARY KEY,
                                    username VARCHAR(255) NOT NULL UNIQUE,
                                    password VARCHAR(255) NOT NULL,
                                    isadmin BOOLEAN NOT NULL
);

-- Create the 'cast' table
CREATE TABLE IF NOT EXISTS `cast` (
                                      id INT AUTO_INCREMENT PRIMARY KEY,
                                      firstname VARCHAR(255) NOT NULL,
                                      lastname VARCHAR(255) NOT NULL
);

-- Create the 'film' table
CREATE TABLE IF NOT EXISTS film (
                                    id INT AUTO_INCREMENT PRIMARY KEY,
                                    title VARCHAR(255) NOT NULL,
                                    duration INT NOT NULL,
                                    releasedate DATETIME NOT NULL,
                                    genre_id INT,
                                    FOREIGN KEY (genre_id) REFERENCES genre(id)
);

-- Create the 'film_cast' table
CREATE TABLE IF NOT EXISTS film_cast (
                                         id INT AUTO_INCREMENT PRIMARY KEY,
                                         film_id INT NOT NULL,
                                         cast_id INT NOT NULL,
                                         role VARCHAR(255) NOT NULL,
                                         FOREIGN KEY (film_id) REFERENCES film(id) ON DELETE CASCADE ON UPDATE CASCADE,
                                         FOREIGN KEY (cast_id) REFERENCES `cast`(id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Create the 'status' table with foreign keys to 'user' and 'film'
CREATE TABLE IF NOT EXISTS status (
                                      id INT AUTO_INCREMENT PRIMARY KEY,
                                      status VARCHAR(255) NOT NULL,
                                      user_id INT,
                                      film_id INT,
                                      FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE ON UPDATE CASCADE,
                                      FOREIGN KEY (film_id) REFERENCES film(id) ON DELETE CASCADE ON UPDATE CASCADE
);

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


-- Inserting users
INSERT INTO user (username, password, isadmin) VALUES
                                                   ('alice', '$2y$10$jyJoMBkjajXe7Qgw1wBqs.Bz9DpBfL3FLsM5oBeYEfPtTW/dsqJk.', FALSE),
                                                   ('bob', '$2y$10$J82VJQv.K8fQrhKpA3JXd.UTbQvP2hUkMu2up3TwLTOrz1f4zw4d.', TRUE),
                                                   ('charlie', '$2y$10$2lP.C0H/c4S7P9ABnUQrse0hUYabHOIZTxx6R/SWVL9Khw7ywUcGy', FALSE),
                                                   ('david', '$2y$10$XEDFFcWu2C.Q4DCj.pshHORAAVIRtY6P42BEnGLxN/4kYcpG3YbmO', FALSE),
                                                   ('eva', '$2y$10$Sf04XxVmhMaCUFRpXvMmw.WehjhGixP0k/I1zbvkAfR41HPSqouTK', TRUE),
                                                   ('frank', '$2y$10$4imTO/xjjxn0Y8zhntG7a.jFaRNj.n/AicNRVjKGn8/IZPeTNYh22', FALSE),
                                                   ('grace', '$2y$10$R6z6ieOPZCKiZlCmsz68KeWOSVjW0.M7pfVN80vRpJUUL/IdngQpm', FALSE),
                                                   ('henry', '$2y$10$H2MG.TksEVZZhGxj16PHLut9mksqtgnzCaTAX.QiI2zcNT7LxaFhi', TRUE),
                                                   ('irene', '$2y$10$duh48koktfZ/JjbSuRRT..OqIXsX6Ll9EY5oAiayxoTn3N6s0u7t.', FALSE),
                                                   ('jack', '$2y$10$kGINS5U95jcYFOVXnCJTBOVOk.eVzaGA2tMu5ilPhUfH6Z3ENGo22', FALSE);

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


INSERT INTO status (status, user_id, film_id) VALUES
                                                  ('Favourites', 1, 5),
                                                  ('Favourites', 2, 3),
                                                  ('To Watch Later', 3, 2),
                                                  ('To Watch Later', 4, 7);



