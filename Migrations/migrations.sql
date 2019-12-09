/*
 Create the database & use it
*/
DROP SCHEMA IF EXISTS trc353_2;
CREATE SCHEMA trc353_2;
USE trc353_2;

/*
 User
*/

-- Lookups
CREATE TABLE interests
(
    id   int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name CHAR(255)
);

-- Models
CREATE TABLE users
(
    id         int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    email      CHAR(255) NOT NULL,
    password   CHAR(255),
    name       CHAR(255),
    dob        DATE,
    region     CHAR(255),
    profession CHAR(255),
	image	   VARCHAR(255) DEFAULT NULL,
    created_at Date,
    updated_at Date,
	
	CHECK (dob <= CURDATE())
);
CREATE TABLE privileges
(
    id         int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name       CHAR(255)
);

-- Many-to-Manys
CREATE TABLE user_interest
(
    id          int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id     int,
    interest_id int,

    -- fkeys
    FOREIGN KEY (user_id) REFERENCES users (id),
    FOREIGN KEY (interest_id) REFERENCES interests (id)
);

CREATE TABLE user_privilege
(
    id          int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id     int,
    privilege_id int,

    -- fkeys
    FOREIGN KEY (user_id) REFERENCES users (id),
    FOREIGN KEY (privilege_id) REFERENCES privileges (id)
);

/*
 Event
*/

-- Lookups
CREATE TABLE event_types
(
    id   int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name CHAR(255)
);

-- Models
CREATE TABLE events
(
    id            int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name          CHAR(255),
    event_type_id int,
    start_at      Date,
    end_at        Date,
    reoccuring    Bool,
    manager_id    int,

    FOREIGN KEY (event_type_id) REFERENCES event_types (id),
    FOREIGN KEY (manager_id) REFERENCES users (id),
	
	CHECK (start_at <= end_at),
	CHECK (start_at >= CURDATE())

);

-- Many-to-Manys
CREATE TABLE user_attending
(
    id       int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id  int NOT NULL,
    event_id int NOT NULL,

    -- fkeys
    FOREIGN KEY (user_id) REFERENCES users (id),
    FOREIGN KEY (event_id) REFERENCES events (id)
);

/*
 Groups
*/

-- Lookups
-- Models
CREATE TABLE app_groups
(
    id       int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name     CHAR(255),
    owner_id int,
    FOREIGN KEY (owner_id) REFERENCES users (id)
);

-- Many-to-Manys
CREATE TABLE user_group
(
    id       int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id  int,
    group_id int,

    -- fkeys
    FOREIGN KEY (user_id) REFERENCES users (id),
    FOREIGN KEY (group_id) REFERENCES app_groups (id)
);

CREATE TABLE event_group
(
    id       int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    event_id  int,
    group_id int,

    -- fkeys
    FOREIGN KEY (event_id) REFERENCES events (id),
    FOREIGN KEY (group_id) REFERENCES app_groups (id)
);

CREATE TABLE group_request
(
    id       int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id  int,
    group_id int,

    -- fkeys
    FOREIGN KEY (user_id) REFERENCES users (id),
    FOREIGN KEY (group_id) REFERENCES app_groups (id)
);

/*
 Messages
*/

-- Lookups
-- Models
CREATE TABLE messages
(
    id       int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    group_id int,
    user_id  int,
    FOREIGN KEY (user_id) REFERENCES users (id),
    FOREIGN KEY (group_id) REFERENCES app_groups (id)
);
-- Many-to-Manys

/*
 Posts / comments
*/

-- Lookups
-- Models
CREATE TABLE posts
(
    id       int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    content  LONGTEXT,
    event_id int,
    user_id  int,
    created_at DATETIME,
    updated_at DATETIME,

    FOREIGN KEY (user_id) REFERENCES users (id),
    FOREIGN KEY (event_id) REFERENCES events (id)
);

CREATE TABLE comments
(
    id      int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    content LONGTEXT,
    post_id int,
    user_id int,
    created_at DATETIME,
    updated_at DATETIME,
    FOREIGN KEY (user_id) REFERENCES users (id),
    FOREIGN KEY (post_id) REFERENCES posts (id)
);
-- Many-to-Manys

/*
 Mail
*/

-- Lookups
-- Models
CREATE TABLE mails
(
    id           int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    content      CHAR(255),
    subject      CHAR(255),
    to_user_id   int,
    from_user_id int,
    FOREIGN KEY (to_user_id) REFERENCES users (id),
    FOREIGN KEY (from_user_id) REFERENCES users (id)
);
-- Many-to-Manys

CREATE TABLE event_resources
(
    id       int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    event_id int,
    resource_id  int,
    rate float,
    start_at Date,
    end_at Date,

    -- fkeys
    FOREIGN KEY (event_id) REFERENCES events (id),
    FOREIGN KEY (resource_id) REFERENCES resources (id)
);

CREATE TABLE billed_event_resources
(
    id       			int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    bill_id 			int,
    event_resources_id  int,
   
    -- fkeys
    FOREIGN KEY (bill_id) REFERENCES bill (id),
    FOREIGN KEY (event_resources_id) REFERENCES event_resources (id)
);

/*
Billing
*/
-- Lookups
CREATE TABLE resources
(
    id   int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name CHAR(255),
    data CHAR(255),
    rate float
);

-- Models
CREATE TABLE bill
(
    id            	int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    event_id 		int,
    total      		float
);


/*------------------ Sample Section -----------------------*/
/*
 Section
*/

-- Lookups
-- Models
-- Many-to-Manys


delimiter //
CREATE TRIGGER attending_archived
	BEFORE INSERT
	ON user_attending
	FOR EACH ROW
BEGIN
DECLARE event_end_date DATE;

SELECT end_at
	INTO event_end_date
	FROM events
	WHERE events.id = NEW.event_id;
	
	IF CURDATE() > event_end_date
	THEN
		SET NEW.event_id = NULL;
	END IF;
END//

CREATE TRIGGER emails_unique
	BEFORE INSERT
	ON users
	FOR EACH ROW
BEGIN
	IF EXISTS(SELECT * FROM users WHERE users.email = NEW.email)
	THEN
		SET NEW.email = NULL;
	END IF;
END//

delimiter ;
