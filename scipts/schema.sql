-- disable foreign key checks to delete tables in any order
SET FOREIGN_KEY_CHECKS = 0;
drop table if exists customerOrder_book;
drop table if exists author_book;
drop table if exists book_publisher;
drop table if exists publisherOrder_book;
drop table if exists sale_book;
drop table if exists branch;
drop table if exists publisherShipment;
drop table if exists customerShipment;
drop table if exists publisherOrder;
drop table if exists customerOrder;
drop table if exists sale;
drop table if exists employee;
drop table if exists customer;
drop table if exists author;
drop table if exists book;
drop table if exists publisher;
SET FOREIGN_KEY_CHECKS = 1;

create table employee(
    employeeID integer auto_increment primary key,
    ssn integer(9) not null,
    name varchar(50) not null,
    phone varchar(11) not null,
    address varchar(100) not null,
    email varchar(100)
);

create table customer(
    customerID integer auto_increment primary key,
    name varchar(50) not null,
    phone varchar(11),
    address varchar(100) not null,
    email varchar(100)
);

create table author(
    authorID integer auto_increment primary key,
    name varchar(50) not null,
    phone varchar(11),
    address varchar(100),
    email varchar(100)
);

create table book(
    isbn char(13) primary key,
    title varchar(100) not null,
    price decimal(19,4) not null,
    edition smallint not null,
    quantity smallint not null
);

create table publisher(
    publisherID integer auto_increment primary key,
    name varchar(50) not null,
    phone varchar(11),
    address varchar(100) not null,
    email varchar(100)
);

create table branch(
    branchID integer not null,
    publisherID integer not null,
    name varchar(50) not null,
    phone varchar(11),
    address varchar(100) not null,
    email varchar(100),
    branchManager varchar(50) not null,
    primary key (branchID, publisherID),
    foreign key (publisherID) references publisher(publisherID)
);

create table publisherOrder(
    publisherOrderID integer auto_increment primary key,
    employeeID integer not null,
    publisherID integer not null,
    datePlaced datetime default current_timestamp() not null,
    dateDue datetime not null,
    dateReceived datetime,
    foreign key (employeeID) references employee(employeeID),
    foreign key (publisherID) references publisher(publisherID)
);

create table publisherShipment(
    publisherOrderID integer primary key,
    trackingNumber varchar(50),
    foreign key (publisherOrderID) references publisherOrder(publisherOrderID)
);

create table author_book(
    authorID integer not null,
    isbn char(13) not null,
    primary key (authorID, isbn),
    foreign key (authorID) references author(authorID),
    foreign key (isbn) references book(isbn)
);

create table book_publisher(
    isbn char(13) primary key,
    publisherID integer not null,
    foreign key (isbn) references book(isbn),
    foreign key (publisherID) references publisher(publisherID)
);

create table publisherOrder_book(
    publisherOrderID integer not null,
    isbn char(13) not null,
    quantity smallint default 1 not null,
    primary key (publisherOrderID, isbn),
    foreign key (publisherOrderID) references publisherOrder(publisherOrderID),
    foreign key (isbn) references book(isbn)
);

create table sale(
    saleID integer auto_increment primary key,
    totalPrice decimal(19,4) not null,
    customerID integer not null,
    employeeID integer not null,
    date datetime not null,
    foreign key (customerID) references customer(customerID),
    foreign key (employeeID) references employee(employeeID)
);

create table sale_book(
    saleID integer not null,
    isbn char(13) not null,
    quantity smallint default 1 not null,
    pricePerBook decimal(19,4) not null,
    primary key (saleID, isbn),
    foreign key (saleID) references sale(saleID),
    foreign key (isbn) references book(isbn)
);

create table customerOrder(
    customerOrderID integer auto_increment primary key,
    customerID integer not null,
    employeeID integer not null,
    datePlaced datetime default current_timestamp() not null,
    dateReceived datetime,
    foreign key (customerID) references customer(customerID),
    foreign key (employeeID) references employee(employeeID)
);

create table customerShipment(
    customerOrderID integer primary key,
    trackingNumber varchar(50),
    foreign key (customerOrderID) references customerOrder(customerOrderID)
);

create table customerOrder_book(
    customerOrderID integer not null,
    isbn char(13) not null,
    quantity smallint not null,
    primary key (customerOrderID, isbn),
    foreign key (customerOrderID) references customerOrder(customerOrderID),
    foreign key (isbn) references book(isbn)
);