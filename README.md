Fishing Boat
============

## Installation

There are three options:

### Docker
On a shell simply run the command "make install".  
The Makefile will pull the images and build the project.  
Then visit http://localhost:8080

### Vagrant
Run "vagrant up".  
When the machine boots run "vagrant ssh".  
Change directory to "/var/www" and run "composer install".   
Visit the virtual machine's ip in the web browser to run the application.  

### Old Fashioned
Clone the project into any machine with php and apache installed.  
Run composer install.  
Visit the document root of wherever this project lives.

## Note
Validation has been oversimplified. Working with any input and defaulting
to some sensible values when they are empty.