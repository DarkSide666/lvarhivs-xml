SET CHARACTER SET utf8mb4;

-- Database
DROP DATABASE IF EXISTS `lvarhivs`;
CREATE DATABASE `lvarhivs` DEFAULT CHARACTER SET utf8mb4;

USE `lvarhivs`;



-- Login add-on
CREATE TABLE `login_role` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
INSERT INTO `login_role` VALUES
    (1,'Administrators'),
    (2,'Users');

CREATE TABLE `login_user` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `role_id` int(11) unsigned DEFAULT NULL,
    `name` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `user_role_fk` (`role_id`),
    CONSTRAINT `user_role_fk` FOREIGN KEY (`role_id`) REFERENCES `login_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
INSERT INTO `login_user` VALUES
    (1,1,'Administrator','admin','$2y$10$p34ciRcg9GZyxukkLIaEnenGBao79fTFa4tFSrl7FvqrxnmEGlD4O'),
    (2,2,'Standard User','user','$2y$10$BwEhcP8f15yOexf077VTHOnySn/mit49ZhpfeBkORQhrsmHr4U6Qy');

CREATE TABLE `login_access_rule` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `role_id` int(11) unsigned NOT NULL,
    `model` text NOT NULL,
    `all_visible` tinyint(1) DEFAULT NULL,
    `visible_fields` text DEFAULT NULL,
    `all_editable` tinyint(1) DEFAULT NULL,
    `editable_fields` text DEFAULT NULL,
    `all_actions` tinyint(1) DEFAULT NULL,
    `actions` text DEFAULT NULL,
    `conditions` text DEFAULT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `rule_role_fk` FOREIGN KEY (`role_id`) REFERENCES `login_role` (`id`)
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
-- just for testing
INSERT INTO `login_access_rule` VALUES
    (1,1,'\\atk4\login\\Model\\Role',1,null,0,null,1,null,null),
    (2,2,'\\atk4\login\\Model\\User',1,null,1,null,1,null,null);



-- LV Arhivs XML implementation
CREATE TABLE `company` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `reg_number` varchar(32) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
INSERT INTO `company` VALUES
    (1,'Valsts Zemes dienests','LV99999999999');

CREATE TABLE `register` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `company_id` int(11) unsigned NOT NULL,
    `name` varchar(255) NOT NULL,
    `reg_id` varchar(255) NOT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `register_company_fk` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`)
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
INSERT INTO `register` VALUES
    (1,1,'Reģistrs A','VZD-REG-A');

CREATE TABLE `document` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `register_id` int(11) unsigned NOT NULL,
    `npk` int(11) unsigned NOT NULL,
    `group` varchar(128) DEFAULT NULL,
    `type` varchar(128) DEFAULT NULL,
    `name` varchar(255) NOT NULL,
    `doc_date` date NOT NULL,
    `reg_nr` varchar(64) NOT NULL,
    `lietas_nr` varchar(32) NOT NULL,
    `gus_nr` varchar(32) NOT NULL,
    `gv_nr` varchar(32) NOT NULL,
    `sender_reg_nr` varchar(64) DEFAULT NULL,
    `short_desc` varchar(255) DEFAULT NULL,
    `author` text DEFAULT NULL,
    `reg_date` date DEFAULT NULL,
    `sent_date` date DEFAULT NULL,
    `notes` text DEFAULT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `document_register_fk` FOREIGN KEY (`register_id`) REFERENCES `register` (`id`)
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
