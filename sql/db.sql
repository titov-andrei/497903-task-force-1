CREATE SCHEMA IF NOT EXISTS `task_force` DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;

USE `task_force`;

CREATE TABLE IF NOT EXISTS `task_force`.`users` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `last_name` VARCHAR(45) NULL,
    `first_name` VARCHAR(45) NOT NULL,
    `email` VARCHAR(45) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `age` TINYINT NULL,
    `last_activity_at` DATETIME NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `uind_email_password` (`email` ASC, `password` ASC)
);

CREATE TABLE IF NOT EXISTS `task_force`.`communication` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `phone` CHAR(11) NULL, 
    `skype` VARCHAR(255) NULL,
    `telegram` VARCHAR(255) NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `task_force`.`location` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `city_id` INT NULL,
    `latitude` VARCHAR(15) NULL,
    `longitude` VARCHAR(15) NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `task_force`.`additional_information` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `biografy` TEXT NULL,
    `is_public`  TINYINT(1) NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `task_force`.`avatar` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `file_id` INT NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `uind_user_id_file_id` (`user_id` ASC, `file_id` ASC)
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
    `client_id` INT NOT NULL, -- index
    `executor_id` INT NULL,
    `status` INT NOT NULL DEFAULT 1,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `updated_at` TIMESTAMP NULL,
    `city_id` INT NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `title_UNIQUE` (`title` ASC),
    UNIQUE INDEX `category_id_UNIQUE` (`category_id` ASC),
    UNIQUE INDEX `client_id_UNIQUE` (`client_id` ASC),
    UNIQUE INDEX `status_UNIQUE` (`status` ASC)
);

CREATE TABLE IF NOT EXISTS `task_force`.`responses` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `task_id` INT NOT NULL,
    `user_id` INT NOT NULL,
    `price` INT UNSIGNED NULL,
    `comment` TEXT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `task_force`.`files` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `task_id` INT NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `path` VARCHAR(255) NOT NULL,
    `user_id` INT NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `task_force`.`messages` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `task_id` INT NOT NULL,
    `author_id` INT NOT NULL, -- index
    `comment` TEXT NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `task_id_UNIQUE` (`task_id` ASC),
    UNIQUE INDEX `author_id_UNIQUE` (`author_id` ASC)
);

CREATE TABLE IF NOT EXISTS `task_force`.`cities` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `city` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `city_UNIQUE` (`city` ASC)
);

CREATE TABLE IF NOT EXISTS `task_force`.`categories` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `category` VARCHAR(45) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `category_UNIQUE` (`category` ASC)
);

CREATE TABLE IF NOT EXISTS `task_force`.`reviews` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `comment` TEXT NULL,
    `rating` TINYINT NOT NULL,
    `author_id` INT NOT NULL, -- index
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `updated_at` TIMESTAMP NULL,
    `user_id` INT NOT NULL, -- index
    PRIMARY KEY (`id`),
    UNIQUE INDEX `author_id_UNIQUE` (`author_id` ASC),
    UNIQUE INDEX `user_id_UNIQUE` (`user_id` ASC)
);

CREATE TABLE IF NOT EXISTS `task_force`.`favorite_users` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` INT NOT NULL, -- index
    `favoririte_user_id` INT NOT NULL, -- index
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `uind_favoririte_user_id_user_id` (`favoririte_user_id` ASC, `user_id` ASC),
    UNIQUE INDEX `user_id_UNIQUE` (`user_id` ASC),
    UNIQUE INDEX `favoririte_user_id_UNIQUE` (`favoririte_user_id` ASC)
);

CREATE TABLE IF NOT EXISTS `task_force`.`user_settings` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `new_response` TINYINT(1) NOT NULL DEFAULT 1,
    `new_messages` TINYINT(1) NOT NULL DEFAULT 1,
    `cancel_task` TINYINT(1) NOT NULL DEFAULT 1,
    `task_start` TINYINT(1) NOT NULL DEFAULT 1,
    `task_completion` TINYINT(1) NOT NULL DEFAULT 1,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`)
);
