# System Seed
This is a seed of a system for developers to begin their work with. This will include a login system and backend for developers.

This isn't a CMS project. Sometimes I receive requests from clients to build a website in PHP and MySQL. For me, I prefer to build with WordPress. However some clients don't like to use a CMS. So I need to build the site from scratch. I don't like to reinvent the wheel every time I begin to build a website from scratch so I thought that a system like this will be useful.

## Installation
You can use it by copying it to your server and create a new database. Then you will have to open the [www.example.com/core/init.php](http://www.example.com/core/init.php) page and add your database information. After you do that run the [www.example.com/install.php](http://www.example.com/install.php) page. If you open this page in your browser, it will create the required tables in the database and add some records to some of these tables. Check the [database section](https://github.com/DevelopSmith/System-Seed#Database) for more details.


## Database
When you install the system using the `install.php` page it creates 3 table: `users`, `groups` and `users_sessions`. Then it fills the `groups` table with some basic data:

| id | name          |          permissions        |
| :--| :-----------: | --------------------------: |
| 1  | Adminstrator  | {"admin": 1,"moderator": 1} |
| 2  | Moderator     | {"admin": 0,"moderator": 1} |
| 3  | Standard      | {"admin": 0,"moderator": 0} |
