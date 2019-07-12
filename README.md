# CREWMAN

## The HR Department in OSM Aviation must be able to handle all employees using
## a web application called CREWMAN. You are tasked with partly developing this
## application. HR should be able to have a clear picture on which employees are
## hired by which employers and within which timeframe.

### Below are a set of statements that reflects how the CREWMAN application shall work:
### • An employee is a person with a first name, last name and identification
### number in the format OSMA[5-digit integer].
• An employee can only have one current employment but may have multiple
future and/or past employments.
• If an employee has no employment, he/she is inactive.
• An employment may have none, one, or multiple assignments, past, current
and/or future.
### • An assignment is given by an employer.
• An assignment is located in one or more countries.
• While on an assignment, the employee has several roles.
• Each role has a start-date and end-date.
• Each role has one of two types: Qualification or Position.
• While on an assignment, the employee may have one or more leaves.
• Each leave has a start-date and end-date.

### 1. Based on the information provided, create an ER-diagram of the database.
### 2. In an empty Laravel application, implement the following:
a. The models corresponding to the entities you modelled in task 1.
b. A page which lists all employees (first name, last name, id-number) and
their most recent employer.
### c. A page which details a given employee’s employment-profile, showing
### his/her past, present & future employments and associated
### assignments (with roles and leaves).
d. Brand the application iaw. the visual profile on www.osmaviation.com.

### You are free to use whichever front-end tools and libraries you want to but remember;
### we prefer Vue.js.
