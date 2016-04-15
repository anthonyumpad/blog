# Blog

This is a blog application that is using 2 databases, MySQL and MongoDB. This has two different interfaces -- the admin
and the public interface. The admin interface allows the blog admin to add, edit, delete, preview, publish and unpublish his post.
It also allows the admin to add different blog categories. The public interface is the blog page for public viewing of the admin's posts.

## Pre-requisites

Please make sure you have installed the following:

- PHP 5.5.9 and above
- MySQL 5.6 and above
- Memcached (or change the session to use file)
- MongoDB 3.2
- Bower

## Installation

1. Pull this code to your local setup.
2. Setup nginx, there's an included nginx config with self-signed certs at ./deploy/root/local
3. Run `composer install`
4. Run `bower install`
5. Setup the MySQL db, add your preferred database name and update the .env file.
6. Run the migrations.
7. Run the seeders. (You can add or remove sandbox account by editing the seeder file)
8. Done.

## Main Routes

- The home url is the admin login page e.g. _www.testblog.local_.
- The public url has is the  home url + the _{username}_ url segment.


