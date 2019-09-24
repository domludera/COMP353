# COMP 353 Assignment P1

## Technologies:
 - PHP 7.2
 - MySQL 5.7

## Instructions:
 - Create database, prior to run the code
 - Modify config.ini to match your credentials and database name
 - `./run.sh`
 
## Notes:
 - Typo in csv document corrected on line 44 (deleted additional "|")
 - to test the database you can use p1_examples_query.txt
 
 To view all information for each table
 `SELECT * FROM Invitees;`
 `SELECT * FROM Events;`
 `SELECT * FROM Attendances;`
 
 To list the names of the administrators of Events with the given event names
 `SELECT i.firstname, i.lastname, e.event FROM Invitees i, Events e  where i.userId = e.adminUserId;`
 
 ex.	
 	Sandra 		Deamo	C3S2E10
 
 To list the Events names that have people attending it
 SELECT e.event FROM Events e, Attendances a  where e.eventId = a.eventId;
 
 ex.	
 	C3S2E10
 	
 To list the event names and their Invitees names
 `SELECT e.event, i.firstname, i.lastname FROM Events e, Invitees i, Attendances a  where e.eventId = a.eventId and i.userId = a.inviteeId;`
 
 ex.
 	C3S2E10		Theo	Harder
 
 To list which Invitees are going to which Events with start and end date details 
 `SELECT i.firstname, i.lastname, e.event, e.start_date, e.end_date FROM Invitees i, Attendances a , Events e where i.userId = a.inviteeId and a.eventId = e.eventId;`
 
 ex. 
 	Theo	Harder		C3S2E10		2009-10-19		2010-05-21
 	
 To see if an invitee is attending an event
 `SELECT i.firstname, i.lastname FROM Invitees i, Attendances a  where i.userId = a.inviteeId;`

