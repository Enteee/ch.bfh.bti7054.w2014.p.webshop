USE `codeshop`;

INSERT INTO `tag_type`
(`id`,
`active`,
`created_at`,
`updated_at`)
VALUES
(1,1,NOW(),NOW()),
(2,1,NOW(),NOW()),
(3,1,NOW(),NOW())
;


INSERT INTO `tag_type_i18n`
(`id`,
`locale`,
`name`,
`created_at`,
`updated_at`)
VALUES
(1,'de_CH','Benutzertag',NOW(),NOW()),
(1,'en_US','User tag',NOW(),NOW()),
(2,'de_CH','Kategorie',NOW(),NOW()),
(2,'en_US','Category',NOW(),NOW()),
(3,'de_CH','Programmiersprache',NOW(),NOW()),
(3,'en_US','Programming language',NOW(),NOW())
;

INSERT INTO `tag`
(`id`,
`type_id`,
`parent_id`,
`active`,
`created_at`,
`updated_at`)
VALUES
(1,2,NULL,1,NOW(),NOW()),
(2,2,NULL,1,NOW(),NOW()),
(3,2,NULL,1,NOW(),NOW()),
(4,2,NULL,1,NOW(),NOW()),
(5,2,NULL,1,NOW(),NOW())
;

INSERT INTO `tag_i18n`
(`id`,
`locale`,
`name`,
`created_at`,
`updated_at`)
VALUES
(1,'de_CH','Snippets',NOW(),NOW()),
(1,'en_US','Snippets',NOW(),NOW()),
(2,'de_CH','Scripts',NOW(),NOW()),
(2,'en_US','Scripts',NOW(),NOW()),
(3,'de_CH','Komplette Software',NOW(),NOW()),
(3,'en_US','Full Software',NOW(),NOW()),
(4,'de_CH','Klassen',NOW(),NOW()),
(4,'en_US','Classes',NOW(),NOW()),
(5,'de_CH','Frameworks',NOW(),NOW()),
(5,'en_US','Frameworks',NOW(),NOW())
;

INSERT INTO `product`
(`id`,
`active`,
`created_at`,
`updated_at`)
VALUES
(1,1,NOW(),NOW()),
(2,1,NOW(),NOW()),
(3,1,NOW(),NOW())
;

INSERT INTO `product_i18n`
(`id`,
`locale`,
`name`,
`description`,
`created_at`,
`updated_at`)
VALUES
(1,'de_CH','Hallo Welt','Das berühmte Hallo Welt Snippet',NOW(),NOW()),
(1,'en_US','Hello World','The famous hello world snippets',NOW(),NOW()),
(2,'de_CH','Blasen Sort','Standard Suchalgorithmus',NOW(),NOW()),
(2,'en_US','Bubble sort','Basic sort method',NOW(),NOW()),
(3,'de_CH','Schneller Sort','Standard Suchalgorithmus',NOW(),NOW()),
(3,'en_US','Quick sort','Basic sort method',NOW(),NOW())
;

INSERT INTO `product_tag`
(`id`,
`product_id`,
`tag_id`,
`created_at`,
`updated_at`)
VALUES
(1,1,1,NOW(),NOW()),
(2,1,2,NOW(),NOW()),
(3,1,3,NOW(),NOW()),
(4,1,4,NOW(),NOW()),
(5,1,5,NOW(),NOW()),
(6,2,1,NOW(),NOW()),
(7,2,2,NOW(),NOW()),
(8,3,1,NOW(),NOW()),
(9,3,2,NOW(),NOW()),
(10,3,3,NOW(),NOW()),
(11,3,4,NOW(),NOW())
;

