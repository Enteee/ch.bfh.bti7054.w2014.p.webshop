
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- code
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `code`;

CREATE TABLE `code`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `user_id` INTEGER NOT NULL,
    `offer_id` INTEGER NOT NULL,
    `filename` VARCHAR(200) NOT NULL,
    `filesize` INTEGER DEFAULT 0 NOT NULL,
    `mimetype` VARCHAR(200) NOT NULL,
    `content` LONGBLOB NOT NULL,
    `active` TINYINT(1) DEFAULT 1 NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `code_user` (`user_id`),
    INDEX `code_offer` (`offer_id`),
    CONSTRAINT `code_user`
        FOREIGN KEY (`user_id`)
        REFERENCES `user` (`id`),
    CONSTRAINT `code_offer`
        FOREIGN KEY (`offer_id`)
        REFERENCES `offer` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- comment
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `comment`;

CREATE TABLE `comment`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `user_id` INTEGER NOT NULL,
    `product_id` INTEGER NOT NULL,
    `text` VARCHAR(500) NOT NULL,
    `rating` INTEGER DEFAULT 0 NOT NULL,
    `active` TINYINT(1) DEFAULT 1 NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `comment_user` (`user_id`),
    INDEX `comment_product` (`product_id`),
    CONSTRAINT `comment_user`
        FOREIGN KEY (`user_id`)
        REFERENCES `user` (`id`),
    CONSTRAINT `comment_product`
        FOREIGN KEY (`product_id`)
        REFERENCES `product` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- offer
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `offer`;

CREATE TABLE `offer`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `product_id` INTEGER NOT NULL,
    `price` INTEGER DEFAULT 0 NOT NULL,
    `active` TINYINT(1) DEFAULT 1 NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `offer_product` (`product_id`),
    CONSTRAINT `offer_product`
        FOREIGN KEY (`product_id`)
        REFERENCES `product` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- offer_tag
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `offer_tag`;

CREATE TABLE `offer_tag`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `offer_id` INTEGER NOT NULL,
    `tag_id` INTEGER NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `offer_tag_offer` (`offer_id`),
    INDEX `offer_tag_tag` (`tag_id`),
    CONSTRAINT `offer_tag_offer`
        FOREIGN KEY (`offer_id`)
        REFERENCES `offer` (`id`),
    CONSTRAINT `offer_tag_tag`
        FOREIGN KEY (`tag_id`)
        REFERENCES `tag` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- order
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `order`;

CREATE TABLE `order`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `user_id` INTEGER NOT NULL,
    `offer_id` INTEGER NOT NULL,
    `paid_price` INTEGER DEFAULT 0 NOT NULL,
    `active` TINYINT(1) DEFAULT 1 NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `order_user` (`user_id`),
    INDEX `order_offer` (`offer_id`),
    CONSTRAINT `order_user`
        FOREIGN KEY (`user_id`)
        REFERENCES `user` (`id`),
    CONSTRAINT `order_offer`
        FOREIGN KEY (`offer_id`)
        REFERENCES `offer` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- product
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(200) NOT NULL,
    `description` VARCHAR(1000) NOT NULL,
    `active` TINYINT(1) DEFAULT 1 NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- product_tag
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `product_tag`;

CREATE TABLE `product_tag`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `product_id` INTEGER NOT NULL,
    `tag_id` INTEGER NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `product_tag_product` (`product_id`),
    INDEX `product_tag_tag` (`tag_id`),
    CONSTRAINT `product_tag_product`
        FOREIGN KEY (`product_id`)
        REFERENCES `product` (`id`),
    CONSTRAINT `product_tag_tag`
        FOREIGN KEY (`tag_id`)
        REFERENCES `tag` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tag
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tag`;

CREATE TABLE `tag`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `type_id` INTEGER NOT NULL,
    `parent_id` INTEGER,
    `name` VARCHAR(200) NOT NULL,
    `active` TINYINT(1) DEFAULT 1 NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `tag_tag` (`parent_id`),
    INDEX `tag_tag_type` (`type_id`),
    CONSTRAINT `tag_tag`
        FOREIGN KEY (`parent_id`)
        REFERENCES `tag` (`id`),
    CONSTRAINT `tag_tag_type`
        FOREIGN KEY (`type_id`)
        REFERENCES `tag_type` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tag_type
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tag_type`;

CREATE TABLE `tag_type`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(200) NOT NULL,
    `active` TINYINT(1) DEFAULT 1 NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(100) NOT NULL,
    `token` VARCHAR(100) NOT NULL,
    `credits` INTEGER DEFAULT 0 NOT NULL,
    `active` TINYINT(1) DEFAULT 1 NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `email` (`email`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
