<?php
include "connectDB.php";
$sql = 
"
DROP TABLE locations
CREATE TABLE locations ( 
	location_id          int UNSIGNED NOT NULL    PRIMARY KEY,
	location_name        varchar(500)  NOT NULL    ,
	longtitude           double  NOT NULL    ,
	latitude             double  NOT NULL    ,
	location_description varchar(500)  NOT NULL    ,
	CONSTRAINT unq_locations_longlat UNIQUE ( longtitude, latitude ) 
) engine=InnoDB;
";
$conn->query($sql);
$sql = "TRUNCATE TABLE locations";
$conn->query($sql);
$sql = 
"
INSERT INTO locations (location_id, location_name, latitude, longtitude, location_description)
VALUES
	(1, 'Nha Trang', 12.249520736579708, 109.18676734631, '71 Yersin Street, Nha Trang City'),
	(2, 'Ho Chi Minh City', 10.773922365553329, 106.66068367301231, '268 Ly Thuong Kiet Street, District 10, Ho Chi Minh City'),
	(3, 'Can Tho', 10.000316093244491, 105.75045605911849, '414 National Road 1A - Area Yen Ha, Le Binh, Cai Rang, Can Tho'),
	(4, 'Ha Noi', 21.007866621437497, 105.84328620369546, '1 Dai Co Viet Street, Hai Ba Trung, Ha Noi');
";
$conn->query($sql);