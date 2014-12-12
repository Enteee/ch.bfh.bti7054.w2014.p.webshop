
-----------------------------------------------------------------------
-- cs_code
-----------------------------------------------------------------------

DROP TABLE IF EXISTS [cs_code];

CREATE TABLE [cs_code]
(
    [id] INTEGER NOT NULL PRIMARY KEY,
    [user_id] INTEGER NOT NULL,
    [offer_id] INTEGER NOT NULL,
    [filename] VARCHAR(200) NOT NULL,
    [filesize] INTEGER DEFAULT 0 NOT NULL,
    [mimetype] VARCHAR(200) NOT NULL,
    [content] LONGBLOB NOT NULL,
    [active] INTEGER(1) DEFAULT 1 NOT NULL,
    [created_at] TIMESTAMP,
    [updated_at] TIMESTAMP
);

CREATE INDEX [code_user] ON [cs_code] ([user_id]);

CREATE INDEX [code_offer] ON [cs_code] ([offer_id]);

-- SQLite does not support foreign keys; this is just for reference
-- FOREIGN KEY ([user_id]) REFERENCES cs_user ([id])

-- SQLite does not support foreign keys; this is just for reference
-- FOREIGN KEY ([offer_id]) REFERENCES cs_offer ([id])

-----------------------------------------------------------------------
-- cs_review
-----------------------------------------------------------------------

DROP TABLE IF EXISTS [cs_review];

CREATE TABLE [cs_review]
(
    [id] INTEGER NOT NULL PRIMARY KEY,
    [user_id] INTEGER NOT NULL,
    [product_id] INTEGER NOT NULL,
    [text] VARCHAR(500) NOT NULL,
    [rating] INTEGER DEFAULT 0 NOT NULL,
    [active] INTEGER(1) DEFAULT 1 NOT NULL,
    [created_at] TIMESTAMP,
    [updated_at] TIMESTAMP
);

CREATE INDEX [review_user] ON [cs_review] ([user_id]);

CREATE INDEX [review_product] ON [cs_review] ([product_id]);

-- SQLite does not support foreign keys; this is just for reference
-- FOREIGN KEY ([user_id]) REFERENCES cs_user ([id])

-- SQLite does not support foreign keys; this is just for reference
-- FOREIGN KEY ([product_id]) REFERENCES cs_product ([id])

-----------------------------------------------------------------------
-- cs_offer
-----------------------------------------------------------------------

DROP TABLE IF EXISTS [cs_offer];

CREATE TABLE [cs_offer]
(
    [id] INTEGER NOT NULL PRIMARY KEY,
    [product_id] INTEGER NOT NULL,
    [price] INTEGER DEFAULT 0 NOT NULL,
    [active] INTEGER(1) DEFAULT 1 NOT NULL,
    [created_at] TIMESTAMP,
    [updated_at] TIMESTAMP
);

CREATE INDEX [offer_product] ON [cs_offer] ([product_id]);

-- SQLite does not support foreign keys; this is just for reference
-- FOREIGN KEY ([product_id]) REFERENCES cs_product ([id])

-----------------------------------------------------------------------
-- cs_offer_tag
-----------------------------------------------------------------------

DROP TABLE IF EXISTS [cs_offer_tag];

CREATE TABLE [cs_offer_tag]
(
    [id] INTEGER NOT NULL PRIMARY KEY,
    [offer_id] INTEGER NOT NULL,
    [tag_id] INTEGER NOT NULL
);

CREATE INDEX [offer_tag_offer] ON [cs_offer_tag] ([offer_id]);

CREATE INDEX [offer_tag_tag] ON [cs_offer_tag] ([tag_id]);

-- SQLite does not support foreign keys; this is just for reference
-- FOREIGN KEY ([offer_id]) REFERENCES cs_offer ([id])

-- SQLite does not support foreign keys; this is just for reference
-- FOREIGN KEY ([tag_id]) REFERENCES cs_tag ([id])

-----------------------------------------------------------------------
-- cs_order
-----------------------------------------------------------------------

DROP TABLE IF EXISTS [cs_order];

CREATE TABLE [cs_order]
(
    [id] INTEGER NOT NULL PRIMARY KEY,
    [user_id] INTEGER NOT NULL,
    [offer_id] INTEGER NOT NULL,
    [paid_price] INTEGER DEFAULT 0 NOT NULL,
    [active] INTEGER(1) DEFAULT 1 NOT NULL,
    [created_at] TIMESTAMP,
    [updated_at] TIMESTAMP
);

CREATE INDEX [order_user] ON [cs_order] ([user_id]);

CREATE INDEX [order_offer] ON [cs_order] ([offer_id]);

-- SQLite does not support foreign keys; this is just for reference
-- FOREIGN KEY ([user_id]) REFERENCES cs_user ([id])

-- SQLite does not support foreign keys; this is just for reference
-- FOREIGN KEY ([offer_id]) REFERENCES cs_offer ([id])

-----------------------------------------------------------------------
-- cs_product
-----------------------------------------------------------------------

DROP TABLE IF EXISTS [cs_product];

CREATE TABLE [cs_product]
(
    [id] INTEGER NOT NULL PRIMARY KEY,
    [active] INTEGER(1) DEFAULT 1 NOT NULL,
    [created_at] TIMESTAMP,
    [updated_at] TIMESTAMP,
    [avg_rating] INTEGER
);

-----------------------------------------------------------------------
-- cs_product_tag
-----------------------------------------------------------------------

DROP TABLE IF EXISTS [cs_product_tag];

CREATE TABLE [cs_product_tag]
(
    [id] INTEGER NOT NULL PRIMARY KEY,
    [product_id] INTEGER NOT NULL,
    [tag_id] INTEGER NOT NULL
);

CREATE INDEX [product_tag_product] ON [cs_product_tag] ([product_id]);

CREATE INDEX [product_tag_tag] ON [cs_product_tag] ([tag_id]);

-- SQLite does not support foreign keys; this is just for reference
-- FOREIGN KEY ([product_id]) REFERENCES cs_product ([id])

-- SQLite does not support foreign keys; this is just for reference
-- FOREIGN KEY ([tag_id]) REFERENCES cs_tag ([id])

-----------------------------------------------------------------------
-- cs_tag
-----------------------------------------------------------------------

DROP TABLE IF EXISTS [cs_tag];

CREATE TABLE [cs_tag]
(
    [id] INTEGER NOT NULL PRIMARY KEY,
    [type_id] INTEGER NOT NULL,
    [parent_id] INTEGER,
    [active] INTEGER(1) DEFAULT 1 NOT NULL,
    [created_at] TIMESTAMP,
    [updated_at] TIMESTAMP
);

CREATE INDEX [tag_tag] ON [cs_tag] ([parent_id]);

CREATE INDEX [tag_tag_type] ON [cs_tag] ([type_id]);

-- SQLite does not support foreign keys; this is just for reference
-- FOREIGN KEY ([parent_id]) REFERENCES cs_tag ([id])

-- SQLite does not support foreign keys; this is just for reference
-- FOREIGN KEY ([type_id]) REFERENCES cs_tag_type ([id])

-----------------------------------------------------------------------
-- cs_tag_type
-----------------------------------------------------------------------

DROP TABLE IF EXISTS [cs_tag_type];

CREATE TABLE [cs_tag_type]
(
    [id] INTEGER NOT NULL PRIMARY KEY,
    [active] INTEGER(1) DEFAULT 1 NOT NULL,
    [created_at] TIMESTAMP,
    [updated_at] TIMESTAMP
);

-----------------------------------------------------------------------
-- cs_user
-----------------------------------------------------------------------

DROP TABLE IF EXISTS [cs_user];

CREATE TABLE [cs_user]
(
    [id] INTEGER NOT NULL PRIMARY KEY,
    [email] VARCHAR(100) NOT NULL,
    [token] VARCHAR(100) NOT NULL,
    [credits] INTEGER DEFAULT 0 NOT NULL,
    [active] INTEGER(1) DEFAULT 1 NOT NULL,
    [created_at] TIMESTAMP,
    [updated_at] TIMESTAMP,
    UNIQUE ([email])
);

-----------------------------------------------------------------------
-- cs_product_i18n
-----------------------------------------------------------------------

DROP TABLE IF EXISTS [cs_product_i18n];

CREATE TABLE [cs_product_i18n]
(
    [id] INTEGER NOT NULL,
    [locale] VARCHAR(5) DEFAULT 'en_US' NOT NULL,
    [name] VARCHAR(200) NOT NULL,
    [description] VARCHAR(1000) NOT NULL,
    PRIMARY KEY ([id],[locale])
);

-- SQLite does not support foreign keys; this is just for reference
-- FOREIGN KEY ([id]) REFERENCES cs_product ([id])

-----------------------------------------------------------------------
-- cs_tag_i18n
-----------------------------------------------------------------------

DROP TABLE IF EXISTS [cs_tag_i18n];

CREATE TABLE [cs_tag_i18n]
(
    [id] INTEGER NOT NULL,
    [locale] VARCHAR(5) DEFAULT 'en_US' NOT NULL,
    [name] VARCHAR(200) NOT NULL,
    PRIMARY KEY ([id],[locale])
);

-- SQLite does not support foreign keys; this is just for reference
-- FOREIGN KEY ([id]) REFERENCES cs_tag ([id])

-----------------------------------------------------------------------
-- cs_tag_type_i18n
-----------------------------------------------------------------------

DROP TABLE IF EXISTS [cs_tag_type_i18n];

CREATE TABLE [cs_tag_type_i18n]
(
    [id] INTEGER NOT NULL,
    [locale] VARCHAR(5) DEFAULT 'en_US' NOT NULL,
    [name] VARCHAR(200) NOT NULL,
    PRIMARY KEY ([id],[locale])
);

-- SQLite does not support foreign keys; this is just for reference
-- FOREIGN KEY ([id]) REFERENCES cs_tag_type ([id])
