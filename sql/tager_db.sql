CREATE DATABASE IF NOT EXISTS tager_db DEFAULT CHARACTER SET utf8mb4;
USE tager_db;

CREATE TABLE users (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(100) NOT NULL,
 phone VARCHAR(20) NOT NULL UNIQUE,
 password VARCHAR(255) NOT NULL,
 is_admin TINYINT(1) DEFAULT 0
);

CREATE TABLE categories (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(100) NOT NULL
);

CREATE TABLE cities (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(100) NOT NULL
);

CREATE TABLE ads (
 id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT NOT NULL,
 title VARCHAR(255) NOT NULL,
 description TEXT NOT NULL,
 price DECIMAL(10,2) NOT NULL,
 city_id INT NOT NULL,
 category_id INT NOT NULL,
 created_at DATETIME NOT NULL,
 FOREIGN KEY (user_id) REFERENCES users(id),
 FOREIGN KEY (city_id) REFERENCES cities(id),
 FOREIGN KEY (category_id) REFERENCES categories(id)
);

CREATE TABLE ad_images (
 id INT AUTO_INCREMENT PRIMARY KEY,
 ad_id INT NOT NULL,
 image_path VARCHAR(255) NOT NULL,
 FOREIGN KEY (ad_id) REFERENCES ads(id)
);

CREATE TABLE reports (
 id INT AUTO_INCREMENT PRIMARY KEY,
 ad_id INT NOT NULL,
 user_id INT NOT NULL,
 reason TEXT,
 created_at DATETIME NOT NULL,
 FOREIGN KEY (ad_id) REFERENCES ads(id),
 FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE featured_ads (
 id INT AUTO_INCREMENT PRIMARY KEY,
 ad_id INT NOT NULL,
 created_at DATETIME NOT NULL,
 FOREIGN KEY (ad_id) REFERENCES ads(id)
);

INSERT INTO cities (name) VALUES ('الرياض'),('جدة'),('الدمام'),('مكة');
INSERT INTO categories (name) VALUES ('سيارات'),('عقارات'),('إلكترونيات'),('أثاث');
INSERT INTO users (name,phone,password,is_admin) VALUES
 ('أحمد','0500000001',PASSWORD('1234'),1),
 ('محمد','0500000002',PASSWORD('1234'),0),
 ('سارة','0500000003',PASSWORD('1234'),0);
INSERT INTO ads (user_id,title,description,price,city_id,category_id,created_at) VALUES
 (1,'سيارة تويوتا','حالة ممتازة','30000',1,1,NOW()),
 (2,'شقة للبيع','شقة كبيرة','500000',2,2,NOW()),
 (3,'جوال جديد','أحدث إصدار','3000',3,3,NOW());
INSERT INTO ad_images (ad_id,image_path) VALUES
 (1,'car.jpg'),(2,'flat.jpg'),(3,'phone.jpg');
