-- Schema for tager application
-- Run this file in your MySQL server to create all tables and seed sample data.
-- You can execute the statements manually or import the file via phpMyAdmin or the mysql command line:
--   mysql -u <user> -p tager < tager_db.sql

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS ads (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    category_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE RESTRICT
);

CREATE TABLE IF NOT EXISTS ad_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ad_id INT NOT NULL,
    image_url VARCHAR(255) NOT NULL,
    FOREIGN KEY (ad_id) REFERENCES ads(id) ON DELETE CASCADE
);

-- Sample data -----------------------------------------------------------

INSERT INTO users (username, password, email) VALUES
    ('alice', 'password_hash', 'alice@example.com'),
    ('bob', 'password_hash', 'bob@example.com');

INSERT INTO categories (name, description) VALUES
    ('Electronics', 'Gadgets and devices'),
    ('Furniture', 'Household furnishings');

INSERT INTO ads (user_id, category_id, title, description, price) VALUES
    (1, 1, 'Smartphone for sale', 'Latest smartphone in good condition', 299.99),
    (2, 2, 'Sofa', 'Comfortable 3-seater sofa', 150.00);

INSERT INTO ad_images (ad_id, image_url) VALUES
    (1, 'images/phone.jpg'),
    (2, 'images/sofa.jpg');

-- End of file
