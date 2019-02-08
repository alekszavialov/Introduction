# Easy chat

Simple chat

### Requirements

* Web Server (XAMMP, MAMP, DENWER)
* Apache 2.4.35.0 and up
* MySQL 10.1.36-MariaDB
* PHP 7 and up
* GIT

## Installation

```
Enable AllowOverried All in Apache
Extract files from Introduction\WD_PS6 to your domain root directory.
Create new database in MySQL with utf8mb4_general_ci encode.
Import database chatdb.sql from Introduction to your MySQL.
Set database name, user and password settings in Introduction\WD_PS6\config\configDB.php file.
```

`$ git clone https://github.com/alekszavialov/Introduction.git`

## Usage

```
Run your webserver.
Go to (http://{yourdomain}/)

Login
Enter your name and password in login form. Push submit button. If you new user - application will register you.

Chat
Enter your message in field near send button. After press send button to send your message.
Applicaion load message automatically.
```
