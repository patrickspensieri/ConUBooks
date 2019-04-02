## ConUBooks - Report
#### COMP353 - N. Shiri
#### Monday, April 8th 2019

spc353_4@encs.concordia.ca

| Name                  | ID        |
|---                    |---        |
| Andre Marques Manata  | 27148224  |
|Pablo Gonzalez         | 40003141  |
|Philippe Li            | 40005018  |
|Patrick Spensieri      | 40006417  |

---

### TODO
- tackle the address problem

### ER Diagram
The following assumptions were made
- A single shipment fulfills a customer or publisher order.
- Publisher orders are sent to the publisher, who will then delegate to one of their branches.
- While certain fields like *social insurance number* could have been used as a primary key, people's social insurance numbers may change, and some employees may not have one. Thus, a generated identifier that will not change makes for a better primary key.

![ER Diagram](images/ERDiagram.png)

### Functional Dependencies
```
employee(employeeID, ssn, name, phone, address, email)
    employeeID -> ssn, name, phone, address, email

customer(customerID, name, phone, address, email)
    customerID -> name, phone, address, email

author(authorID, name, phone, address, email)
    authorID -> name, phone, address, email

book(isbn, title, price, edition, quantity)
    isbn -> title, price, edition, quantity

publisher(publisherID, name, phone, address, email)
    publisherID -> name, phone, address, email

branch(branchID, publisherID, name, phone, address, email, branchManager)
    branchID -> name, phone, address, email, branchManager

publisherOrder(publisherOrderID, employeeID, publisherID, datePlaced, dateDue, dateReceived)
    publisherOrderID -> employeeID, publisherID, datePlaced, dateDue, dateReceived

publisherShipment(publisherOrderID, trackingNumber)
    publisherOrderID -> trackingNumber

author_book(authorID, isbn)
    none

book_publisher(isbn, publisherID)
    isbn -> publisherID

publisherOrder_book(publisherOrderID, isbn, quantity)
    none

sale(saleID, totalPrice, customerID, employeeID, date)
    saleID -> totalPrice, customerID, employeeID, date

sale_book(saleID, isbn, quantity, pricePerBook)
    // pricePerBook can change depending on when the sale is made
    none

customerOrder(customerOrderID, customerID, employeeID, datePlaced, dateReceived)
    customerOrderID -> customerID, employeeID, datePlaced, dateReceived

customerShipment(customerOrderID, trackingNumber)
    customerOrderID -> trackingNumber

customerOrder_book(customerOrderID, isbn, quantity)
    none
```

### Relational Database Schema
The following scripts build, populate and query the database. To run any of the scripts, establish a connection and run `source /path/to/script.sql`.

#### Schema script
The [schema.sql](https://github.com/patrickspensieri/ConUBooks/blob/master/scipts/schema.sql) script defines the schema for the database.
```SQL
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
```

#### Data script
The [data.sql](https://github.com/patrickspensieri/ConUBooks/blob/master/scipts/data.sql) script populates the tables.
```SQL
-- employee
insert into employee values (1, 123456789, 'Andre', '14381111111', '234 Random Road', 'andre@conubooks.com');
insert into employee values (2, 987652431, 'Philippe', '14382222222', '90 Some Place', 'philippe@conubooks.com');
-- customer
insert into customer values (1, 'Pablo', '15141111111', '341 Roach Road', 'pablo@yahoo.com');
insert into customer values (2, 'Patrick', '15142222222', '18 12th Avenue', 'patrick@mail.com');
-- author
insert into author values (1, 'George Orwell', null, null, null);
insert into author values (2, 'H. G. Wells', null, null, null);
insert into author values (3, 'Daniela Isac', null, null, null);
insert into author values (4, 'Charles Reiss', null, null, null);
-- book
insert into book values ('9780141393049', 'Nineteen Eighty-Four', 19.84, 1, 10);
insert into book values ('9780146000733', 'The Time Machine', 12.50, 1, 5);
insert into book values ('9780199660179', 'I-Language: An Introduction to Linguistics as Cognitive Science', 120.45, 2, 0);
-- publisher
insert into publisher values (1, 'Penguin Random House', '18007333000', '320 Front St W', 'orders@randomhouse.com');
insert into publisher values (2, 'Oxford University Press', '18002800280', '8 Sampson Mews', 'contact@oxfordpress.com');
-- branch
insert into branch values (13, 1, 'Penguin Random House Toronto', '14169972330', '33 Pine Avenue', 'toronto_orders@randomhouse.com', 'Tom Yates');
-- publisherOrder
insert into publisherOrder values (1, 1, 1, '2019-01-01', '2019-01-14', '2019-01-15');
insert into publisherOrder values (2, 1, 2, current_timestamp() - interval 20 day, current_timestamp() - interval 1 day, null);
-- publisherShipment
insert into publisherShipment values (1, 'AA 9934 4033 AF');
insert into publisherShipment values (2, null);
-- author_book
insert into author_book values (1, '9780141393049');
insert into author_book values (2, '9780146000733');
insert into author_book values (3, '9780199660179');
insert into author_book values (4, '9780199660179');
-- book_publisher
insert into book_publisher values ('9780141393049', 1);
insert into book_publisher values ('9780146000733', 1);
insert into book_publisher values ('9780199660179', 2);
-- pulisherOrder_book
insert into publisherOrder_book values (1, '9780141393049', 10);
insert into publisherOrder_book values (2, '9780199660179', 4);
-- sale
insert into sale values (1, 32.34, 1, 2, '2019-03-31 11:04:59');
-- sale_book
insert into sale_book values (1, '9780141393049', 1, 19.84);
insert into sale_book values (1, '9780146000733', 1, 12.50);
-- customerOrder
insert into customerOrder values (1, 2, 1, current_timestamp(), null);
-- customerShipment
insert into customerShipment values (1, '2349 3340 0942 3334');
-- customerOrder_book
insert into customerOrder_book values (1, '9780199660179', 1);
```

#### Queries script
The [queries.sql](https://github.com/patrickspensieri/ConUBooks/blob/master/scipts/queries.sql) script runs the five queries detailed in the handout.
```SQL
-- a. Get detail of all books in the Bookstore.
select *
from book;
-- b. Get detail of all books that are back order.
select b.*
from publisherOrder p1 join publisherOrder_book p2 join book b
where dateReceived is null and p1.publisherOrderId = p2.publisherOrderID and b.isbn = p2.isbn;
-- c. Get detail of all the special orders for a given customer.
select c.*, cb.isbn, cb.quantity, b.title
from customerOrder c
inner join customerOrder_book cb on cb.customerOrderID = c.customerOrderID
inner join book b on cb.isbn = b.isbn
where c.customerID = 2;
-- d. Get detail of all purchases made by a given customer.
select s.*, sb.isbn, sb.quantity, sb.pricePerBook, b.title
from sale s
inner join sale_book sb on sb.saleID = s.saleID
inner join book b on sb.isbn = b.isbn
where s.customerID = 1;
-- e. Get detail of all the sales made by a given employee on a specific date.
select s.*, sb.isbn, b.title
from sale s
inner join sale_book sb on sb.saleID = s.saleID
inner join book b on sb.isbn = b.isbn
where s.employeeID = 2 and s.date between '2019-03-31' and '2019-03-31 23:59:59';
-- f. Get details of all purchases made. For each customer, return the total amount paid for the books ordered since the beginning of the year.
select s1.*, sum(s2.totalPrice) as 'total customer sales in 2019'
from sale s1
inner join sale s2 on s1.customerID = s2.customerID
where s1.date between '2019-01-01' and '2019-12-31'
and s2.date between '2019-01-01' and '2019-12-31';
-- g. List every book ordered but not received within the period set has passed.
select b.title, pb.isbn, pb.quantity, p.dateDue, p.dateReceived
from publisherOrder p
inner join publisherOrder_book pb on p.publisherOrderID = pb.publisherOrderID
inner join book b on pb.isbn = b.isbn
where p.dateReceived > p.dateDue
or (p.dateReceived is null and current_timestamp() > p.dateDue);
```

#### TODO output of queries.sql
