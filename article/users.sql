create table users
(
    id       int auto_increment
        primary key,
    login    varchar(128) not null,
    password varchar(128) not null,
    hash     varchar(256) null,
    constraint users_login_uindex
        unique (login)
);

INSERT INTO test_db.users (id, login, password, hash) VALUES (1, 'root', 'd9b1d7db4cd6e70935368a1efb10e377', null);
INSERT INTO test_db.users (id, login, password, hash) VALUES (2, 'login', 'd9b1d7db4cd6e70935368a1efb10e377', null);
INSERT INTO test_db.users (id, login, password, hash) VALUES (14, 'elf', 'd9b1d7db4cd6e70935368a1efb10e377', 'ea67c613045a070dcc939eb611dbc8ea');
INSERT INTO test_db.users (id, login, password, hash) VALUES (16, 'test', 'd9b1d7db4cd6e70935368a1efb10e377', 'caa9cbd2d9ba24b02ac9a941515f35b9');
INSERT INTO test_db.users (id, login, password, hash) VALUES (17, 'ярик пандоры', '63ee451939ed580ef3c4b6f0109d1fd0', '6f59193c8cba2821726f67c54c2ada24');
INSERT INTO test_db.users (id, login, password, hash) VALUES (18, 'самозанятый ничем', 'd9b1d7db4cd6e70935368a1efb10e377', 'dc4b7647410aa2c97a4b0c377b391b82');
INSERT INTO test_db.users (id, login, password, hash) VALUES (19, 'бронетранспортёма', 'd9b1d7db4cd6e70935368a1efb10e377', '454ce2f94f6888fcf27f05859d50f32a');
INSERT INTO test_db.users (id, login, password, hash) VALUES (20, 'нейросельдь', 'd1d16c28c7674cfc5e269dbe1209f552', '4dcef3367444c9b2071ae6cd76150c39');
INSERT INTO test_db.users (id, login, password, hash) VALUES (21, 'шизомонтажник', 'd9b1d7db4cd6e70935368a1efb10e377', '367fbdd47e2bff003a3c578cc0b808f1');
INSERT INTO test_db.users (id, login, password, hash) VALUES (22, 'серийный тупица', 'd9b1d7db4cd6e70935368a1efb10e377', '05bda52666195022c431f25252afec88');
INSERT INTO test_db.users (id, login, password, hash) VALUES (24, 'Хоук', 'd9b1d7db4cd6e70935368a1efb10e377', '730d1d70ae56c6ac6520f25c540628a7');
INSERT INTO test_db.users (id, login, password, hash) VALUES (34, 'duk', 'd9b1d7db4cd6e70935368a1efb10e377', '0');
