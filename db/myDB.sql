CREATE TABLE Notes_User (
    notes_user_id   SERIAL,
    name_first VARCHAR(40),
    name_last  VARCHAR(40),
    PRIMARY KEY (notes_user_id)
);

INSERT INTO Notes_User
    (name_first, name_last)
VALUES
    ('Alex', 'Bentley'),
    ('Zach', 'Delano');

CREATE TABLE Speaker (
    speaker_id      SERIAL,
    name_first      VARCHAR(40),
    name_middle     VARCHAR(40),
    name_last       VARCHAR(40),
    position        VARCHAR(100),
    PRIMARY KEY (speaker_id)
);

INSERT INTO Speaker 
    (name_first, name_middle, name_last, position)
VALUES  
    ('Dallin', 'H.', 'Oaks', 'First Counselor in the First Presidency'),
    ('Henry', 'B.', 'Eyring', 'Second Counselor in the First Presidency'),
    ('Russell', 'M.', 'Nelson', 'President of the Church of Jesus Christ of Latter-day Saints');

CREATE TABLE Session_Type (
    session_type_id SERIAL,
    session_type    VARCHAR(100),
    PRIMARY KEY (session_type_id)
);

INSERT INTO Session_Type
    (session_type)
VALUES  
    ('Saturday Morning'),
    ('Saturday Afternoon'),
    ('General Priesthood'),
    ('Sunday Morning');

CREATE TABLE Conference_Session (
    session_id      SERIAL,
    session_type_id SERIAL  REFERENCES  Session_Type(session_type_id),
    month           VARCHAR(20),
    year            INTEGER,
    PRIMARY KEY (session_id)
);

INSERT INTO Conference_Session
    (session_type_id, month, year)
    SELECT st.session_type_id, 'April', 2019 FROM session_type st;

CREATE TABLE Talk (
    talk_id         SERIAL,
    speaker_id      SERIAL  REFERENCES Speaker(speaker_id),
    session_id      SERIAL  REFERENCES Conference_Session(session_id),
    title           VARCHAR(100),
    PRIMARY KEY (talk_id)
);

INSERT INTO Talk
    (speaker_id, session_id, title)
VALUES
    (2, 1, 'A Home Where the Spirit of the Lord Dwells'),
    (1, 3, 'Where Will This Lead?'),
    (3, 4, 'Come, Follow Me');

CREATE TABLE Note (
    note_id         SERIAL,
    talk_id         SERIAL  REFERENCES Talk(talk_id),
    notes_user_id   SERIAL  REFERENCES Notes_User(notes_user_id),
    content         TEXT,
    PRIMARY KEY (note_id)
);

INSERT INTO Note
    (talk_id, notes_user_id, content)
VALUES
    (1, 1, 'This is a note by Alex on talk 1!'),
    (1, 2, 'This is a note by Zach on talk 1!'),
    (2, 1, 'This is a note by Alex on talk 2!'),
    (2, 2, 'This is a note by Zach on talk 2!'),
    (3, 1, 'This is a note by Alex on talk 3!'),
    (3, 2, 'This is a note by Zach on talk 3!');

SELECT  u.name_first, u.name_last, n.content, t.title, s.name_first, s.name_middle, s.name_last
FROM    Notes_User u INNER JOIN Note n
ON      u.notes_user_id = n.notes_user_id INNER JOIN Talk t
ON      t.talk_id = n.talk_id INNER JOIN Speaker s 
ON      t.speaker_id = s.speaker_id;