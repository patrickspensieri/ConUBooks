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
select s.*, sb.isbn, sb.quantity, b.title
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
select s1.*, sum(s2.salePrice) as 'total customer sales in 2019'
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