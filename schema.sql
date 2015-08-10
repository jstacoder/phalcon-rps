DROP TABLE if EXISTS users;
CREATE TABLE users (
    name VARCHAR(255) NOT NULL, 
    id INTEGER NOT NULL AUTO_INCREMENT, 
    PRIMARY KEY (id)
);

INSERT INTO users (`name`) VALUES ('kyle');
INSERT INTO users (`name`) VALUES ('jay');
INSERT INTO users (`name`) VALUES ('jill');
INSERT INTO users (`name`) VALUES ('jessica');


DROP TABLE if EXISTS played_games;
CREATE TABLE played_games (
    date DATETIME DEFAULT NULL, 
    id INTEGER NOT NULL AUTO_INCREMENT,                                
    PRIMARY KEY (id)
    
);
DROP TABLE if EXISTS scores;
CREATE TABLE scores (
    
    user_id INTEGER, 
    value VARCHAR(255) NOT NULL, 
    played_game_id INTEGER, 
    id INTEGER NOT NULL AUTO_INCREMENT, 
    PRIMARY KEY (id), 
    FOREIGN KEY(user_id) REFERENCES users (id), 
    FOREIGN KEY(played_game_id) REFERENCES played_games (id)
);
DROP TABLE if EXISTS played_games_users;
CREATE TABLE played_games_users (
    users_id INTEGER, 
    played_games_id INTEGER, 
    FOREIGN KEY(users_id) REFERENCES users (id), 
    FOREIGN KEY(played_games_id) REFERENCES played_games (id)
);


