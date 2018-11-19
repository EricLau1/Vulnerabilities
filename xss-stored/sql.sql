create database pentest;

create table if not exists user(
id int auto_increment primary key,
name varchar(50),
email varchar(50),
password varchar(100),
created_at timestamp default current_timestamp())
default charset = utf8;

/* senha -> @admin */
insert into user (name, email, password) values ('admin', 'admin@email.com', '$2y$10$1Fu.gAiA8ssPq.MtSgaLYefvew/HeLJn2wP23oXUdmIMHdKWSz8LO');

create table if not exists admin(
user int not null,
status char(1) default '0',
last_login timestamp default current_timestamp(),
constraint admin_user_fk foreign key(user) references user(id))
default charset = utf8;

insert into admin (user, status) values (1, '1');

create table if not exists feedback(
id int auto_increment primary key,
user int not null,
comment varchar(255),
created_at timestamp default current_timestamp(),
constraint feedback_user_fk foreign key(user) references user(id))
default charset = utf8;
