
-- drop database if exists codeshop;

-- create db
-- create database codeshop;
use codeshop;

drop table if exists product_category;
drop table if exists category;
drop table if exists product;

-- table for categories
create table category (
	id int not null primary key auto_increment,
	title varchar(50)
);

-- table for products
create table product (
	id int not null primary key auto_increment,
	title varchar(100),
	description varchar(500)
);

-- many-to-many-table for product category relation
create table product_category (
	id int primary key auto_increment,
	product_id int not null,
	category_id int not null,
    constraint `product_category_product` foreign key (product_id) references product (id),
    constraint `product_category_category` foreign key (category_id) references category (id)
);

-- inserts
INSERT INTO `category` VALUES (1,'Snippets'),(2,'Scripts'),(3,'Full Software'),(4,'Classes'),(5,'Frameworks');
INSERT INTO `product` VALUES (1,'Hello World','The famous hello world snippets'),(2,'Bubble sort','Basic sort method'),(3,'Quick sort','Basic sort method');
INSERT INTO `product_category` VALUES (1,1,1),(2,2,2),(3,3,3),(4,1,2);

