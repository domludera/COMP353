/*
COMP 353-F
Instructor: Bipin C. Desai
Project 1
COMP 353_group_22:
Zachary LAPOINTE, 27518536
Dominik LUDERA, 40062500
Hugo JONCOUR, 40139230
Erik SMITH, 40002747
Priscilla COURNOYER, 27710690
*/

CREATE TABLE Invitees
(
    userId      INT NOT NULL PRIMARY KEY,
    firstname   varchar(255),
    middle_name varchar(255) NULL,
    lastname    varchar(255),
    password    varchar(255)
);

CREATE TABLE Events
(
    eventId     INT NOT NULL PRIMARY KEY,
    start_date  DATE,
    end_date    DATE DEFAULT NULL,
    adminUserId INT,
    Event       varchar(255)
    #CONSTRAINT fk_adminUserId
    #FOREIGN KEY (adminUserId) REFERENCES Invitees (userId)
);

CREATE TABLE Attendances
(
    inviteeId INT NOT NULL,
    CONSTRAINT fk_inviteeId
        FOREIGN KEY (inviteeId) REFERENCES Invitees (userId),

    eventId   INT NOT NULL,
    CONSTRAINT fk_eventId
        FOREIGN KEY (eventId) REFERENCES Events (eventId)
);


