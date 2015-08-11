SET FOREIGN_KEY_CHECKS = 0;
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
    users_id INTEGER, 
    date DATETIME DEFAULT NULL, 
    id INTEGER NOT NULL AUTO_INCREMENT,                                
    PRIMARY KEY (id),
    FOREIGN KEY(users_id) REFERENCES users (id)
    
);
DROP TABLE if EXISTS scores;
CREATE TABLE scores (
    
    wins INTEGER NOT NULL default 0, 
    losses INTEGER NOT NULL default 0, 
    ties INTEGER NOT NULL default 0, 
    played_game_id INTEGER, 
    id INTEGER NOT NULL AUTO_INCREMENT, 
    PRIMARY KEY (id), 
    FOREIGN KEY(played_game_id) REFERENCES played_games (id)
);
DROP TABLE if EXISTS played_games_users;
SET FOREIGN_KEY_CHECKS = 1;

