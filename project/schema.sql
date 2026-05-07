CREATE DATABASE IF NOT EXISTS scout_shop_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE scout_shop_db;

DROP TABLE IF EXISTS order_items;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS custom_orders;
DROP TABLE IF EXISTS contact_messages;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(120) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') NOT NULL DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(150) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    image_url VARCHAR(255) NOT NULL,
    category VARCHAR(80) NOT NULL DEFAULT 'Gear',
    stock INT NOT NULL DEFAULT 20,
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE orders (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    status ENUM('pending', 'completed', 'cancelled') NOT NULL DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE order_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    product_name VARCHAR(150) NOT NULL,
    unit_price DECIMAL(10, 2) NOT NULL,
    quantity INT NOT NULL,
    subtotal DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

CREATE TABLE contact_messages (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(120) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE custom_orders (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NULL,
    product VARCHAR(100) NOT NULL,
    color VARCHAR(40),
    size VARCHAR(20) NOT NULL,
    logos VARCHAR(255),
    quantity INT NOT NULL DEFAULT 1,
    total DECIMAL(10, 2) NOT NULL DEFAULT 0,
    status ENUM('pending', 'completed', 'cancelled') NOT NULL DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

INSERT INTO users (name, email, password, role) VALUES
('Scout Admin', 'admin@scoutshop.com', 'admin123', 'admin'),
('Scout User', 'user@scoutshop.com', 'user123', 'user');

INSERT INTO products (name, description, price, image_url, category, stock) VALUES
('T-Shirt', 'Comfortable scout T-shirt for meetings and camp days.', 12.00, '../product.png', 'Uniform', 30),
('Pants', 'Durable scout pants for active outdoor use.', 15.00, '../product 2.png', 'Uniform', 25),
('Jacket', 'Warm scout jacket for evening activities.', 25.00, '../prduct 3.png', 'Uniform', 20),
('Scout Hat', 'Classic scout hat for sun protection.', 8.00, '../handchef p1.png', 'Accessories', 35),
('Hiking Boots', 'Trail-ready boots for hikes and camps.', 35.00, '../handchef p2.png', 'Gear', 18),
('Scout Gloves', 'Protective gloves for outdoor work.', 6.00, '../handchef p3.png', 'Accessories', 40),
('Backpack', 'Lightweight backpack for scout trips.', 22.00, '../scout shop trger.png', 'Gear', 20),
('First Aid Kit', 'Compact first aid kit for safety checks.', 18.00, '../woggle p.png', 'Safety', 22),
('Compass', 'Reliable compass for navigation practice.', 12.00, '../fadrarion p.png', 'Gear', 30),
('Water Bottle', 'Reusable bottle for hikes and activities.', 5.00, '../girl giude p.png', 'Gear', 50),
('Neckerchief', 'Scout neckerchief for uniform style.', 4.00, '../air scout p.png', 'Uniform', 45),
('Flashlight', 'Portable flashlight for camping nights.', 15.00, '../land scout p.png', 'Gear', 25),
('Badge Set', 'Set of scout badges for uniforms.', 10.00, '../summer navy  scout p.png', 'Accessories', 35),
('Sleeping Bag', 'Comfortable sleeping bag for camps.', 45.00, '../winter navy   scout p.png', 'Camping', 14);
