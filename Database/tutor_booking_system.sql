DROP DATABASE tutor_booking_system;
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
	password             varchar(100)  NOT NULL    ,
	email                varchar(100)  NOT NULL    ,
	full_name            varchar(100)  NOT NULL    ,
	birthday             date NOT NULL  		   ,
	phone                varchar(11)  NOT NULL     ,
	address              varchar(2000)  NOT NULL   ,
	role                 int UNSIGNED NOT NULL DEFAULT 2   ,
	description          varchar(5000)      	   

	#CONSTRAINT unq_users_phone UNIQUE ( phone ) 
 ) engine=InnoDB;


-- Insert the data
-- real password of admin is admin123
-- real password of math123, physics123, english123 is tutor123
-- real password of user1, user2, user3 is user123



    
INSERT INTO locations (location_id, location_name, latitude, longtitude, location_description)
VALUES
	(1, 'Nha Trang branch', 12.249520736579708, 109.18676734631, '71 Yersin Street, Nha Trang City'),
	(2, 'Head Quarter at Ho Chi Minh City', 10.773922365553329, 106.66068367301231, '268 Ly Thuong Kiet Street, District 10, Ho Chi Minh City'),
	(3, 'Can Tho branch', 10.000316093244491, 105.75045605911849, '414 National Road 1A - Area Yen Ha, Le Binh, Cai Rang, Can Tho'),
	(4, 'Ha Noi branch', 21.007866621437497, 105.84328620369546, '1 Dai Co Viet Street, Hai Ba Trung, Ha Noi');
