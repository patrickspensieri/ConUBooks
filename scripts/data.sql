-- employee
call insertEmployee(123456789, 'Andre', '14381111111', 'andre@conubooks.com');
insert into address values (1, '1900  Lynden Road', 'Montreal', 'QC', 'L0B 1M0');
call insertEmployee(987652431, 'Philippe', '14382222222', 'philippe@conubooks.com');
insert into address values (2, '939  Nelson Street', 'Montreal', 'QC', 'P0T 2Y0');
-- customer
call insertCustomer('Pablo', '15141111111', 'pablo@yahoo.com');
insert into address values (3, '2774  Roach Road', 'Montreal', 'QC', 'N6E 1A9');
call insertCustomer('Patrick', '15142222222', 'patrick@mail.com');
insert into address values (4, '1248  rue des Champs', 'Montreal', 'QC', 'G7H 4N3');
call insertCustomer('Mario', '15143333333', 'mario@mail.com');
insert into address values (5, '1248  Random Road', 'Montreal', 'QC', 'H7L 1P3');
insert into customer values (2); -- customer who is already an employee
-- publisher
call insertPublisher('Penguin Random House', '18007333000', 'contact@randomhouse.com');
insert into address values (6, '320  Front St W', 'Toronto', 'ON', 'G7H 4N3');
call insertPublisher('Oxford University Press', '18002800280', 'contact@oxfordpress.com');
insert into address values (7, '8  Sampson Mews', 'Toronto', 'ON', 'G7L 5L9');
call insertPublisher('Vintage Books', '12129407390', 'contact@vintagebooks.com');
insert into address values (8, '1745  Broadway', 'New York', 'NY', '10019');
-- branch
call insertBranch(6, 'Penguin Random House Toronto', '14169972330', 'toronto@randomhouse.com', 'Tom Yates');
insert into address values (9, '3263  James Street', 'Toronto', 'ON', 'V5G 4W7');
-- author
insert into author values (1, 'George Orwell');
insert into author values (2, 'H. G. Wells');
insert into author values (3, 'Daniela Isac');
insert into author values (4, 'Charles Reiss');
insert into author values (5, 'Anthony Burgess');
insert into author values (6, 'Stefan Zweig');
insert into author values (7, 'Irvine Welsh');
-- book
insert into book values ('9780141393049', 'Nineteen Eighty-Four', 19.84, 1, 10);
insert into book values ('9780146000733', 'The Time Machine', 12.50, 1, 5);
insert into book values ('9780199660179', 'I-Language', 120.45, 2, 0);
insert into book values ('9780141182606', 'A Clockwork Orange', 17.50, 1, 2);
insert into book values ('9780141196305', 'Chess', 4.99, 1, 1);
insert into book values ('9780099465898', 'Trainspotting', 21.95, 1, 2);
-- author_book
insert into author_book values (1, '9780141393049');
insert into author_book values (2, '9780146000733');
insert into author_book values (3, '9780199660179');
insert into author_book values (4, '9780199660179');
insert into author_book values (5, '9780141182606');
insert into author_book values (6, '9780141196305');
insert into author_book values (7, '9780099465898');
-- book_publisher
insert into book_publisher values ('9780141393049', 6);
insert into book_publisher values ('9780146000733', 6);
insert into book_publisher values ('9780199660179', 7);
insert into book_publisher values ('9780141182606', 6);
insert into book_publisher values ('9780141196305', 6);
insert into book_publisher values ('9780099465898', 8);
-- sale
insert into sale values (1, 32.34, 3, 2, '2019-03-31 09:04:59');
insert into sale values (2, 17.50, 4, 1, '2019-03-31 10:04:59');
insert into sale values (3, 225.74, 5, 1, '2019-03-31 12:04:59');
insert into sale values (4, 66.47, 5, 2, '2019-03-31 13:04:59');
-- sale_book
insert into sale_book values (1, '9780141393049', 1, 19.84);
insert into sale_book values (1, '9780146000733', 1, 12.50);
insert into sale_book values (2, '9780141182606', 1, 17.50);
insert into sale_book values (3, '9780141393049', 1, 19.84);
insert into sale_book values (3, '9780146000733', 2, 12.50);
insert into sale_book values (3, '9780199660179', 2, 90.45);
insert into sale_book values (4, '9780141182606', 1, 17.50);
insert into sale_book values (4, '9780141196305', 1, 4.99);
insert into sale_book values (4, '9780099465898', 2, 21.95);
-- publisherOrder
insert into publisherOrder values (1, 1, 6, '2019-01-01', '2019-01-14');
insert into publisherOrder values (2, 1, 7, current_timestamp() - interval 20 day, current_timestamp() - interval 1 day);
insert into publisherOrder values (3, 2, 6, current_timestamp() - interval 100 day, current_timestamp() - interval 80 day);
-- publisherShipment
insert into publisherShipment values (1, 2, 'AA 9934 4033 AF', '2019-01-15');
insert into publisherShipment values (2, 1, null, null);
insert into publisherShipment values (3, 1, null, null);
-- pulisherOrder_book
insert into publisherOrder_book values (1, '9780141393049', 10);
insert into publisherOrder_book values (2, '9780199660179', 4);
insert into publisherOrder_book values (3, '9780141182606', 2);
insert into publisherOrder_book values (3, '9780141196305', 4);
insert into publisherOrder_book values (3, '9780141393049', 4);
insert into publisherOrder_book values (3, '9780146000733', 4);
-- customerOrder
insert into customerOrder values (1, 4, 1, current_timestamp());
insert into customerOrder values (2, 2, 2, '2019-03-31 11:04:59');
insert into customerOrder values (3, 5, 2, current_timestamp());
-- customerShipment
insert into customerShipment values (1, 1, '2349 3340 0942 3334', null);
insert into customerShipment values (2, 1, '1879 2340 0942 9998', '2019-04-04 11:04:59');
-- customerOrder_book
insert into customerOrder_book values (1, '9780199660179', 1);
insert into customerOrder_book values (2, '9780141182606', 2);
insert into customerOrder_book values (3, '9780141393049', 10);
insert into customerOrder_book values (3, '9780146000733', 10);
insert into customerOrder_book values (3, '9780199660179', 10);
insert into customerOrder_book values (3, '9780141182606', 10);
insert into customerOrder_book values (3, '9780141196305', 10);
insert into customerOrder_book values (3, '9780099465898', 10);