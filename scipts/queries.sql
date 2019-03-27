-- a. Get detail of all books in the Bookstore.
select * 
from book;
-- b. Get detail of all books that are back order.
SELECT b.*
FROM publisherOrder p1 JOIN publisherOrder_book p2 JOIN book b
WHERE dateReceived IS NULL AND p1.publisherOrderId = p2.publisherOrderID AND b.isbn = p2.isbn;
-- c. Get detail of all the special orders for a given customer.
-- TODO fix errors
SELECT order.*, book.isbn, book.quantity
FROM customerOrder order JOIN customerOrder_book book
WHERE order.customerId = 1 AND book.customerOrderID = order.customerOrderId;
-- d. Get detail of all purchases made by a given customer.

-- e. Get detail of all the sales made by a given employee on a specific date.

-- f. Get details of all purchases made. For each customer, return the total amount paid for the books ordered since the beginning of the year.

-- g. List every book ordered but not received within the period set has passed.