First thing that done to start the project. Created a database with 2 tables. 
In first table I stored project name, how many groups will be and how many students per group.
Second table stores student name and witch group they are assigned.
Created php file with connection to db. 
On firt visit if project is not created. Redirects to create_project.php to create a project adding 
project name, number of groupr and students per group, and it`s stored in db, and if project is created 
redirects to index page. 
Then made a add new student function, add a student to a list, and it`s stored in db, a delete option, to delete 
the student from db, at database I made that only unic students names can be stored. 
After students is deleted, removes the student from group, and student list. 
