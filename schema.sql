/* TABLES */
/* users,scores,played_games */

CREATE TABLE users (
    name VARCHAR(255) NOT NULL, 
    password TEXT NOT NULL, 
    id INTEGER NOT NULL AUTO_INCREMENT, 
    PRIMARY KEY (id)
)


COMMIT

CREATE TABLE played_games (
    date DATETIME DEFAULT now(), 
    id INTEGER NOT NULL AUTO_INCREMENT, 
    PRIMARY KEY (id)
)

COMMIT

CREATE TABLE scores (
    user_id INTEGER, 
    value VARCHAR(255) NOT NULL, 
    played_game_id INTEGER, 
    id INTEGER NOT NULL AUTO_INCREMENT, 
    PRIMARY KEY (id), 
    FOREIGN KEY(user_id) REFERENCES users (id), 
    FOREIGN KEY(played_game_id) REFERENCES played_games (id)
)


COMMIT

CREATE TABLE played_games_users (
    users_id INTEGER, 
    played_games_id INTEGER, 
    FOREIGN KEY(users_id) REFERENCES users (id), 
    FOREIGN KEY(played_games_id) REFERENCES played_games (id)
)


