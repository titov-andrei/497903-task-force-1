CREATE SCHEMA IF NOT EXISTS `task_force` DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;

USE `task_force`;

CREATE TABLE IF NOT EXISTS `task_force`.`users` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `last_name` VARCHAR(45) NULL,
    `first_name` VARCHAR(45) NOT NULL,
    `email` VARCHAR(45) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `age` TINYINT NULL,
    `city_id` INT NULL,
    `role` TINYINT NULL DEFAULT 0,
    `birthday_at` DATE NULL,
    `phone` VARCHAR(11) NULL,
    `skype` VARCHAR(255) NULL,
    `telegram` VARCHAR(255) NULL,
    `latitude` VARCHAR(255) NULL,
    `longitude` VARCHAR(255) NULL,
    `last_activity_at` DATETIME NULL,
    `biografy` TEXT NULL,
    `avatar_id` INT NULL,
    `is_public` INT NULL,
    `created_at` DATETIME NOT NULL,
    `updated_at` DATETIME NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `uind_email_password` (`email` ASC, `password` ASC)
);

CREATE TABLE IF NOT EXISTS `task_force`.`user_categories` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `category_id` INT NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `uind_user_id_category_id` (`user_id` ASC, `category_id` ASC)
);

CREATE TABLE IF NOT EXISTS `task_force`.`user_photos` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `file_id` INT NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `uind_user_id_file_id` (`user_id` ASC, `file_id` ASC)
);

CREATE TABLE IF NOT EXISTS `task_force`.`tasks` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    `description` TEXT NOT NULL,
    `category_id` INT NOT NULL,
    `latitude` VARCHAR(255) NULL,
    `longitude` VARCHAR(255) NULL,
    `price` INT UNSIGNED NULL,
    `task_term_at` DATETIME NULL,
    `client_id` INT NOT NULL,
    `executor_id` INT NULL,
    `status` INT NOT NULL,
    `created_at` DATETIME NOT NULL,
    `updated_at` DATETIME NULL,
    `city_id` INT NOT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `task_force`.`responses` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `task_id` INT NULL,
    `price` INT UNSIGNED NULL,
    `comment` TEXT NULL,
    `created_at` DATETIME NOT NULL,
    `updated_at` DATETIME NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `task_force`.`task_file` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `task_id` INT NOT NULL,
    `file_id` INT NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `uind_task_id_file_id` (`task_id` ASC, `file_id` ASC)
);

CREATE TABLE IF NOT EXISTS `task_force`.`files` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    `type` VARCHAR(255) NOT NULL,
    `path` VARCHAR(255) NOT NULL,
    `user_id` INT NOT NULL,
    `created_at` DATETIME NOT NULL,
    `updated_at` DATETIME NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `task_force`.`messages` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `chat_id` INT NOT NULL,
    `author_id` INT NOT NULL,
    `comment` TEXT NOT NULL,
    `created_at` DATETIME NOT NULL,
    `updated_at` DATETIME NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `task_force`.`cities` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `city` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `city_UNIQUE` (`city` ASC)
);

CREATE TABLE IF NOT EXISTS `task_force`.`task_statuses` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `status_id` INT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `status_UNIQUE` (`status_id` ASC)
);

CREATE TABLE IF NOT EXISTS `task_force`.`categories` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `category` VARCHAR(45) NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `category_UNIQUE` (`category` ASC)
);

CREATE TABLE IF NOT EXISTS `task_force`.`reviews` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `comment` TEXT NULL,
    `rating` TINYINT NOT NULL,
    `author_id` INT NOT NULL,
    `created_at` DATETIME NOT NULL,
    `updated_at` DATETIME NULL,
    `user_id` INT NOT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `task_force`.`favorite_users` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `favoririte_user_id` INT NOT NULL,
    `created_at` DATETIME NOT NULL,
    `updated_at` DATETIME NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `uind_favoririte_user_id_user_id` (`favoririte_user_id` ASC, `user_id` ASC)
);

CREATE TABLE IF NOT EXISTS `task_force`.`user_settings` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `new_response` TINYINT NULL DEFAULT 1,
    `new_messages` TINYINT NULL DEFAULT 1,
    `cancel_task` TINYINT NULL DEFAULT 1,
    `task_start` TINYINT NULL DEFAULT 1,
    `task completion` TINYINT NULL DEFAULT 1,
    `created_at` DATETIME NOT NULL,
    `updated_at` DATETIME NOT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `task_force`.`chats` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `recipient_id` INT NOT NULL,
  `author_id` INT NOT NULL,
  PRIMARY KEY (`id`)
);
