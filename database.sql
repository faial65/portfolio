-- Create database
CREATE DATABASE IF NOT EXISTS portfolio_db;
USE portfolio_db;

-- Create projects table
CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    image_url VARCHAR(500),
    demo_url VARCHAR(500),
    github_url VARCHAR(500),
    technologies VARCHAR(500),
    status ENUM('completed', 'in-progress', 'planned') DEFAULT 'completed',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert sample projects
INSERT INTO projects (title, description, image_url, demo_url, github_url, technologies, status) VALUES
('Portfolio Website', 'A modern, responsive portfolio website built with HTML, CSS, and JavaScript featuring smooth animations and mobile-first design.', 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?auto=format&fit=crop&w=400&q=80', '#', 'https://github.com/yourusername/portfolio', 'HTML5, CSS3, JavaScript, PHP, MySQL', 'completed'),

('E-commerce Demo', 'Full-stack e-commerce application with product catalog, shopping cart, and admin panel. Built with PHP and MySQL.', 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=400&q=80', '#', 'https://github.com/yourusername/ecommerce', 'PHP, MySQL, JavaScript, Bootstrap', 'completed'),

('Task Management App', 'A productivity app for managing daily tasks with features like categories, deadlines, and progress tracking.', 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=400&q=80', '#', 'https://github.com/yourusername/task-app', 'React, Node.js, MongoDB', 'in-progress'),

('Weather Dashboard', 'Real-time weather application using external APIs to display current weather and 5-day forecasts.', 'https://images.unsplash.com/photo-1465101046530-73398c7f28ca?auto=format&fit=crop&w=400&q=80', '#', 'https://github.com/yourusername/weather-app', 'JavaScript, API Integration, CSS3', 'completed');