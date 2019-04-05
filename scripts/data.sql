-- employee
insert into employee values (1, 123456789, 'Andre', '14381111111', '234 Random Road', 'andre@conubooks.com');
insert into employee values (2, 987652431, 'Philippe', '14382222222', '90 Some Place', 'philippe@conubooks.com');
-- customer
insert into customer values (1, 'Pablo', '15141111111', '341 Roach Road', 'pablo@yahoo.com');
insert into customer values (2, 'Patrick', '15142222222', '18 12th Avenue', 'patrick@mail.com');
-- author
insert into author values (1, 'George Orwell');
insert into author values (2, 'H. G. Wells');
insert into author values (3, 'Daniela Isac');
insert into author values (4, 'Charles Reiss');
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
insert into publisherOrder values (1, 1, 1, '2019-01-01', '2019-01-14');
insert into publisherOrder values (2, 1, 2, current_timestamp() - interval 20 day, current_timestamp() - interval 1 day);
-- publisherShipment
insert into publisherShipment values (1, 2, 'AA 9934 4033 AF', '2019-01-15');
insert into publisherShipment values (2, 1, null, null);
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
insert into customerOrder values (1, 2, 1, current_timestamp());
-- customerShipment
insert into customerShipment values (1, 1, '2349 3340 0942 3334', null);
-- customerOrder_book
insert into customerOrder_book values (1, '9780199660179', 1);