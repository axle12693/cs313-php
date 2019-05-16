DROP TABLE IF EXISTS Post_Comment;
DROP TABLE IF EXISTS Post;
DROP TABLE IF EXISTS App_User;
DROP TABLE IF EXISTS Forum;
DROP TABLE IF EXISTS Forum_Category;

CREATE TABLE App_User (
    app_user_id SERIAL  PRIMARY KEY,
    first_name  VARCHAR(40),
    middle_name VARCHAR(40),
    last_name   VARCHAR(40),
    username    VARCHAR(40),
    pw          VARCHAR(20)
    /*pw_hash     TEXT,
    salt        TEXT   -- to be implemented later.*/ 
);

INSERT INTO App_User
    (first_name, middle_name, last_name, username, pw)
VALUES
    ('Alex', 'C. ', 'Bentley', 'axle12693', 'test123'),
    ('Bob', 'the', 'Commenter', 'BobComment', 'comment123');

CREATE TABLE Forum_Category (
    forum_category_id   SERIAL  PRIMARY KEY,
    title               TEXT
);

INSERT INTO Forum_Category
    (title)
VALUES
    ('General'),
    ('Support');

CREATE TABLE Forum (
    forum_id            SERIAL  PRIMARY KEY,
    forum_category_id   SERIAL  REFERENCES Forum_Category(forum_category_id),
    title               TEXT
);

INSERT INTO Forum
    (forum_category_id, title)
VALUES
    (1, 'Dragons'),
    (1, 'Griffons'),
    (1, 'Hydras'),
    (2, 'Pet Care'),
    (2, 'Property Damage Help');

CREATE TABLE Post (
    post_id             SERIAL  PRIMARY KEY,
    forum_id            SERIAL  REFERENCES Forum(forum_id),
    app_user_id         SERIAL  REFERENCES App_User(app_user_id),
    title               VARCHAR(50),
    post_content        TEXT,
    date_last_updated   TIMESTAMP
);

INSERT INTO Post
    (forum_id, app_user_id, title, post_content, date_last_updated)
VALUES
    (1, 1, 'Dragons are so cool!', 'This is a post about how awesome dragons are. Woohoo!', '2019-05-16 12:37:00-00'),
    (2, 1, 'Griffons are cool, too, I guess.', 'Really though, griffons are like the less-cool cousins of dragons.', '2019-05-16 12:38:00-00'),
    (3, 1, 'Hydras are evil.', 'Really, these are not dragons. They are multi-headed danger noodles.', '2019-05-16 12:40:00-00'),
    (4, 1, 'Is my dragon supposed to breathe Hawaiian Punch?', 'I thought they breathed fire, but recently, my dragon has been breathing a tasty beverage!', '2019-05-16 12:43:00-00'),
    (5, 1, 'My house is on fire!', 'My dragon stopped breathing beverages, but now I have a bigger problem!', '2019-05-16 12:45:00-00');

CREATE TABLE Post_Comment (
    post_comment_id         SERIAL  PRIMARY KEY,
    post_id                 SERIAL  REFERENCES Post(post_id),
    app_user_id             SERIAL  REFERENCES App_User(app_user_id),
    post_comment_content    TEXT,
    date_last_updated       TIMESTAMP 
);

INSERT INTO Post_Comment
    (post_id, app_user_id, post_comment_content, date_last_updated)
VALUES
    (1, 2, 'You''re not wrong - dragons really are one of the most magnificent beasts!', '2019-05-16 15:19:00-00'),
    (2, 2, 'I totally disagree! Dragons might be amazong, but they pale in comparison to griffons!', '2019-05-16 15:20:00-00'),
    (3, 2, 'I can''t really disagree with you there. Hydras are the worst!', '2019-05-16 15:23:00-00'),
    (4, 2, 'I strongly suspect it''s just throwing up.', '2019-05-16 15:24:00-00'),
    (5, 2, 'Why are you posting on here? Call 911!', '2019-05-16 15:25:00-00');