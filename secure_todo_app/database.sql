
CREATE TABLE `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY, -- Primary key for the users table
  `username` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE `tasks` (
  `id` INT AUTO_INCREMENT PRIMARY KEY, -- Primary key for the tasks table
  `user_id` INT NOT NULL, -- Foreign key referencing the users table
  `title` VARCHAR(255) NOT NULL,
  `description` TEXT,
  `category` ENUM('Work', 'Personal', 'Other') DEFAULT 'Personal',
  `due_date` DATE,
  `status` ENUM('Pending', 'In Progress', 'Completed') DEFAULT 'Pending',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
);
