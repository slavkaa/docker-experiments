-- Ensure database exists
CREATE DATABASE IF NOT EXISTS test_db;

USE test_db;

-- Create `users` table
CREATE TABLE IF NOT EXISTS users (
     id INT AUTO_INCREMENT PRIMARY KEY,
     name VARCHAR(255) NOT NULL,
     nickname VARCHAR(255),
     birthdate DATE,
     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create `emails` table
CREATE TABLE IF NOT EXISTS emails (
  user_id INT NOT NULL,
  email VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Insert users
INSERT INTO users (name, nickname, birthdate) VALUES
  ('John Doe', 'Johnny', '1990-01-01'),
  ('Jane Smith', 'Janey', '1992-05-15'),
  ('Alice Johnson', NULL, '1985-08-23'),
  ('Bob Brown', 'Bobby', '1979-11-30'),
  ('Eve White', NULL, '2000-07-04');

-- Insert emails
INSERT INTO emails (user_id, email) VALUES
    (1, 'john.doe@example.com'),
    (1, 'johnny@example.com'),
    (1, 'jdoe@gmail.com'),
    (2, 'jane.smith@example.com'),
    (2, 'jsmith@gmail.com'),
    (2, 'jane.doe@outlook.com'),
    (3, 'alice.j@example.com'),
    (4, 'bob.brown@example.com'),
    (5, 'eve.white@example.com');