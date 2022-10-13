create table comments
(
    id          int auto_increment
        primary key,
    text        varchar(256) default '0' not null,
    user        int          default 1   not null,
    levl        int          default 0   not null,
    parent      int          default 0   null,
    main_parent int          default 0   not null,
    time        int          default 0   not null
);

INSERT INTO test_db.comments (id, text, user, levl, parent, main_parent, time) VALUES (1, 'test', 16, 0, 0, 0, 1665662658);
INSERT INTO test_db.comments (id, text, user, levl, parent, main_parent, time) VALUES (2, 'ПОМОГИТЕ!!!', 21, 0, 0, 0, 1665626000);
INSERT INTO test_db.comments (id, text, user, levl, parent, main_parent, time) VALUES (3, 'Я застрял на этом сайте!', 20, 0, 0, 0, 1665639070);
INSERT INTO test_db.comments (id, text, user, levl, parent, main_parent, time) VALUES (4, 'А как тут получить админ права?', 34, 0, 0, 0, 1665608927);
INSERT INTO test_db.comments (id, text, user, levl, parent, main_parent, time) VALUES (5, 'Куплю собаку.', 18, 0, 0, 0, 1665618207);
INSERT INTO test_db.comments (id, text, user, levl, parent, main_parent, time) VALUES (6, 'Продам гараж', 19, 0, 0, 0, 1665682481);
INSERT INTO test_db.comments (id, text, user, levl, parent, main_parent, time) VALUES (7, 'А как пройти в библиотеку?', 22, 0, 0, 0, 1665679617);
INSERT INTO test_db.comments (id, text, user, levl, parent, main_parent, time) VALUES (8, 'Мастер, когда игра?', 34, 0, 0, 0, 1665644854);
INSERT INTO test_db.comments (id, text, user, levl, parent, main_parent, time) VALUES (9, 'В пустыне найдена девушка, говорит что идёт к своему кораблю, зовут Хоук, кто потерял?', 20, 0, 0, 0, 1665676008);
INSERT INTO test_db.comments (id, text, user, levl, parent, main_parent, time) VALUES (10, 'Это Хоук, где мой корабль?', 24, 1, 9, 9, 1665678211);
INSERT INTO test_db.comments (id, text, user, levl, parent, main_parent, time) VALUES (11, 'А между прочим, библиотека справа.', 34, 1, 7, 7, 1665601574);
INSERT INTO test_db.comments (id, text, user, levl, parent, main_parent, time) VALUES (12, 'Тем временем напоминаю что статья про кожу.', 16, 0, 0, 0, 1665618566);
INSERT INTO test_db.comments (id, text, user, levl, parent, main_parent, time) VALUES (13, 'testtesttesttesttesttesttesttesttesttesttesttesttesttesttesttes', 16, 5, 20, 1, 1665666213);
INSERT INTO test_db.comments (id, text, user, levl, parent, main_parent, time) VALUES (14, 'Я застрял на этом сайте', 17, 0, 0, 0, 1665634041);
INSERT INTO test_db.comments (id, text, user, levl, parent, main_parent, time) VALUES (15, 'test 1.2', 16, 1, 1, 1, 1665633772);
INSERT INTO test_db.comments (id, text, user, levl, parent, main_parent, time) VALUES (16, 'test 2.1', 16, 2, 15, 1, 1665623182);
INSERT INTO test_db.comments (id, text, user, levl, parent, main_parent, time) VALUES (17, 'test 3.1', 16, 3, 16, 1, 1665680598);
INSERT INTO test_db.comments (id, text, user, levl, parent, main_parent, time) VALUES (18, 'test 2.2', 16, 2, 19, 1, 1665641696);
INSERT INTO test_db.comments (id, text, user, levl, parent, main_parent, time) VALUES (19, 'test 1.1', 16, 1, 1, 1, 1665640228);
INSERT INTO test_db.comments (id, text, user, levl, parent, main_parent, time) VALUES (20, 'test 3.2', 16, 4, 17, 1, 1665665112);
INSERT INTO test_db.comments (id, text, user, levl, parent, main_parent, time) VALUES (21, 'test 2.3', 16, 2, 15, 1, 1665687881);
INSERT INTO test_db.comments (id, text, user, levl, parent, main_parent, time) VALUES (22, 'неть :р', 16, 1, 2, 2, 1665684080);
INSERT INTO test_db.comments (id, text, user, levl, parent, main_parent, time) VALUES (23, 'test 3.3', 16, 3, 21, 1, 1665687327);
INSERT INTO test_db.comments (id, text, user, levl, parent, main_parent, time) VALUES (24, 'я тоже', 34, 1, 3, 3, 1665688073);
INSERT INTO test_db.comments (id, text, user, levl, parent, main_parent, time) VALUES (25, 'кряк12', 34, 2, 24, 3, 1665688114);
