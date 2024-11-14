-- ---------------------------------
-- SCRIPT 1

-- Set up the database

SHOW DATABASES;
DROP DATABASE IF EXISTS assign2db;
CREATE DATABASE assign2db;
USE assign2db; 


-- Create the tables for the database

SHOW TABLES;

CREATE TABLE user(userid VARCHAR(8) NOT NULL, firstname VARCHAR(30) NOT NULL, lastname VARCHAR(30) NOT NULL, image VARCHAR(100), PRIMARY KEY(userid));

CREATE TABLE post (postid CHAR(3) NOT NULL, posttext VARCHAR(500) NOT NULL, postdate DATE NOT NULL,image VARCHAR(100), userid VARCHAR(8), PRIMARY KEY(postid), FOREIGN KEY (userid) REFERENCES user(userid) ON DELETE CASCADE);

CREATE TABLE hashtag (hashtagid CHAR(3) NOT NULL, hashtagtext VARCHAR(30) NOT NULL, trending TINYINT, hashtagdate DATE NOT NULL, PRIMARY KEY(hashtagid));

CREATE TABLE follows (follower VARCHAR(8), following VARCHAR(8), followyear SMALLINT NOT NULL, PRIMARY KEY (follower,following), FOREIGN KEY(follower) REFERENCES user(userid), FOREIGN KEY(following) REFERENCES user(userid));

CREATE TABLE comments (userid VARCHAR(8) NOT NULL, postid CHAR(3) NOT NULL, commentdate DATE NOT NULL, commenttext VARCHAR(200) NOT NULL, PRIMARY KEY (userid, postid), FOREIGN KEY(userid) REFERENCES user(userid), FOREIGN KEY(postid) REFERENCES post(postid));

CREATE TABLE hashonpost (hashtagid CHAR(3) NOT NULL, postid CHAR(3) NOT NULL, PRIMARY KEY (hashtagid, postid), FOREIGN KEY(hashtagid) REFERENCES hashtag(hashtagid), FOREIGN KEY(postid) REFERENCES post(postid));



-- ------------------------------------
-- insert some data

-- insert into the user table

INSERT INTO user (userid, firstname, lastname, image) VALUES
('rgell', 'Ross', 'Geller', NULL),
('rgree', 'Rachel', 'Green', 'https://csd.uwo.ca/~lreid2/cs3319/pics/rachel.jpg'),
('mgell', 'Monica', 'Geller', NULL),
('jtrib3', 'Joey', 'Tribbiani', NULL),
('pbuff', 'Phoebe', 'Buffay', NULL),
('cbing33', 'Chandler', 'Bing', 'https://csd.uwo.ca/~lreid2/cs3319/pics/cb1.jpg');
INSERT INTO user (userid, firstname, lastname, image) VALUES
('hsimp', 'Homer', 'Simpson', 'https://csd.uwo.ca/~lreid2/cs3319/pics/homer.jpg'),
('msimp', 'Marge', 'Simpson', NULL),
('tflan', 'Todd', 'Flanders', 'https://csd.uwo.ca/~lreid2/cs3319/pics/todd.jpg'),
('nflan', 'Ned', 'Flanders', 'https://csd.uwo.ca/~lreid2/cs3319/pics/ned.jpg');



-- insert into the post Table


INSERT INTO post (postid, posttext, postdate, image, userid) VALUES ('201', 'Life is beautiful! Enjoy every moment.', '2023-11-03', NULL, 'rgree');
INSERT INTO post (postid, posttext, postdate, image, userid) VALUES ('202', 'Spread positivity and kindness today!', '2023-11-03', NULL, 'rgree');
INSERT INTO post (postid, posttext, postdate, image, userid) VALUES ('203', 'Believe in yourself and your dreams.', '2023-11-03', NULL, 'rgree');
INSERT INTO post (postid, posttext, postdate, image, userid) VALUES ('204', 'Be a good neighbor and help others.', '2023-11-03', NULL, 'tflan');
INSERT INTO post (postid, posttext, postdate, image, userid) VALUES ('205', 'Always keep a positive attitude.', '2023-11-03', NULL, 'tflan');
INSERT INTO post (postid, posttext, postdate, image, userid) VALUES ('206', 'Family is everything; cherish the moments.', '2023-11-03', NULL, 'tflan');
INSERT INTO post (postid, posttext, postdate, image, userid) VALUES ('207', 'Dream big and work hard to achieve your goals.', '2023-11-03', NULL, 'jtrib3');
INSERT INTO post (postid, posttext, postdate, image, userid) VALUES ('208', 'Laughter is the best medicine.', '2023-11-03', NULL, 'jtrib3');
INSERT INTO post (postid, posttext, postdate, image, userid) VALUES ('209', 'Stay positive and keep smiling!', '2023-11-03', NULL, 'jtrib3');
INSERT INTO post (postid, posttext, postdate, image, userid) VALUES ('210', 'Embrace change and don\'t be afraid to be yourself.', '2023-11-03', NULL, 'cbing33');
INSERT INTO post (postid, posttext, postdate, image, userid) VALUES ('211', 'Make your own luck in life.', '2023-11-03', NULL, 'cbing33');
INSERT INTO post (postid, posttext, postdate, image, userid) VALUES ('212', 'Cleaning is good for the soul', '2021-10-03', NULL, 'mgell');


-- insert into the hashtag Table

INSERT INTO hashtag (hashtagid, hashtagtext, trending, hashtagdate) VALUES ('001', '#Inspiration', 1, '2023-11-03');
INSERT INTO hashtag (hashtagid, hashtagtext, trending, hashtagdate) VALUES ('002', '#PositiveVibes', 1, '2023-11-03');
INSERT INTO hashtag (hashtagid, hashtagtext, trending, hashtagdate) VALUES ('003', '#DreamBig', 1, '2023-11-03');
INSERT INTO hashtag (hashtagid, hashtagtext, trending, hashtagdate) VALUES ('004', '#KindnessMatters', 1, '2023-11-03');
INSERT INTO hashtag (hashtagid, hashtagtext, trending, hashtagdate) VALUES ('005', '#FamilyLove', 0, '2023-11-03');
INSERT INTO hashtag (hashtagid, hashtagtext, trending, hashtagdate) VALUES ('006', '#LaughMore', 1, '2023-11-03');
INSERT INTO hashtag (hashtagid, hashtagtext, trending, hashtagdate) VALUES ('007', '#ChaseYourDreams', 0, '2023-11-03');
INSERT INTO hashtag (hashtagid, hashtagtext, trending, hashtagdate) VALUES ('008', '#StayPositive', 1, '2023-11-03');
INSERT INTO hashtag (hashtagid, hashtagtext, trending, hashtagdate) VALUES ('009', '#EmbraceChange', 0, '2023-11-03');
INSERT INTO hashtag (hashtagid, hashtagtext, trending, hashtagdate) VALUES ('010', '#BeYourself', 1, '2023-11-03');


-- insert into the taable that shows which hashtags are on which posts

INSERT INTO hashonpost (hashtagid, postid) VALUES ('001', '201');
INSERT INTO hashonpost (hashtagid, postid) VALUES ('002', '201');
INSERT INTO hashonpost (hashtagid, postid) VALUES ('002', '202');
INSERT INTO hashonpost (hashtagid, postid) VALUES ('004', '202');
INSERT INTO hashonpost (hashtagid, postid) VALUES ('006', '202');
INSERT INTO hashonpost (hashtagid, postid) VALUES ('006', '206');
INSERT INTO hashonpost (hashtagid, postid) VALUES ('008', '208');
INSERT INTO hashonpost (hashtagid, postid) VALUES ('008', '201');
INSERT INTO hashonpost (hashtagid, postid) VALUES ('010', '208');


-- insert into the comment table.
SELECT * FROM comments;
INSERT INTO comments (userid, postid, commentdate, commenttext) VALUES ('rgell', '201', '2023-11-03', 'Beautiful message, Rachel! Keep spreading positivity.');
INSERT INTO comments (userid, postid, commentdate, commenttext) VALUES ('pbuff', '209', '2023-11-03', 'Joey, your posts always make me smile.');
INSERT INTO comments (userid, postid, commentdate, commenttext) VALUES ('hsimp', '210', '2023-11-03', 'Chandler, you never fail to make us laugh!');
INSERT INTO comments (userid, postid, commentdate, commenttext) VALUES ('hsimp', '211', '2023-11-03', 'Chandler, your positive energy is contagious.');
INSERT INTO comments (userid, postid, commentdate, commenttext) VALUES ('msimp', '201', '2023-11-03', 'Ross, I needed this message today. Thank you!');
INSERT INTO comments (userid, postid, commentdate, commenttext) VALUES ('tflan', '203', '2010-11-03', 'Monica, your words of wisdom inspire me.');
INSERT INTO comments (userid, postid, commentdate, commenttext) VALUES ('rgree', '210', '2023-11-03', 'Chandler, you always bring a smile to my face.');
INSERT INTO comments (userid, postid, commentdate, commenttext) VALUES ('jtrib3', '204', '2023-11-03', 'Todd, being a good neighbor is a great philosophy.');
INSERT INTO comments (userid, postid, commentdate, commenttext) VALUES ('tflan', '201', '2023-11-03', 'Rachel, you radiate positivity!');


-- insert into the follow table
INSERT INTO follows (follower, following, followyear) VALUES ('rgell', 'rgree', 2015);
INSERT INTO follows (follower, following, followyear) VALUES ('rgell', 'jtrib3', 2018);
INSERT INTO follows (follower, following, followyear) VALUES ('rgell', 'cbing33', 2019);
INSERT INTO follows (follower, following, followyear) VALUES ('jtrib3', 'rgree', 2015);
INSERT INTO follows (follower, following, followyear) VALUES ('jtrib3', 'cbing33', 2019);
INSERT INTO follows (follower, following, followyear) VALUES ('hsimp', 'rgree', 2019);
INSERT INTO follows (follower, following, followyear) VALUES ('tflan', 'hsimp', 2017);

-- More data:
-- Insert more data into the user table
INSERT INTO user (userid, firstname, lastname, image) VALUES
('lbenson', 'Olivia', 'Benson', NULL),
('mgray', 'Meredith', 'Grey', NULL),
('dunphy', 'Phil', 'Dunphy', NULL),
('hhill', 'Hank', 'Hill', NULL),
('lester', 'Lester', 'Nygaard', NULL),
('lsolomon', 'Liz', 'Solomon', NULL);

-- Insert more data into the post table
INSERT INTO post (postid, posttext, postdate, image, userid) VALUES 
('213', 'Every day is a new beginning. Make it count!', '2023-11-04', NULL, 'lbenson'),
('214', 'Gratitude turns what we have into enough.', '2023-11-04', NULL, 'mgray'),
('215', 'Keep calm and stay weird.', '2023-11-04', NULL, 'dunphy'),
('216', 'Propane and propane accessories!', '2023-11-04', NULL, 'hhill'),
('217', 'You never know what the day will bring, embrace it!', '2023-11-04', NULL, 'lester'),
('218', 'Find joy in the ordinary moments.', '2023-11-04', NULL, 'lsolomon'),
('219', 'Life is too short to be anything but happy.', '2023-11-04', NULL, 'lbenson'),
('220', 'Inhale confidence, exhale doubt.', '2023-11-04', NULL, 'mgray'),
('221', 'Stay goofy, stay happy!', '2023-11-04', NULL, 'dunphy'),
('222', 'Strickland Propane - Taste the Freedom!', '2023-11-04', NULL, 'hhill');

-- Insert more data into the hashtag table
INSERT INTO hashtag (hashtagid, hashtagtext, trending, hashtagdate) VALUES 
('011', '#NewBeginnings', 1, '2023-11-04'),
('012', '#Gratitude', 1, '2023-11-04'),
('013', '#StayWeird', 1, '2023-11-04'),
('014', '#PropaneLife', 0, '2023-11-04'),
('015', '#EmbraceChange', 0, '2023-11-04'),
('016', '#FindJoy', 1, '2023-11-04'),
('017', '#Happiness', 1, '2023-11-04'),
('018', '#Confidence', 1, '2023-11-04'),
('019', '#Goofy', 0, '2023-11-04'),
('020', '#Freedom', 1, '2023-11-04');

-- Insert more data into the hashonpost table
INSERT INTO hashonpost (hashtagid, postid) VALUES 
('011', '213'),
('012', '214'),
('013', '215'),
('014', '216'),
('015', '217'),
('016', '218'),
('017', '219'),
('018', '220'),
('019', '221'),
('020', '222');

-- Insert more data into the comments table
INSERT INTO comments (userid, postid, commentdate, commenttext) VALUES 
('lbenson', '201', '2023-11-04', 'Rachel, your positivity is infectious!'),
('mgray', '210', '2023-11-04', 'Chandler, thanks for the uplifting message.'),
('dunphy', '209', '2023-11-04', 'Joey, your posts always crack me up!'),
('hhill', '204', '2023-11-04', 'Todd, you are a good neighbor indeed!'),
('lester', '203', '2023-11-04', 'Monica, your words inspire me to be better.'),
('lsolomon', '207', '2023-11-04', 'Joey, keep chasing those dreams!'),
('rgree', '214', '2023-11-04', 'Meredith, your posts are always so insightful.'),
('cbing33', '215', '2023-11-04', 'Phil, stay weird, my friend!'),
('jtrib3', '220', '2023-11-04', 'Liz, your positivity shines through!'),
('tflan', '218', '2023-11-04', 'Lester, finding joy in the ordinary is the key to happiness.');

-- Insert more data into the follows table
INSERT INTO follows (follower, following, followyear) VALUES 
('lbenson', 'rgree', 2016),
('mgray', 'jtrib3', 2017),
('dunphy', 'cbing33', 2020),
('hhill', 'tflan', 2019),
('lsolomon', 'rgree', 2018),
('rgree', 'mgray', 2016),
('cbing33', 'dunphy', 2019),
('jtrib3', 'lsolomon', 2020),
('tflan', 'lbenson', 2017),
('rgell', 'dunphy', 2015);