CREATE DATABASE InventorySystem;
Go;

USE InventorySystem;

CREATE TABLE users (
    id INT IDENTITY(1,1) PRIMARY KEY,
    email NVARCHAR(255) NOT NULL UNIQUE,
    password NVARCHAR(255) NOT NULL
);

CREATE TABLE inventory (
    id INT IDENTITY(1,1) PRIMARY KEY,
    name NVARCHAR(255) NOT NULL,
    quantity INT NOT NULL,
    description NVARCHAR(1000) NULL
);

Go;

ALTER TABLE users ADD role NVARCHAR(20) NOT NULL DEFAULT 'user';