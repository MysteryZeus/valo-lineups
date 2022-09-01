CREATE DATABASE valo_lineups;

CREATE TABLE agents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(16) NOT NULL,
    image VARCHAR(256) NOT NULL
);

CREATE TABLE maps (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(16) NOT NULL,
    image VARCHAR(256) NOT NULL
);

CREATE TABLE lineups (
    id INT AUTO_INCREMENT PRIMARY KEY,
    agent_id INT NOT NULL,
    map_id INT NOT NULL,
    description TEXT,
    image_position VARCHAR(256) NOT NULL,
    image_aim VARCHAR(256) NOT NULL,
    video_id VARCHAR(16),
    FOREIGN KEY (agent_id) REFERENCES agents(id),
    FOREIGN KEY (map_id) REFERENCES maps(id)
);