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
`name`)
VALUES
(1,'de_CH','Benutzertag'),
(1,'en_US','User tag'),
(2,'de_CH','Kategorie'),
(2,'en_US','Category'),
(3,'de_CH','Programmiersprache'),
(3,'en_US','Programming language')
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
(5,2,NULL,1,NOW(),NOW()),
-- programming languages
(6,3,NULL,1,NOW(),NOW()),
(7,3,NULL,1,NOW(),NOW()),
(8,3,NULL,1,NOW(),NOW()),
(9,3,NULL,1,NOW(),NOW())
;

INSERT INTO `tag_i18n`
(`id`,
`locale`,
`name`)
VALUES
(1,'de_CH','Snippets'),
(1,'en_US','Snippets'),
(2,'de_CH','Scripts'),
(2,'en_US','Scripts'),
(3,'de_CH','Komplette Software'),
(3,'en_US','Full Software'),
(4,'de_CH','Klassen'),
(4,'en_US','Classes'),
(5,'de_CH','Frameworks'),
(5,'en_US','Frameworks'),
-- programming languages
(6,'de_CH','C'),
(6,'en_US','C'),
(7,'de_CH','Java'),
(7,'en_US','Java'),
(8,'de_CH','PHP'),
(8,'en_US','PHP'),
(9,'de_CH','Lisp'),
(9,'en_US','Lisp')
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
`description`)
VALUES
(1,'de_CH','Hallo Welt','Das berühmte Hallo Welt Snippet'),
(1,'en_US','Hello World','The famous hello world snippets'),
(2,'de_CH','Blasen Sort','Standard Suchalgorithmus'),
(2,'en_US','Bubble sort','Basic sort method'),
(3,'de_CH','Schneller Sort','Standard Suchalgorithmus'),
(3,'en_US','Quick sort','Basic sort method')
;

INSERT INTO `product_tag`
(`id`,
`product_id`,
`tag_id`)
VALUES
(1,1,1),
(2,1,2),
(3,1,3),
(4,1,4),
(5,1,5),
(6,2,1),
(7,2,2),
(8,3,1),
(9,3,2),
(10,3,3),
(11,3,4)
;

INSERT INTO `user`
(`id`,
`email`,
`token`,
`credits`,
`active`,
`created_at`,
`updated_at`)
VALUES
(1,'testuser@gmail.com','abcdef',1000,1,NOW(),NOW())
;

INSERT INTO `review`
(`id`,
`user_id`,
`product_id`,
`text`,
`rating`,
`active`,
`created_at`,
`updated_at`)
VALUES
(1,1,1,'Sehr geiles Produkt! Kann ich nur weiterempfehlen.',5,1,NOW(),NOW())
;

INSERT INTO `offer`
(`id`,
`product_id`,
`price`,
`active`,
`created_at`,
`updated_at`)
VALUES
(1,1,100,1,NOW(),NOW()),
(2,2,1000,1,NOW(),NOW()),
(3,3,250,1,NOW(),NOW())
;

