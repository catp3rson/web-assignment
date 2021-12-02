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
	end_date             date  NOT NULL   ,
	image				 longtext
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
	role                 int UNSIGNED NOT NULL DEFAULT 2   ,
	description          varchar(5000)      	   ,
	image				longtext					,
	CONSTRAINT unq_users_phone UNIQUE ( phone ), 
    CONSTRAINT unq_users_email UNIQUE ( email )
 ) engine=InnoDB;

ALTER TABLE users COMMENT 'Contains information of application users';

ALTER TABLE users MODIFY role int UNSIGNED NOT NULL DEFAULT 2  COMMENT 'The role of the user in the system. There are 3 roles: admin (system admin), tutor, user (regular user of the application).\n\nThe code for each role is\n_ admin: 0\n_ tutor: 1\n_ user: 2';

INSERT INTO `users` (`password`, `email`, `full_name`, `birthday`, `phone`, `role`, `description`,`image`) 
VALUES 
	(

		'240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9',
		'nguyenvana@gmail.com',
        'Nguyen Van A',
		'1995-10-20',
		'01234567890',
		0,
		NULL,
		'admin.jpeg'
	),
	(

		'537d26965fd30bf9ebe78b86a8b56ca954cd886ed6d57e43fd37924f1dc2fcbf',
		'tranvanb@gmail.com',
        'Tran Van B',
		'1996-11-21',
		'01112223333',
		1,
		'Math tutor for secondary students.',
		'tutor2.jpeg'
	),
	(

		'537d26965fd30bf9ebe78b86a8b56ca954cd886ed6d57e43fd37924f1dc2fcbf',
		'lethic@gmail.com',
        'Le Thi C',
		'1990-12-01',
		'03334445555',
		1,
		'Physics tutor for high school students (from grade 10-12). I have crash courses for university entrance test.',
		'tutor1.jpeg'
	),
	(
		'537d26965fd30bf9ebe78b86a8b56ca954cd886ed6d57e43fd37924f1dc2fcbf',
		'nguyend@gmail.com',
        'Nguyen Thanh D',
		'1992-02-03',
		'04445556666',
		1,
		'English teacher for kids aged 5 to 10.',
		'tutor5.jpeg'
	),
	(

		'e606e38b0d8c19b24cf0ee3808183162ea7cd63ff7912dbb22b5e803286b4446',
		'trane@gmail.com',
        'Tran Thi E',
		'1990-07-19',
		'05556667777',
		2,
		NULL,
		'tutor4.jpeg'
	),
	(

		'e606e38b0d8c19b24cf0ee3808183162ea7cd63ff7912dbb22b5e803286b4446',
        'lef@gmail.com',
		'Le Phu F',
		'1998-12-02',
		'06667778888',
		2,
		NULL,
		'tutor3.jpeg'
	),
	(

		'e606e38b0d8c19b24cf0ee3808183162ea7cd63ff7912dbb22b5e803286b4446',
        'nguyeng@gmail.com',
		'Nguyen Minh G',
		'1996-07-07',
		'07778889999',
		2,
		NULL,
		'tutor6.jpeg'
	);

INSERT INTO `courses` (`course_code`, `course_name`, `course_category`, `tutor_id`, `brief`, `description`, `course_fee`, `schedule`, `start_date`, `end_date`, `image`) VALUES
('BI0001', 'Introduction to Biology - The Secret of Life', 'biology', 5, 'A 2-month Biology crash course ', 'Introduction to Biology – The Secret of Life will let you explore the mysteries of biochemistry, genetics, molecular biology, recombinant DNA technology and genomics, and rational medicine. Good luck in your journey!', 4000000, '{\"Monday\": [\"20:00-22:00\"], \"Tuesday\":[\"20:00-22:00\"], \"Thursday\":[\"18:00-20:00\"]}', '2021-11-22', '2021-01-04','Introduction to Biology - The Secret of Life.jpeg'),
('BI0002', 'Molecular Biology - Part 1: DNA Replication and Repair', 'biology', 5, 'A 2-month Biology crash course ', 'You’re acquainted with your DNA, but did you know that your cells synthesize enough DNA during your lifetime to stretch a lightyear in length? How does the cellular machinery accomplish such a feat without making more mistakes than you can survive? Why isn’t the incidence of cancer even higher than it iscourses? And, if the DNA in each and every cell is two meters long, how is this genetic material compacted to fit inside the cell nucleus without becoming a tangled mess?Are you ready to go beyond the “what\" of scientific information presented in textbooks and explore how scientists deduce the details of these molecular models?Take a behind-the-scenes look at modern molecular genetics, from the classic experimental events that identified the proteins involved in DNA replication and repair to cutting-edge assays that apply the power of genome sequencing. Do you feel confident in your ability to design molecular biology experiments and interpret data from them? We have designed the problems in this course to build your experimental design and data analysis skills.', 6000000, '{\"Monday\": [\"20:00-22:00\"], \"Tuesday\":[\"20:00-22:00\"], \"Thursday\":[\"18:00-20:00\"]}', '2021-11-22', '2021-01-04','Molecular Biology -Part 1- DNA Replication and Repair.png'),
('BI0003', 'Molecular Biology - Part 2: Transcription and Transposition', 'biology', 5, 'A 2-month Biology crash course ', 'You’re acquainted with your DNA, but did you know that your cells synthesize enough DNA during your lifetime to stretch a lightyear in length? How does the cellular machinery accomplish such a feat without making more mistakes than you can survive? Why isn’t the incidence of cancer even higher than it is? And, if the DNA in each and every cell is two meters long, how is this genetic material compacted to fit inside the cell nucleus without becoming a tangled mess?Are you ready to go beyond the “what\" of scientific information presented in textbooks and explore how scientists deduce the details of these molecular models?Take a behind-the-scenes look at modern molecular genetics, from the classic experimental events that identified the proteins involved in DNA replication and repair to cutting-edge assays that apply the power of genome sequencing. Do you feel confident in your ability to design molecular biology experiments and interpret data from them? We have designed the problems in this course to build your experimental design and data analysis skills.', 6000000, '{\"Monday\": [\"20:00-22:00\"], \"Tuesday\":[\"20:00-22:00\"], \"Thursday\":[\"18:00-20:00\"]}', '2021-11-22', '2021-01-04','Molecular Biology - Part 2- Transcription and Transposition.jpg'),
('BI0004', 'Molecular Biology - Part 3: RNA Processing and Translation', 'biology', 5, 'A 2-month Biology crash course ', 'You’re acquainted with your DNA, but did you know that your cells synthesize enough DNA during your lifetime to stretch a lightyear in length? How does the cellular machinery accomplish such a feat without making more mistakes than you can survive? Why isn’t the incidence of cancer even higher than it is? And, if the DNA in each and every cell is two meters long, how is this genetic material compacted to fit inside the cell nucleus without becoming a tangled mess?Are you ready to go beyond the “what\" of scientific information presented in textbooks and explore how scientists deduce the details of these molecular models?Take a behind-the-scenes look at modern molecular genetics, from the classic experimental events that identified the proteins involved in DNA replication and repair to cutting-edge assays that apply the power of genome sequencing. Do you feel confident in your ability to design molecular biology experiments and interpret data from them? We have designed the problems in this course to build your experimental design and data analysis skills.', 6000000, '{\"Monday\": [\"20:00-22:00\"], \"Tuesday\":[\"20:00-22:00\"], \"Thursday\":[\"18:00-20:00\"]}', '2021-11-22', '2021-01-04','Molecular Biology - Part 3- RNA Processing and Translation.jpg'),
('BI0005', 'Biology, Grade 12, University Preparation part 1', 'biology', 5, 'A 2-month Biology crash course ', 'This course provides students with the opportunity for in-depth study of the concepts and processes associated with biological systems. Students will study theory and conduct investigations in the areas of biochemistry, metabolic processes, molecular genetics, homeostasis, and population dynamics. Emphasis will be placed on achievement of the detailed knowledge and refinement of skills needed for further study in various branches of the life sciences and related fields.', 6000000, '{\"Monday\": [\"20:00-22:00\"], \"Tuesday\":[\"20:00-22:00\"], \"Thursday\":[\"18:00-20:00\"]}', '2021-11-22', '2021-01-04','Biology, Grade 12, University Preparation part 1.jpeg'),
('BI0006', 'Biology, Grade 12, University Preparation part 2', 'biology', 5, 'A 2-month Biology crash course ', 'This course provides students with the opportunity for in-depth study of the concepts and processes associated with biological systems. Students will study theory and conduct investigations in the areas of biochemistry, metabolic processes, molecular genetics, homeostasis, and population dynamics. Emphasis will be placed on achievement of the detailed knowledge and refinement of skills needed for further study in various branches of the life sciences and related fields.', 6000000, '{\"Monday\": [\"20:00-22:00\"], \"Tuesday\":[\"20:00-22:00\"], \"Thursday\":[\"18:00-20:00\"]}', '2021-11-22', '2021-01-04','Biology, Grade 12, University Preparation part 2.png'),
('CH0001', 'Chemistry 101 - Part 1 Principles of Chemistry', 'chemistry', 4, 'A 2-month Chemistry crash course ', 'This course is a comprehensive introduction to Chemistry, covering everything you will need to know as you prepare for possible future exams.  It doesnot matter how much, or how little, prior knowledge of Chemistry youve got as this course will take you through all the necessary stages.The content is based on the International GCSE specification as followed by thousands of students around the world, and will prepare you thoroughly for progression to advanced programmes. In Section 1, The Principles of Chemistry, there are five video lessons, each one lasting about 20 minutes.', 6000000, '{\"Monday\": [\"18:00-20:00\"], \"Tuesday\":[\"20:00-22:00\"], \"Thursday\":[\"18:00-20:00\"]}', '2021-11-22', '2021-01-04','Chemistry 101 - Part 1 Principles of Chemistry.jpeg'),
('CH0002', 'Chemistry 101 - Part 2 Principles of Chemistry', 'chemistry', 4, 'A 2-month Chemistry crash course ', 'This course is a comprehensive introduction to Chemistry, covering everything you will need to know as you prepare for possible future exams.  It doesnot matter how much, or how little, prior knowledge of Chemistry youve got as this course will take you through all the necessary stages.The content is based on the International GCSE specification as followed by thousands of students around the world, and will prepare you thoroughly for progression to advanced programmes. In Section 2, The Principles of Chemistry, there are five video lessons, each one lasting about 20 minutes.', 6000000, '{\"Monday\": [\"20:00-22:00\"], \"Tuesday\":[\"20:00-22:00\"], \"Thursday\":[\"18:00-20:00\"]}', '2021-11-22', '2021-01-04','Chemistry 101 - Part 2 Principles of Chemistry.jpeg'),
('CH0003', 'Chemistry 101 - Part 3 Principles of Chemistry', 'chemistry', 4, 'A 2-month Chemistry crash course ', 'This course is a comprehensive introduction to Chemistry, covering everything you will need to know as you prepare for possible future exams.  It doesnot matter how much, or how little, prior knowledge of Chemistry youve got as this course will take you through all the necessary stages.The content is based on the International GCSE specification as followed by thousands of students around the world, and will prepare you thoroughly for progression to advanced programmes. In Section 3, The Principles of Chemistry, there are five video lessons, each one lasting about 20 minutes.', 6000000, '{\"Monday\": [\"19:00-21:00\"], \"Tuesday\":[\"19:00-21:00\"], \"Thursday\":[\"18:00-20:00\"]}', '2021-11-22', '2021-01-04','Chemistry 101 - Part 3 Principles of Chemistry.jpeg'),
('CH0004', 'Chemistry 101 - Part 4 Principles of Chemistry', 'chemistry', 4, 'A 2-month Chemistry crash course ', 'This course is a comprehensive introduction to Chemistry, covering everything you will need to know as you prepare for possible future exams.  It doesnot matter how much, or how little, prior knowledge of Chemistry youve got as this course will take you through all the necessary stages.The content is based on the International GCSE specification as followed by thousands of students around the world, and will prepare you thoroughly for progression to advanced programmes. In Section 4, The Principles of Chemistry, there are five video lessons, each one lasting about 20 minutes.', 6000000, '{\"Monday\": [\"20:00-22:00\"], \"Tuesday\":[\"20:00-22:00\"], \"Thursday\":[\"18:00-20:00\"]}', '2021-11-22', '2021-01-04','Chemistry 101 - Part 4 Principles of Chemistry.jpeg'),
('CH0005', 'Chemistry 101 - Part 5 Principles of Chemistry', 'chemistry', 4, 'A 2-month Chemistry crash course ', 'This course is a comprehensive introduction to Chemistry, covering everything you will need to know as you prepare for possible future exams.  It doesnot matter how much, or how little, prior knowledge of Chemistry youve got as this course will take you through all the necessary stages.The content is based on the International GCSE specification as followed by thousands of students around the world, and will prepare you thoroughly for progression to advanced programmes. In Section 5, The Principles of Chemistry, there are five video lessons, each one lasting about 20 minutes.', 6000000, '{\"Monday\": [\"17:00-19:00\"], \"Tuesday\":[\"17:00-19:00\"], \"Thursday\":[\"18:00-20:00\"]}', '2021-11-22', '2021-01-04','Chemistry 101 - Part 5 Principles of Chemistry.jpeg'),
('CH0006', 'Chemistry 101 - Part 6 Principles of Chemistry', 'chemistry', 4, 'A 2-month Chemistry crash course ', 'This course is a comprehensive introduction to Chemistry, covering everything you will need to know as you prepare for possible future exams.  It doesnot matter how much, or how little, prior knowledge of Chemistry youve got as this course will take you through all the necessary stages.The content is based on the International GCSE specification as followed by thousands of students around the world, and will prepare you thoroughly for progression to advanced programmes. In Section 6, The Principles of Chemistry, there are five video lessons, each one lasting about 20 minutes.', 6000000, '{\"Monday\": [\"20:00-22:00\"], \"Tuesday\":[\"20:00-22:00\"], \"Thursday\":[\"18:00-20:00\"]}', '2021-11-22', '2021-01-04','Chemistry 101 - Part 6 Principles of Chemistry.jpeg'),
('EN0001', 'Basic English for kids', 'english', 4, 'A fun online English course for kids aged 5-10.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Rhoncus aenean vel elit scelerisque. Venenatis a condimentum vitae sapien pellentesque habitant. Egestas fringilla phasellus faucibus scelerisque eleifend donec pretium. Elit at imperdiet dui accumsan sit. Tortor id aliquet lectus proin nibh nisl condimentum. Nibh venenatis cras sed felis eget. Sed enim ut sem viverra. At risus viverra adipiscing at. Velit ut tortor pretium viverra suspendisse potenti nullam ac. Sociis natoque penatibus et magnis dis parturient montes nascetur. Elit eget gravida cum sociis natoque penatibus et. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed. Purus viverra accumsan in nisl nisi scelerisque. Adipiscing vitae proin sagittis nisl rhoncus mattis rhoncus urna neque. Risus ultricies tristique nulla aliquet.', 4000000, '{\"Monday\": [\"18:00-20:00\"], \"Friday\":[\"18:00-20:00\"]}', '2021-11-22', '2022-02-21','Basic English for kids.jpeg'),
('EN0002', 'Basic English for grade 6', 'english', 4, 'An online English course for grade 6 students.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Rhoncus aenean vel elit scelerisque. Venenatis a condimentum vitae sapien pellentesque habitant. Egestas fringilla phasellus faucibus scelerisque eleifend donec pretium. Elit at imperdiet dui accumsan sit. Tortor id aliquet lectus proin nibh nisl condimentum. Nibh venenatis cras sed felis eget. Sed enim ut sem viverra. At risus viverra adipiscing at. Velit ut tortor pretium viverra suspendisse potenti nullam ac. Sociis natoque penatibus et magnis dis parturient montes nascetur. Elit eget gravida cum sociis natoque penatibus et. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed. Purus viverra accumsan in nisl nisi scelerisque. Adipiscing vitae proin sagittis nisl rhoncus mattis rhoncus urna neque. Risus ultricies tristique nulla aliquet.', 4000000, '{\"Monday\": [\"18:00-20:00\"], \"Friday\":[\"18:00-20:00\"]}', '2021-11-22', '2022-02-21','Basic English for grade 6.jpeg'),
('EN0003', 'Basic English for grade 7', 'english', 4, 'An online English course for grade 7 students.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Rhoncus aenean vel elit scelerisque. Venenatis a condimentum vitae sapien pellentesque habitant. Egestas fringilla phasellus faucibus scelerisque eleifend donec pretium. Elit at imperdiet dui accumsan sit. Tortor id aliquet lectus proin nibh nisl condimentum. Nibh venenatis cras sed felis eget. Sed enim ut sem viverra. At risus viverra adipiscing at. Velit ut tortor pretium viverra suspendisse potenti nullam ac. Sociis natoque penatibus et magnis dis parturient montes nascetur. Elit eget gravida cum sociis natoque penatibus et. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed. Purus viverra accumsan in nisl nisi scelerisque. Adipiscing vitae proin sagittis nisl rhoncus mattis rhoncus urna neque. Risus ultricies tristique nulla aliquet.', 4000000, '{\"Monday\": [\"18:00-20:00\"], \"Friday\":[\"18:00-20:00\"]}', '2021-11-22', '2022-02-21','Basic English for grade 7.jpeg'),
('EN0004', 'Basic English for grade 8', 'english', 4, 'An online English course for grade 8 students.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Rhoncus aenean vel elit scelerisque. Venenatis a condimentum vitae sapien pellentesque habitant. Egestas fringilla phasellus faucibus scelerisque eleifend donec pretium. Elit at imperdiet dui accumsan sit. Tortor id aliquet lectus proin nibh nisl condimentum. Nibh venenatis cras sed felis eget. Sed enim ut sem viverra. At risus viverra adipiscing at. Velit ut tortor pretium viverra suspendisse potenti nullam ac. Sociis natoque penatibus et magnis dis parturient montes nascetur. Elit eget gravida cum sociis natoque penatibus et. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed. Purus viverra accumsan in nisl nisi scelerisque. Adipiscing vitae proin sagittis nisl rhoncus mattis rhoncus urna neque. Risus ultricies tristique nulla aliquet.', 4000000, '{\"Monday\": [\"18:00-20:00\"], \"Friday\":[\"18:00-20:00\"]}', '2021-11-22', '2022-02-21','Basic English for grade 8.jpg'),
('EN0005', 'English course for Grade 9', 'english', 4, 'An online English course for grade 9 students.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Rhoncus aenean vel elit scelerisque. Venenatis a condimentum vitae sapien pellentesque habitant. Egestas fringilla phasellus faucibus scelerisque eleifend donec pretium. Elit at imperdiet dui accumsan sit. Tortor id aliquet lectus proin nibh nisl condimentum. Nibh venenatis cras sed felis eget. Sed enim ut sem viverra. At risus viverra adipiscing at. Velit ut tortor pretium viverra suspendisse potenti nullam ac. Sociis natoque penatibus et magnis dis parturient montes nascetur. Elit eget gravida cum sociis natoque penatibus et. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed. Purus viverra accumsan in nisl nisi scelerisque. Adipiscing vitae proin sagittis nisl rhoncus mattis rhoncus urna neque. Risus ultricies tristique nulla aliquet.', 4000000, '{\"Monday\": [\"18:00-20:00\"], \"Friday\":[\"18:00-20:00\"]}', '2021-11-22', '2022-02-21','English course for Grade 9.jpeg'),
('EN0006', 'English course for Grade 10', 'english', 4, 'An online English course for grade 10 students.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Rhoncus aenean vel elit scelerisque. Venenatis a condimentum vitae sapien pellentesque habitant. Egestas fringilla phasellus faucibus scelerisque eleifend donec pretium. Elit at imperdiet dui accumsan sit. Tortor id aliquet lectus proin nibh nisl condimentum. Nibh venenatis cras sed felis eget. Sed enim ut sem viverra. At risus viverra adipiscing at. Velit ut tortor pretium viverra suspendisse potenti nullam ac. Sociis natoque penatibus et magnis dis parturient montes nascetur. Elit eget gravida cum sociis natoque penatibus et. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed. Purus viverra accumsan in nisl nisi scelerisque. Adipiscing vitae proin sagittis nisl rhoncus mattis rhoncus urna neque. Risus ultricies tristique nulla aliquet.', 4000000, '{\"Monday\": [\"18:00-20:00\"], \"Friday\":[\"18:00-20:00\"]}', '2021-11-22', '2022-02-21','English course for Grade 10.jpg'),
('MA0001', 'Advanced Math for Grade 9', 'math', 2, 'A 3-month Math course for Grade 9 students.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Rhoncus aenean vel elit scelerisque. Venenatis a condimentum vitae sapien pellentesque habitant. Egestas fringilla phasellus faucibus scelerisque eleifend donec pretium. Elit at imperdiet dui accumsan sit. Tortor id aliquet lectus proin nibh nisl condimentum. Nibh venenatis cras sed felis eget. Sed enim ut sem viverra. At risus viverra adipiscing at. Velit ut tortor pretium viverra suspendisse potenti nullam ac. Sociis natoque penatibus et magnis dis parturient montes nascetur. Elit eget gravida cum sociis natoque penatibus et. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed. Purus viverra accumsan in nisl nisi scelerisque. Adipiscing vitae proin sagittis nisl rhoncus mattis rhoncus urna neque. Risus ultricies tristique nulla aliquet.', 6000000, '{\"Monday\": [\"18:00-20:00\"], \"Thursday\":[\"18:00-20:00\"]}', '2021-11-15', '2022-02-14','Advanced Math for Grade 9.jpeg'),
('MA0002', 'Advanced Math for Grade 10', 'math', 2, 'A 3-month Math course for Grade 10 students.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Rhoncus aenean vel elit scelerisque. Venenatis a condimentum vitae sapien pellentesque habitant. Egestas fringilla phasellus faucibus scelerisque eleifend donec pretium. Elit at imperdiet dui accumsan sit. Tortor id aliquet lectus proin nibh nisl condimentum. Nibh venenatis cras sed felis eget. Sed enim ut sem viverra. At risus viverra adipiscing at. Velit ut tortor pretium viverra suspendisse potenti nullam ac. Sociis natoque penatibus et magnis dis parturient montes nascetur. Elit eget gravida cum sociis natoque penatibus et. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed. Purus viverra accumsan in nisl nisi scelerisque. Adipiscing vitae proin sagittis nisl rhoncus mattis rhoncus urna neque. Risus ultricies tristique nulla aliquet.', 6000000, '{\"Monday\": [\"18:00-20:00\"], \"Thursday\":[\"18:00-20:00\"]}', '2021-11-15', '2022-02-14','Advanced Math for Grade 10.jpeg'),
('MA0003', 'Advanced Math for Grade 11', 'math', 2, 'A 3-month Math course for Grade 11 students.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Rhoncus aenean vel elit scelerisque. Venenatis a condimentum vitae sapien pellentesque habitant. Egestas fringilla phasellus faucibus scelerisque eleifend donec pretium. Elit at imperdiet dui accumsan sit. Tortor id aliquet lectus proin nibh nisl condimentum. Nibh venenatis cras sed felis eget. Sed enim ut sem viverra. At risus viverra adipiscing at. Velit ut tortor pretium viverra suspendisse potenti nullam ac. Sociis natoque penatibus et magnis dis parturient montes nascetur. Elit eget gravida cum sociis natoque penatibus et. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed. Purus viverra accumsan in nisl nisi scelerisque. Adipiscing vitae proin sagittis nisl rhoncus mattis rhoncus urna neque. Risus ultricies tristique nulla aliquet.', 6000000, '{\"Monday\": [\"18:00-20:00\"], \"Thursday\":[\"18:00-20:00\"]}', '2021-11-15', '2022-02-14','Advanced Math for Grade 11.png'),
('MA0004', 'Advanced Math for Grade 12', 'math', 2, 'A 3-month Math course for Grade 12 students.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Rhoncus aenean vel elit scelerisque. Venenatis a condimentum vitae sapien pellentesque habitant. Egestas fringilla phasellus faucibus scelerisque eleifend donec pretium. Elit at imperdiet dui accumsan sit. Tortor id aliquet lectus proin nibh nisl condimentum. Nibh venenatis cras sed felis eget. Sed enim ut sem viverra. At risus viverra adipiscing at. Velit ut tortor pretium viverra suspendisse potenti nullam ac. Sociis natoque penatibus et magnis dis parturient montes nascetur. Elit eget gravida cum sociis natoque penatibus et. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed. Purus viverra accumsan in nisl nisi scelerisque. Adipiscing vitae proin sagittis nisl rhoncus mattis rhoncus urna neque. Risus ultricies tristique nulla aliquet.', 6000000, '{\"Monday\": [\"18:00-20:00\"], \"Thursday\":[\"18:00-20:00\"]}', '2021-11-15', '2022-02-14','Advanced Math for Grade 12.jpeg'),
('MA0005', 'Advanced Math for Grade 7', 'math', 2, 'A 3-month Math course for Grade 7 students.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Rhoncus aenean vel elit scelerisque. Venenatis a condimentum vitae sapien pellentesque habitant. Egestas fringilla phasellus faucibus scelerisque eleifend donec pretium. Elit at imperdiet dui accumsan sit. Tortor id aliquet lectus proin nibh nisl condimentum. Nibh venenatis cras sed felis eget. Sed enim ut sem viverra. At risus viverra adipiscing at. Velit ut tortor pretium viverra suspendisse potenti nullam ac. Sociis natoque penatibus et magnis dis parturient montes nascetur. Elit eget gravida cum sociis natoque penatibus et. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed. Purus viverra accumsan in nisl nisi scelerisque. Adipiscing vitae proin sagittis nisl rhoncus mattis rhoncus urna neque. Risus ultricies tristique nulla aliquet.', 6000000, '{\"Monday\": [\"18:00-20:00\"], \"Thursday\":[\"18:00-20:00\"]}', '2021-11-15', '2022-02-14','Advanced Math for Grade 7.png'),
('MA0006', 'Advanced Math for Grade 8', 'math', 2, 'A 3-month Math course for Grade 8 students.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Rhoncus aenean vel elit scelerisque. Venenatis a condimentum vitae sapien pellentesque habitant. Egestas fringilla phasellus faucibus scelerisque eleifend donec pretium. Elit at imperdiet dui accumsan sit. Tortor id aliquet lectus proin nibh nisl condimentum. Nibh venenatis cras sed felis eget. Sed enim ut sem viverra. At risus viverra adipiscing at. Velit ut tortor pretium viverra suspendisse potenti nullam ac. Sociis natoque penatibus et magnis dis parturient montes nascetur. Elit eget gravida cum sociis natoque penatibus et. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed. Purus viverra accumsan in nisl nisi scelerisque. Adipiscing vitae proin sagittis nisl rhoncus mattis rhoncus urna neque. Risus ultricies tristique nulla aliquet.', 6000000, '{\"Monday\": [\"18:00-20:00\"], \"Thursday\":[\"18:00-20:00\"]}', '2021-11-15', '2022-02-14','Advanced Math for Grade 8.jpeg'),
('PH0001', 'Physics crash course for Grade 12', 'physics', 3, 'A 2-month Physics crash course for Grade 12 students who is taking part in the 2022 university entrance test.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Rhoncus aenean vel elit scelerisque. Venenatis a condimentum vitae sapien pellentesque habitant. Egestas fringilla phasellus faucibus scelerisque eleifend donec pretium. Elit at imperdiet dui accumsan sit. Tortor id aliquet lectus proin nibh nisl condimentum. Nibh venenatis cras sed felis eget. Sed enim ut sem viverra. At risus viverra adipiscing at. Velit ut tortor pretium viverra suspendisse potenti nullam ac. Sociis natoque penatibus et magnis dis parturient montes nascetur. Elit eget gravida cum sociis natoque penatibus et. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed. Purus viverra accumsan in nisl nisi scelerisque. Adipiscing vitae proin sagittis nisl rhoncus mattis rhoncus urna neque. Risus ultricies tristique nulla aliquet.', 4000000, '{\"Monday\": [\"18:00-20:00\"], \"Tuesday\":[\"18:00-20:00\"], \"Thursday\":[\"18:00-20:00\"]}', '2021-11-22', '2022-01-24','Physics crash course for Grade 12.jpeg'),
('PH0002', 'Physics crash course for grade 11', 'physics', 3, 'A 2-month Physics crash course for Grade 11 ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Rhoncus aenean vel elit scelerisque. Venenatis a condimentum vitae sapien pellentesque habitant. Egestas fringilla phasellus faucibus scelerisque eleifend donec pretium. Elit at imperdiet dui accumsan sit. Tortor id aliquet lectus proin nibh nisl condimentum. Nibh venenatis cras sed felis eget. Sed enim ut sem viverra. At risus viverra adipiscing at. Velit ut tortor pretium viverra suspendisse potenti nullam ac. Sociis natoque penatibus et magnis dis parturient montes nascetur. Elit eget gravida cum sociis natoque penatibus et. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed. Purus viverra accumsan in nisl nisi scelerisque. Adipiscing vitae proin sagittis nisl rhoncus mattis rhoncus urna neque. Risus ultricies tristique nulla aliquet.', 3900000, '{\"Monday\": [\"18:00-20:00\"], \"Tuesday\":[\"18:00-20:00\"], \"Thursday\":[\"18:00-20:00\"]}', '2021-11-22', '2021-01-04','Physics crash course for grade 11.png'),
('PH0003', 'Physics crash course for grade 10', 'physics', 3, 'A 2-month Physics crash course for Grade 10 ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Rhoncus aenean vel elit scelerisque. Venenatis a condimentum vitae sapien pellentesque habitant. Egestas fringilla phasellus faucibus scelerisque eleifend donec pretium. Elit at imperdiet dui accumsan sit. Tortor id aliquet lectus proin nibh nisl condimentum. Nibh venenatis cras sed felis eget. Sed enim ut sem viverra. At risus viverra adipiscing at. Velit ut tortor pretium viverra suspendisse potenti nullam ac. Sociis natoque penatibus et magnis dis parturient montes nascetur. Elit eget gravida cum sociis natoque penatibus et. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed. Purus viverra accumsan in nisl nisi scelerisque. Adipiscing vitae proin sagittis nisl rhoncus mattis rhoncus urna neque. Risus ultricies tristique nulla aliquet.', 3500000, '{\"Monday\": [\"18:00-20:00\"], \"Tuesday\":[\"18:00-20:00\"], \"Thursday\":[\"18:00-20:00\"]}', '2021-11-22', '2021-01-04','Physics crash course for grade 10.jpeg'),
('PH0004', 'Physics crash course for grade 9', 'physics', 3, 'A 2-month Physics crash course for Grade 9 ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Rhoncus aenean vel elit scelerisque. Venenatis a condimentum vitae sapien pellentesque habitant. Egestas fringilla phasellus faucibus scelerisque eleifend donec pretium. Elit at imperdiet dui accumsan sit. Tortor id aliquet lectus proin nibh nisl condimentum. Nibh venenatis cras sed felis eget. Sed enim ut sem viverra. At risus viverra adipiscing at. Velit ut tortor pretium viverra suspendisse potenti nullam ac. Sociis natoque penatibus et magnis dis parturient montes nascetur. Elit eget gravida cum sociis natoque penatibus et. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed. Purus viverra accumsan in nisl nisi scelerisque. Adipiscing vitae proin sagittis nisl rhoncus mattis rhoncus urna neque. Risus ultricies tristique nulla aliquet.', 3500000, '{\"Monday\": [\"18:00-20:00\"], \"Tuesday\":[\"18:00-20:00\"], \"Thursday\":[\"18:00-20:00\"]}', '2021-11-22', '2021-01-04','Physics crash course for grade 9.jpeg'),
('PH0005', 'ADVANCED physics crash course for  grade 11', 'physics', 3, 'A 2-month Physics crash course for Grade 11 ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Rhoncus aenean vel elit scelerisque. Venenatis a condimentum vitae sapien pellentesque habitant. Egestas fringilla phasellus faucibus scelerisque eleifend donec pretium. Elit at imperdiet dui accumsan sit. Tortor id aliquet lectus proin nibh nisl condimentum. Nibh venenatis cras sed felis eget. Sed enim ut sem viverra. At risus viverra adipiscing at. Velit ut tortor pretium viverra suspendisse potenti nullam ac. Sociis natoque penatibus et magnis dis parturient montes nascetur. Elit eget gravida cum sociis natoque penatibus et. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed. Purus viverra accumsan in nisl nisi scelerisque. Adipiscing vitae proin sagittis nisl rhoncus mattis rhoncus urna neque. Risus ultricies tristique nulla aliquet.', 5000000, '{\"Monday\": [\"20:00-22:00\"], \"Tuesday\":[\"20:00-22:00\"], \"Thursday\":[\"20:00-22:00\"]}', '2021-11-22', '2021-01-04','ADVANCED physics crash course for  grade 11.png'),
('PH0006', 'ADVANCED physics revision test for grade 12', 'physics', 3, 'A 2-month Physics crash course for Grade 12, practice and prepare for graduation test ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Rhoncus aenean vel elit scelerisque. Venenatis a condimentum vitae sapien pellentesque habitant. Egestas fringilla phasellus faucibus scelerisque eleifend donec pretium. Elit at imperdiet dui accumsan sit. Tortor id aliquet lectus proin nibh nisl condimentum. Nibh venenatis cras sed felis eget. Sed enim ut sem viverra. At risus viverra adipiscing at. Velit ut tortor pretium viverra suspendisse potenti nullam ac. Sociis natoque penatibus et magnis dis parturient montes nascetur. Elit eget gravida cum sociis natoque penatibus et. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed. Purus viverra accumsan in nisl nisi scelerisque. Adipiscing vitae proin sagittis nisl rhoncus mattis rhoncus urna neque. Risus ultricies tristique nulla aliquet.', 7000000, '{\"Monday\": [\"20:00-22:00\"], \"Tuesday\":[\"20:00-22:00\"], \"Thursday\":[\"20:00-22:00\"]}', '2021-11-22', '2021-01-04','ADVANCED physics revision test for grade 12.jpeg');
 
INSERT INTO `locations` (`location_id`, `location_name`, `longtitude`, `latitude`, `location_description`) VALUES
(1, 'Nha Trang branch', 109.18676734631, 12.249520736579708, '71 Yersin Street, Nha Trang City'),
(2, 'Head Quarter at Ho Chi Minh City', 106.66068367301231, 10.773922365553329, '268 Ly Thuong Kiet Street, District 10, Ho Chi Minh City'),
(3, 'Can Tho branch', 105.75045605911849, 10.000316093244491, '414 National Road 1A - Area Yen Ha, Le Binh, Cai Rang, Can Tho'),
(4, 'Ha Noi branch', 105.84328620369546, 21.007866621437497, '1 Dai Co Viet Street, Hai Ba Trung, Ha Noi'),
(5, 'Ben Nghe District 1 at Ho Chi Minh city', 106.705588, 10.788112, 'near Vietnam History Museum'),
(6, 'Ca Mau Branch', 104.757911, 8.600316, 'opposite the commune committee Dat Mui, Ca Mau'),
(7, 'Da Nang Branch', 108.226033, 16.047164, 'Green Island Villa');

INSERT INTO `subjects` (`subject_code`, `subject_name`, `num_courses`) VALUES
('BI', 'Biology', 6),
('CH', 'Chemistry', 6),
('EN', 'English', 6),
('MA', 'Math', 6),
('PH', 'Physics', 6);

