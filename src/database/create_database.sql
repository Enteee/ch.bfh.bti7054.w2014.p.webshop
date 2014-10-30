drop database if exists codeshop;

-- create db
create database codeshop;
use codeshop;

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
    constraint `users_companies_FK_1` foreign key (product_id) references product (id),
    constraint `users_companies_FK_2` foreign key (category_id) references category (id)
);
