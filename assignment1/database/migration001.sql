create database new_co;
use new_co;

create table users (
   id int auto_increment not null primary key,
   password_digest varchar(255),
   email varchar(255) not null unique,
   name varchar(255) not null
);

create table courses (
   id int auto_increment not null primary key,
   title varchar(255) not null,
   is_completed boolean not null default 0,
   author_id int not null,
   foreign key (author_id) references users (id)
);
