DROP TABLE IF EXISTS scriptures;

CREATE TABLE Scripture(
    scripture_id        SERIAL PRIMARY KEY,
    book                VARCHAR(50),
    chapter             INT,
    verse               INT, 
    content             TEXT
);

INSERT INTO Scripture (book, chapter, verse, content)
VALUES ('John', 1, 5, 'And the light shineth in darkness; and the darkness comprehended it not.');

INSERT INTO Scripture (book, chapter, verse, content)
VALUES ('Doctrine and Covenants', 88, 49, 'The light shineth in darkness, and the darkness comprehended it not; nevertheless, the day shall come when you shall comprehend even God, being quickened in him and by him.');

INSERT INTO Scripture (book, chapter, verse, content)
VALUES ('Doctrine and Covenants', 93, 28, 'He that keepeth his commandments receiveth truth and light until he is glorified in truth and knoweth all things.');

INSERT INTO Scripture (book, chapter, verse, content)
VALUES ('Mosiah', 16, 9, 'He is the light and the life of the world; yeah, a light that is endless, that can never be darkened; yea, and also a life which is endless, that there can be no more death.');

CREATE TABLE Topic (
    topic_id    SERIAL  PRIMARY KEY,
    topic_name  VARCHAR(40)
);

INSERT INTO Topic 
    (topic_name)
VALUES
    ('Faith'),
    ('Sacrifice'),
    ('Charity');

CREATE TABLE Scripture_Topic (
    scripture_topic_id  SERIAL  PRIMARY KEY,
    scripture_id        SERIAL  REFERENCES  Scripture(scripture_id),
    topic_id            SERIAL  REFERENCES  Topic(topic_id)
);

