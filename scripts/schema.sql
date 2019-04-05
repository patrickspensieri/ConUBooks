-- disable foreign key checks to delete tables in any order
SET FOREIGN_KEY_CHECKS = 0;
-- drop tables
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
drop table if exists address;
drop table if exists entity;
-- drop procedures
drop procedure if exists insertAuthor;
SET FOREIGN_KEY_CHECKS = 1;

create table entity(
    entityID integer auto_increment primary key
);

create table address(
    entityID integer primary key,
    civicNumber varchar(50) not null,
    city varchar(50) not null,
    province varchar(20) not null,
    postalCode varchar(6) not null,
    foreign key (entityID) references entity(entityID)
);

-- employee using entity and address
-- TODO make use of address table
create table employee(
    employeeID integer auto_increment primary key,
    ssn integer(9) unique not null,
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
    name varchar(50) not null
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
    foreign key (employeeID) references employee(employeeID),
    foreign key (publisherID) references publisher(publisherID)
);

create table publisherShipment(
    publisherOrderID integer primary key,
    employeeID integer,
    trackingNumber varchar(50),
    dateReceived datetime,
    foreign key (employeeID) references employee(employeeID),
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
    foreign key (customerID) references customer(customerID),
    foreign key (employeeID) references employee(employeeID)
);

create table customerShipment(
    customerOrderID integer primary key,
    employeeID integer,
    trackingNumber varchar(50),
    dateReceived datetime,
    foreign key (employeeID) references employee(employeeID),
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

-- set the delimeter
DELIMITER //
-- insertEmployee
CREATE PROCEDURE insertEmployee(
    IN ssn integer(9),
    IN name varchar(50),
    IN phone varchar(11),
    IN address varchar(100),
    IN email varchar(100))
BEGIN
  INSERT INTO entity VALUES();
  INSERT INTO author VALUES(LAST_INSERT_ID(), ssn, name, phone, address, email);
END //
-- insertCustomer
CREATE PROCEDURE insertCustomer(
    IN name varchar(50),
    IN phone varchar(11),
    IN address varchar(100),
    IN email varchar(100))
BEGIN
  INSERT INTO entity VALUES();
  INSERT INTO author VALUES(LAST_INSERT_ID(), name, phone, address, email);
END //
-- insertPublisher
CREATE PROCEDURE insertPublisher(
    IN name varchar(50),
    IN phone varchar(11),
    IN address varchar(100),
    IN email varchar(100))
BEGIN
  INSERT INTO entity VALUES();
  INSERT INTO author VALUES(LAST_INSERT_ID(), name, phone, address, email);
END //
-- insertBranch
CREATE PROCEDURE insertBranch(
    IN publisherID integer,
    IN phone varchar(11),
    IN address varchar(100),
    IN email varchar(100),
    IN branchManager varchar(50))
BEGIN
  INSERT INTO entity VALUES();
  INSERT INTO author VALUES(LAST_INSERT_ID(), publisherID, name, phone, address, email, branchManager);
END //



-- set delimeter back to ;
DELIMITER ;