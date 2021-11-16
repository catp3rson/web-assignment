CREATE DATABASE tutor_booking_system;
USE tutor_booking_system;
CREATE TABLE courses (
	course_code          char(6)  NOT NULL    PRIMARY KEY,
	course_name          varchar(255)  NOT NULL    ,
    course_category		 varchar(255)  NOT NULL    ,
	tutor_id			 int UNSIGNED NOT NULL	,
	brief				 varchar(5000)		,
	description          varchar(5000)      ,
	course_fee           int UNSIGNED NOT NULL    ,
	schedule             json  NOT NULL    ,
	start_date           date  NOT NULL    ,
	end_date             date  NOT NULL    
 ) engine=InnoDB;


ALTER TABLE courses COMMENT 'Contains currently available courses';

ALTER TABLE courses MODIFY course_code char(6)  NOT NULL   COMMENT 'The course code should have the following format: <subject code> - <index number>\nin which:\n_ <subject code> is 2 characters long and can be looked up in the subjects table.\n_ <index number> is the index of the course';

ALTER TABLE courses MODIFY schedule json  NOT NULL   COMMENT 'List of time slots in the week that classes take place. This attribute is a json object\n\nExample: {''Monday'': [''7:00 - 8:00'', ''14:30 - 15:30''], ''Friday'': [''14:30 - 15:30'']}';

ALTER TABLE courses MODIFY start_date date  NOT NULL   COMMENT 'Course''s start date';

ALTER TABLE courses MODIFY end_date date  NOT NULL   COMMENT 'Course''s end date';

CREATE TABLE locations ( 
	location_id          int UNSIGNED NOT NULL    PRIMARY KEY,
	location_name        varchar(500)  NOT NULL    ,
	longtitude           double  NOT NULL    ,
	latitude             double  NOT NULL    ,
	location_description varchar(500)  NOT NULL    ,
	CONSTRAINT unq_locations_longlat UNIQUE ( longtitude, latitude ) 
) engine=InnoDB;

ALTER TABLE locations COMMENT 'Contains the locations of the tutoring center';

CREATE TABLE subjects ( 
	subject_code         char(2)  NOT NULL    PRIMARY KEY,
	subject_name         varchar(100)  NOT NULL    ,
	num_courses          int UNSIGNED NOT NULL    
 ) engine=InnoDB;

ALTER TABLE subjects MODIFY num_courses int UNSIGNED NOT NULL   COMMENT 'Number of courses belonging to this subject';

CREATE TABLE users ( 
	user_id              int UNSIGNED NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	username             varchar(100)  NOT NULL    ,
	password             varchar(100)  NOT NULL    ,
	# email                varchar(100)  NOT NULL    ,
	full_name            varchar(100)  NOT NULL    ,
	birthday             date NOT NULL  		   ,
	phone                varchar(11)  NOT NULL     ,
	address              varchar(2000)  NOT NULL   ,
	role                 int UNSIGNED NOT NULL DEFAULT 2   ,
	description          varchar(5000)      	   ,
	CONSTRAINT unq_users_username UNIQUE ( username ) ,
	CONSTRAINT unq_users_phone UNIQUE ( phone ) 
 ) engine=InnoDB;

ALTER TABLE users COMMENT 'Contains information of application users';

ALTER TABLE users MODIFY role int UNSIGNED NOT NULL DEFAULT 2  COMMENT 'The role of the user in the system. There are 3 roles: admin (system admin), tutor, user (regular user of the application).\n\nThe code for each role is\n_ admin: 0\n_ tutor: 1\n_ user: 2';


-- Insert the data
-- real password of admin is admin123
-- real password of math123, physics123, english123 is tutor123
-- real password of user1, user2, user3 is user123


INSERT INTO users (username, password, full_name, birthday, phone, address, role, description) 
VALUES 
	(
		'admin',
		'240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9',
		'Nguyen Van A',
		'1995-10-20',
		'01234567890',
		'506 Hong Bang street ward 16 district 11',
		0,
		NULL
	),
	(
		'math123',
		'537d26965fd30bf9ebe78b86a8b56ca954cd886ed6d57e43fd37924f1dc2fcbf',
		'Tran Van B',
		'1996-11-21',
		'01112223333',
		'No. 331 Ben Van Don, Ward 1, District 48',
		1,
		'Math tutor for secondary students.'
	),
	(
		'physics123',
		'537d26965fd30bf9ebe78b86a8b56ca954cd886ed6d57e43fd37924f1dc2fcbf',
		'Le Thi C',
		'1990-12-01',
		'03334445555',
		'565B Au Co Street, Ward 10',
		1,
		'Physics tutor for high school students (from grade 10-12). I have crash courses for university entrance test.'
	),
	(
		'english123',
		'537d26965fd30bf9ebe78b86a8b56ca954cd886ed6d57e43fd37924f1dc2fcbf',
		'Nguyen Thanh D',
		'1992-02-03',
		'04445556666',
		'1051-1021 Nguyen Trai St., Ward 14, Dist. 5',
		1,
		'English teacher for kids aged 5 to 10.'
	),
	(
		'user1',
		'e606e38b0d8c19b24cf0ee3808183162ea7cd63ff7912dbb22b5e803286b4446',
		'Tran Thi E',
		'1990-07-19',
		'05556667777',
		'165B Phan Dang luu, Ward 3',
		2,
		NULL
	),
	(
		'user2',
		'e606e38b0d8c19b24cf0ee3808183162ea7cd63ff7912dbb22b5e803286b4446',
		'Le Phu F',
		'1998-12-02',
		'06667778888',
		'21 Nguyen Bieu, Nam Ha Ward',
		2,
		NULL
	),
	(
		'user3',
		'e606e38b0d8c19b24cf0ee3808183162ea7cd63ff7912dbb22b5e803286b4446',
		'Nguyen Minh G',
		'1996-07-07',
		'07778889999',
		'268 Cao Xuan Duc street, Ward 12, District 8',
		2,
		NULL
	);

INSERT INTO subjects (subject_code, subject_name, num_courses)
VALUES
	('MA', 'Math', 1),
	('PH', 'Physics', 1),
	('EN', 'English', 1);

INSERT INTO courses (course_code, course_name, course_category, tutor_id, brief, description, course_fee, schedule, start_date, end_date)
VALUES
	(
		'MA0001',
		'Advanced Math for Grade 9',
        'math',
		2,
		'A 3-month Math course for Grade 9 students.',
		'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Rhoncus aenean vel elit scelerisque. Venenatis a condimentum vitae sapien pellentesque habitant. Egestas fringilla phasellus faucibus scelerisque eleifend donec pretium. Elit at imperdiet dui accumsan sit. Tortor id aliquet lectus proin nibh nisl condimentum. Nibh venenatis cras sed felis eget. Sed enim ut sem viverra. At risus viverra adipiscing at. Velit ut tortor pretium viverra suspendisse potenti nullam ac. Sociis natoque penatibus et magnis dis parturient montes nascetur. Elit eget gravida cum sociis natoque penatibus et. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed. Purus viverra accumsan in nisl nisi scelerisque. Adipiscing vitae proin sagittis nisl rhoncus mattis rhoncus urna neque. Risus ultricies tristique nulla aliquet.',
		6000000,
		'{"Monday": ["18:00-20:00"], "Thursday":["18:00-20:00"]}',
		'2021-11-15',
		'2022-02-14'
	),
	(
		'PH0001',
		'Physics crash course for Grade 12',
        'physics',
		3,
		'A 2-month Physics crash course for Grade 12 students who is taking part in the 2022 university entrance test.',
		'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Rhoncus aenean vel elit scelerisque. Venenatis a condimentum vitae sapien pellentesque habitant. Egestas fringilla phasellus faucibus scelerisque eleifend donec pretium. Elit at imperdiet dui accumsan sit. Tortor id aliquet lectus proin nibh nisl condimentum. Nibh venenatis cras sed felis eget. Sed enim ut sem viverra. At risus viverra adipiscing at. Velit ut tortor pretium viverra suspendisse potenti nullam ac. Sociis natoque penatibus et magnis dis parturient montes nascetur. Elit eget gravida cum sociis natoque penatibus et. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed. Purus viverra accumsan in nisl nisi scelerisque. Adipiscing vitae proin sagittis nisl rhoncus mattis rhoncus urna neque. Risus ultricies tristique nulla aliquet.',
		4000000,
		'{"Monday": ["18:00-20:00"], "Tuesday":["18:00-20:00"], "Thursday":["18:00-20:00"]}',
		'2021-11-22',
		'2022-01-24'
	),
	(
		'EN0001',
		'Basic English for kids',
        'english',
		4,
		'A fun online English course for kids aged 5-10.',
		'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Rhoncus aenean vel elit scelerisque. Venenatis a condimentum vitae sapien pellentesque habitant. Egestas fringilla phasellus faucibus scelerisque eleifend donec pretium. Elit at imperdiet dui accumsan sit. Tortor id aliquet lectus proin nibh nisl condimentum. Nibh venenatis cras sed felis eget. Sed enim ut sem viverra. At risus viverra adipiscing at. Velit ut tortor pretium viverra suspendisse potenti nullam ac. Sociis natoque penatibus et magnis dis parturient montes nascetur. Elit eget gravida cum sociis natoque penatibus et. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed. Purus viverra accumsan in nisl nisi scelerisque. Adipiscing vitae proin sagittis nisl rhoncus mattis rhoncus urna neque. Risus ultricies tristique nulla aliquet.',
		4000000,
		'{"Monday": ["18:00-20:00"], "Friday":["18:00-20:00"]}',
		'2021-11-22',
		'2022-02-21'
	);
    
INSERT INTO locations (location_id, location_name, latitude, longtitude, location_description)
VALUES
	(1, 'Nha Trang branch', 12.249520736579708, 109.18676734631, '71 Yersin Street, Nha Trang City'),
	(2, 'Head Quarter at Ho Chi Minh City', 10.773922365553329, 106.66068367301231, '268 Ly Thuong Kiet Street, District 10, Ho Chi Minh City'),
	(3, 'Can Tho branch', 10.000316093244491, 105.75045605911849, '414 National Road 1A - Area Yen Ha, Le Binh, Cai Rang, Can Tho'),
	(4, 'Ha Noi branch', 21.007866621437497, 105.84328620369546, '1 Dai Co Viet Street, Hai Ba Trung, Ha Noi');
