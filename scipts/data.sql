-- employee
insert into employee values (1, 123456789, 'Andre', '14381111111', '234 Random Road', 'andre@conubooks.com');
insert into employee values (2, 987652431, 'Philippe', '14382222222', '90 Some Place', 'philippe@conubooks.com');
-- customer
insert into customer values (1, 2018, 'Pablo', '15141111111', '341 Roach Road', 'pablo@yahoo.com');
insert into customer values (2, 2008, 'Patrick', '15142222222', '18 12th Avenue', 'patrick@mail.com');
-- author
insert into author values (1, 'George Orwell', null, null, null);
insert into author values (2, 'H. G. Wells', null, null, null);
insert into author values (3, 'Daniela Isac', null, null, null);
insert into author values (4, 'Charles Reiss', null, null, null);
-- book
insert into book values ('9780141393049', 'Nineteen Eighty-Four', 19.84, 1949, 1, 10);
insert into book values ('9780146000733', 'The Time Machine', 12.50, 1895, 1, 5);
insert into book values ('9780199660179', 'I-Language: An Introduction to Linguistics as Cognitive Science', 120.45, 2013, 2, 0);
-- publisher
insert into publisher values (1, 'Penguin Random House', '18007333000', '320 Front St W', 'orders@randomhouse.com');
insert into publisher values (2, 'Oxford University Press', '18002800280', '8 Sampson Mews', 'contact@oxfordpress.com');
-- branch
insert into branch values (13, 1, 'Penguin Random House Toronto', '14169972330', '33 Pine Avenue', 'toronto_orders@randomhouse.com');
-- publisherOrder
insert into publisherOrder values (1, 1, 1, current_timestamp(), null);
insert into publisherOrder values (2, 1, 2, current_timestamp(), null);
-- publisherShipment
insert into publisherShipment values (1, current_timestamp(), null);
insert into publisherShipment values (2, current_timestamp(), null);
-- author_book
insert into author_book values (1, '9780141393049');
insert into author_book values (2, '9780146000733');
insert into author_book values (3, '9780199660179');
insert into author_book values (4, '9780199660179');
-- publisher_book
insert into publisher_book values (1, '9780141393049');
insert into publisher_book values (1, '9780146000733');
insert into publisher_book values (2, '9780199660179');
-- pulisherOrder_book
-- TODO add constraint that book is in fact published by said publisher
insert into publisherOrder_book values (1, '9780141393049', 10);
-- insert into publisherOrder_book values (1, '9780146000733', 7);
insert into publisherOrder_book values (2, '9780199660179', 4);
-- sale
insert into sale values (1, 32.34, 1, 2);
-- sale_book
insert into sale_book values (1, '9780141393049', 1);
insert into sale_book values (1, '9780146000733', 1);
-- customerOrder
insert into customerOrder values (1, 2, 1, current_timestamp(), null);
-- customerShipment
insert into customerShipment values (1, null, null);
-- customerOrder_book
insert into customerOrder_book values (1, '9780199660179', 1);


