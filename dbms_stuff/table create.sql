CREATE TABLE webassignment3.products_all (
item_index INT(6) NOT NULL auto_increment UNIQUE,
item_rating CHAR(1) NOT NULL DEFAULT 0,
item_price DECIMAL(7) NOT NULL DEFAULT 0,
item_title VARCHAR(40) NOT NULL,
item_img BLOB,
PRIMARY KEY ( item_index )
);
