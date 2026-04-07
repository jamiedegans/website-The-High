-- ============================================
-- menu voorbeeldstudenten
-- ============================================

CREATE DATABASE IF NOT EXISTS mydatabase;
USE mydatabase;

DROP TABLE IF EXISTS menu;

CREATE TABLE menu (
    naam VARCHAR(50) NOT NULL,
    prijs DECIMAL(10,2) NOT NULL,
    category VARCHAR(100) NOT NULL,
    ingredients varchar(255) NOT NULL,
    image_url varchar(255) NOT NULL,
    allergens varchar(255) NOT NULL,
    featured BOOLEAN NOT NULL DEFAULT false,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO menu (naam, prijs, category, ingredients, image_url, allergens, featured) VALUES
('Truffle Wagyu Burger', 22.50, 'mains', 'wagyu beef, black truffle, aged cheddar, brioche bun, caramelised onion, lettuce, truffle mayo', 'img/dish-1.jpg', 'gluten, dairy, eggs', true),
('Lobster Bisque', 16.00, 'starters', 'Atlantic lobster, cream, cognac, celery, onion, sourdough crostini', 'img/dish-2.jpg', 'shellfish, gluten, dairy', true),
('Smoked Duck Breast', 26.00, 'mains', 'duck breast, cherry reduction, wild mushrooms, pommes dauphine, thyme, butter', 'img/dish-3.jpg', 'dairy, eggs', true),
('Burrata & Heirloom Tomato', 13.50, 'starters', 'burrata, heirloom tomatoes, basil oil, smoked sea salt, aged balsamic', 'img/dish-4.jpg', 'dairy', false),
('Black Truffle Pasta', 24.00, 'mains', 'tagliatelle, black truffle, brown butter, parmesan, garlic, fresh herbs', 'img/dish-5.jpg', 'gluten, dairy, eggs', false),
('Dark Chocolate Fondant', 10.00, 'desserts', 'dark chocolate, salted caramel, butter, eggs, flour', 'img/dish-6.jpg', 'gluten, dairy, eggs', true);


