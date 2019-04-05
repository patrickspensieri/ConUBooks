-- employee
call insertEmployee(123456789, 'Andre', '14381111111', 'andre@conubooks.com');
insert into address values (1, '1900  Lynden Road', 'Montreal', 'QC', 'L0B 1M0');
call insertEmployee(987652431, 'Philippe', '14382222222', 'philippe@conubooks.com');
insert into address values (2, '939  Nelson Street', 'Montreal', 'QC', 'P0T 2Y0');
-- customer
call insertCustomer('Pablo', '15141111111', 'pablo@yahoo.com');
insert into address values (3, '2774  Roach Road', 'Montreal', 'QC', 'N6E 1A9');
call insertCustomer('Patrick', '15142222222', 'patrick@mail.com');
insert into address values (4, '1248  rue des Champs', 'Montreal', 'QC', 'G7H 4N3');
-- publisher
call insertPublisher('Penguin Random House', '18007333000', 'orders@randomhouse.com');
insert into address values (5, '320  Front St W', 'Toronto', 'ON', 'G7H 4N3');
call insertPublisher('Oxford University Press', '18002800280', 'contact@oxfordpress.com');
insert into address values (6, '8  Sampson Mews', 'Toronto', 'ON', 'G7L 5L9');
-- branch
call insertBranch(5, 'Penguin Random House Toronto', '14169972330', 'toronto_orders@randomhouse.com', 'Tom Yates');
-- author
insert into author values (1, 'George Orwell');
insert into author values (2, 'H. G. Wells');
insert into author values (3, 'Daniela Isac');
insert into author values (4, 'Charles Reiss');
-- book
insert into book values ('9780141393049', 'Nineteen Eighty-Four', 19.84, 1, 10);
insert into book values ('9780146000733', 'The Time Machine', 12.50, 1, 5);
insert into book values ('9780199660179', 'I-Language: An Introduction to Linguistics as Cognitive Science', 120.45, 2, 0);
-- publisherOrder
insert into publisherOrder values (1, 1, 5, '2019-01-01', '2019-01-14');
insert into publisherOrder values (2, 1, 6, current_timestamp() - interval 20 day, current_timestamp() - interval 1 day);
-- publisherShipment
insert into publisherShipment values (1, 2, 'AA 9934 4033 AF', '2019-01-15');
insert into publisherShipment values (2, 1, null, null);
-- author_book
insert into author_book values (1, '9780141393049');
insert into author_book values (2, '9780146000733');
insert into author_book values (3, '9780199660179');
insert into author_book values (4, '9780199660179');
-- book_publisher
insert into book_publisher values ('9780141393049', 5);
insert into book_publisher values ('9780146000733', 5);
insert into book_publisher values ('9780199660179', 6);
-- pulisherOrder_book
insert into publisherOrder_book values (1, '9780141393049', 10);
insert into publisherOrder_book values (2, '9780199660179', 4);
-- sale
insert into sale values (1, 32.34, 3, 2, '2019-03-31 11:04:59');
-- sale_book
insert into sale_book values (1, '9780141393049', 1, 19.84);
insert into sale_book values (1, '9780146000733', 1, 12.50);
-- customerOrder
insert into customerOrder values (1, 4, 1, current_timestamp());
-- customerShipment
insert into customerShipment values (1, 1, '2349 3340 0942 3334', null);
-- customerOrder_book
insert into customerOrder_book values (1, '9780199660179', 1);