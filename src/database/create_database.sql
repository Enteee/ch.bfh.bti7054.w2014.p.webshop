-- recreate database
/*
drop database if exists `codeshop`;
create database `codeshop`;
*/
use `codeshop`;

-- old tables
drop table if exists `product_category`;
drop table if exists `product`;
drop table if exists `category`;

-- current tables
drop table if exists `product_tag`;
drop table if exists `tag`;
drop table if exists `tag_type`;
drop table if exists `product`;
drop table if exists `user`;


-- create tables
create table `user` (
	`id` int not null primary key auto_increment,
	`email` varchar(100) not null unique,
	`password` char(40) not null -- sha1 hash
);
create table `product` (
	`id` int not null primary key auto_increment,
	`title` varchar(100),
	`description` varchar(500)
);
create table `category` (
	`id` int not null primary key auto_increment,
	`title` varchar(100)
);
create table `tag_type` (
	`id` int not null primary key auto_increment,
	`name_de` varchar(100),
	`name_en` varchar(100)
);
create table `tag` (
	`id` int not null primary key auto_increment,
	`name_de` varchar(100),
	`name_en` varchar(100),
	`type_id` int not null,

    constraint `tag_tag_type` foreign key (`type_id`) references `tag_type` (`id`)	
);
create table `code` (
	`id` int not null primary key auto_increment,
	`code` blob
);
-- cross tables
create table `product_category` (
	`id` int primary key auto_increment,
	`product_id` int not null,
	`category_id` int not null,

    constraint `product_category_product` foreign key (`product_id`) references `product` (`id`),
    constraint `product_category_category` foreign key (`category_id`) references `category` (`id`)
);
create table `product_tag` (
	`id` int primary key auto_increment,
	`product_id` int not null,
	`tag_id` int not null,

    constraint `product_tag_product` foreign key (`product_id`) references `product` (`id`),
    constraint `product_tag_tag` foreign key (`tag_id`) references `tag` (`id`)
);


-- inserts
/*
insert into `category` values
(1,'Snippets'),
(2,'Scripts'),
(3,'Full Software'),
(4,'Classes'),
(5,'Frameworks');

insert into `product` values
(1,'Hello World','The famous hello world snippets'),
(2,'Bubble sort','Basic sort method'),
(3,'Quick sort','Basic sort method');

insert into `tag` values
(1,'Tag 1'),
(2,'tag 2'),
(3,'Tag 3');

insert into `product_category` values
(1,1,1),
(2,1,2),
(3,1,3),
(4,2,4),
(5,3,5),
(6,3,1);

insert into `product_tag` values
(1,1,1),
(2,1,2),
(3,2,3),
(4,2,1),
(5,3,2),
(6,3,1),
(7,3,2),
(8,3,3);
*/

