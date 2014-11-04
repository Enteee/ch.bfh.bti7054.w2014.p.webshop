-- recreate database
/*
drop database if exists `codeshop`;
create database `codeshop`;
*/
use `codeshop`;

-- current tables
drop table if exists `offer_tag`;
drop table if exists `product_tag`;

drop table if exists `comment`;
drop table if exists `code`;
drop table if exists `order`;
drop table if exists `tag`;
drop table if exists `tag_type`;
drop table if exists `offer`;
drop table if exists `product`;
drop table if exists `user`;


-- create tables
create table `user` (
	`id` int not null primary key auto_increment,
	`email` varchar(100) not null unique,
	`token` varchar(100) not null,
	`credits` int not null default 0,
	`active` boolean not null default 1,
	`created_at` datetime,
    `updated_at` datetime
);
create table `product` (
	`id` int not null primary key auto_increment,
	`name` varchar(200) not null,
	`description` varchar(1000) not null,
	`active` boolean not null default 1,
	`created_at` datetime,
    `updated_at` datetime
);
create table `offer` (
	`id` int not null primary key auto_increment,
	`product_id` int not null,
	`price` int not null default 0,
	`active` boolean not null default 1,
	`created_at` datetime,
    `updated_at` datetime,

    constraint `offer_product` foreign key (`product_id`) references `product` (`id`)
);
create table `tag_type` (
	`id` int not null primary key auto_increment,
	`name` varchar(200) not null,
	`active` boolean not null default 1,
	`created_at` datetime,
    `updated_at` datetime
);
create table `tag` (
	`id` int not null primary key auto_increment,
	`type_id` int not null,
	`parent_id` int,
	`name` varchar(200) not null,
	`active` boolean not null default 1,
	`created_at` datetime,
    `updated_at` datetime,

    constraint `tag_tag` foreign key (`parent_id`) references `tag` (`id`),
    constraint `tag_tag_type` foreign key (`type_id`) references `tag_type` (`id`)
);
create table `order` (
	`id` int not null primary key auto_increment,
	`user_id` int not null,
	`offer_id` int not null,
	`paid_price` int not null default 0,
	`active` boolean not null default 1,
	`created_at` datetime,
    `updated_at` datetime,

    constraint `order_user` foreign key (`user_id`) references `user` (`id`),
    constraint `order_offer` foreign key (`offer_id`) references `offer` (`id`)
);
create table `code` (
	`id` int not null primary key auto_increment,
	`user_id` int not null,
	`offer_id` int not null,
	`filename` varchar(200) not null,
	`filesize` int not null default 0,
	`mimetype` varchar(200) not null,
	`content` blob not null,
	`active` boolean not null default 1,
	`created_at` datetime,
    `updated_at` datetime,

    constraint `code_user` foreign key (`user_id`) references `user` (`id`),
    constraint `code_offer` foreign key (`offer_id`) references `offer` (`id`)
);
create table `comment` (
	`id` int not null primary key auto_increment,
	`user_id` int not null,
	`product_id` int not null,
	`text` varchar(500) not null,
	`rating` int not null default 0,
	`active` boolean not null default 1,
	`created_at` datetime,
    `updated_at` datetime,

    constraint `comment_user` foreign key (`user_id`) references `user` (`id`),
    constraint `comment_product` foreign key (`product_id`) references `product` (`id`)
);

-- cross tables
create table `product_tag` (
	`id` int primary key auto_increment,
	`product_id` int not null,
	`tag_id` int not null,

    constraint `product_tag_product` foreign key (`product_id`) references `product` (`id`),
    constraint `product_tag_tag` foreign key (`tag_id`) references `tag` (`id`)
);
create table `offer_tag` (
	`id` int primary key auto_increment,
	`offer_id` int not null,
	`tag_id` int not null,

    constraint `offer_tag_offer` foreign key (`offer_id`) references `offer` (`id`),
    constraint `offer_tag_tag` foreign key (`tag_id`) references `tag` (`id`)
);
