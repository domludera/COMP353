CREATE TABLE Student (
	sid int,
	sname VARCHAR(255),
	email VARCHAR(255),
	PRIMARY KEY (sid)
);

CREATE TABLE Enrollment (
	sid int,
	cid VARCHAR(255),
	grade VARCHAR(255)
);

CREATE TABLE Course ( 
	cid VARCHAR(255),
	cname VARCHAR(255),
	year int,
       	term VARCHAR(255),
       	section VARCHAR(255), 
	credits int,
	PRIMARY KEY (cid)
);

CREATE TABLE Teach (
	cid VARCHAR(255), 
	ProfName VARCHAR(255)

);

LOAD DATA INFILE '/root/Projects/RA/COMP353/Assg2/sql/tables/student.txt'
INTO TABLE Student
FIELDS TERMINATED BY '|';


LOAD DATA INFILE '/root/Projects/RA/COMP353/Assg2/sql/tables/enrollment.txt'
INTO TABLE Enrollment
FIELDS TERMINATED BY '|';

LOAD DATA INFILE '/root/Projects/RA/COMP353/Assg2/sql/tables/course.txt'
INTO TABLE Course
FIELDS TERMINATED BY '|';

LOAD DATA INFILE '/root/Projects/RA/COMP353/Assg2/sql/tables/teach.txt'
INTO TABLE Teach
FIELDS TERMINATED BY '|';
