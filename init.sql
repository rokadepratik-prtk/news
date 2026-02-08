-- Create admins table (for login)
CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    Password VARCHAR(255) NOT NULL, -- store hashed passwords
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Example admin insert (replace with password_hash() output in PHP)
-- INSERT INTO admins (username, Password) VALUES ('admin', '$2y$10$HashedPasswordHere');


-- Create news table (for posting news)
CREATE TABLE IF NOT EXISTS news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    sub TEXT NOT NULL,              -- subtitle
    details TEXT NOT NULL,          -- full news content
    image VARCHAR(255),             -- path to uploaded image
    link VARCHAR(255),              -- YouTube or external link
    thumbnail VARCHAR(255),         -- path to thumbnail image
    other_photos JSON,              -- JSON array of other photo paths
    category VARCHAR(100) NOT NULL, -- e.g. Satara, Politics, Sports
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Sample news entries
INSERT INTO news (title, sub, details, category)
VALUES
('Welcome News', 'Your Dockerized PHP app is working!', 'This is a test article.', 'Satara'),
('Second News Item', 'Another sample article', 'Testing multiple entries.', 'Politics');


-- Create updates table (for admin updates)
CREATE TABLE IF NOT EXISTS updates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Sample updates
INSERT INTO updates (title, description)
VALUES
('First Update', 'This is an admin update entry.'),
('Second Update', 'Another update entry for testing.');
