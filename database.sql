CREATE DATABASE IF NOT EXISTS electricity_db;

USE electricity_db;

CREATE TABLE IF NOT EXISTS bills (
    id INT AUTO_INCREMENT PRIMARY KEY,
    month VARCHAR(20),
    name VARCHAR(100),
    address TEXT,
    mobile VARCHAR(15),
    units INT,
    amount DECIMAL(10,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);