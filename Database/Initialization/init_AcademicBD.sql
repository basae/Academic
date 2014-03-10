create database academicanswers
go

use academicanswers

go


create table subscriber(
id int identity not null primary key,
username varchar (50) unique,
pass varchar(50),
firstname varchar(50),
lastname varchar(50),
email varchar(50),
school varchar(200),
regDate datetime
)

go

create table loginuser(
userid int unique,
token varchar(50),
lastlogin datetime,
foreign key (userid) references subscriber
)

go

create table groupanswer(
id int identity not null primary key,
subscriberId int,
topic varchar(100),
creationDate datetime,
foreign key (subscriberId) references subscriber
)

go

create table answer(
id int not null identity primary key,
groupId int,
answer varchar(500) not null,
r1 varchar(300),
r2 varchar(300),
r3 varchar(300),
r4 varchar(300),
correctasnwer varchar(300) not null,
TypeAnswer varchar(50),
points decimal
foreign key (groupId) references groupanswer
)

go


