CREATE DATABASE webgis;
USE webgis;

CREATE TABLE locations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    latitude DECIMAL(10, 6),
    longitude DECIMAL(10, 6)
);

INSERT INTO locations (name, latitude, longitude) VALUES
('Location A', 1.234567, 101.234567),
('Location B', 2.345678, 102.345678),
('Location C', 3.456789, 103.456789);
