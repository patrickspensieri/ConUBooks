 <?php
function conn()
{
    $servername = "spc353.encs.concordia.ca";
    $dbname     = "spc353_4";
    $username   = "spc353_4";
    $password   = "1assword";
    try {
        $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully <br/>";
    }
    catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    return $connection;
}

#    
# Custom queries
#
function customQuery($str)
{
    $connection = conn();
    try {
        $results = $connection->query("$str");
    }
    catch (Exception $exception) {
        echo "Malformed query: '$str'";
        echo $exception->getMessage();
    }
    $connection = null;
    return $results;
}

#
# Custom transactions
#
function customTransaction($str)
{
    $connection = conn();
    try
    {
        $connection->beginTransaction();
        $results = $connection->exec("$str");
        $connection->commit();
        echo "Success";      
    } 
    catch(Exception $exception)
    {
        echo "Malformed transaction: '$str'";
        echo $exception->getMessage();
        $connection->rollBack();
    }
    $connection = null;
    return $results;
}

#    
# Required queries
#

# a. Get detail of all books in the Bookstore.
function getAllBooks()
{
    $connection = conn();
    $results    = $connection->query("select * from book;");
    $connection = null;
    return $results;
}

# b. Get detail of all books that are back order.
function getAllBooksBackOrdered()
{
    $connection = conn();
    $results    = $connection->query("select b.* from publisherOrder p1 join publisherOrder_book p2 join book b where dateReceived is null and p1.publisherOrderId = p2.publisherOrderID and b.isbn = p2.isbn;");
    $connection = null;
    return $results;
}

# c. Get detail of all the special orders for a given customer.
function getAllSpecialOrdersByCustomer($cid)
{
    $connection = conn();
    try {
        $results = $connection->query("select c.*, cb.isbn, cb.quantity, b.title from customerOrder c inner join customerOrder_book cb on cb.customerOrderID = c.customerOrderID inner join book b on cb.isbn = b.isbn where c.customerID = $cid;");
    }
    catch (Exception $e) {
        echo "Incorrect $cid";
    }
    $connection = null;
    return $results;
}

# d. Get detail of all purchases made by a given customer.
function getAllPurchasesByCustomer($cid)
{
    $connection = conn();
    try {
        $results = $connection->query("select s.*, sb.isbn, sb.quantity, sb.pricePerBook, b.title from sale s inner join sale_book sb on sb.saleID = s.saleID inner join book b on sb.isbn = b.isbn where s.customerID = $cid;");
    }
    catch (Exception $e) {
        echo "Incorrect $cid";
    }
    $connection = null;
    return $results;
}

# e. Get detail of all the sales made by a given employee on a specific date.
function getAllSalesByEmployeeOnDate($cid, $date)
{
    $connection = conn();
    try {
        $results = $connection->query("select s.*, sb.isbn, b.title from sale s inner join sale_book sb on sb.saleID = s.saleID inner join book b on sb.isbn = b.isbn where s.employeeID = $cid and s.date between '$date' and '$date 23:59:59';");
    }
    catch (Exception $e) {
        echo "Incorrect $cid or $date";
    }
    $connection = null;
    return $results;
}

# f. Get details of all purchases made. For each customer, return the total
#    amount paid for the books ordered since the beginning of the year.
function getAllPurchases()
{
    $connection = conn();
    $results    = $connection->query("select s1.*, sum(s2.totalPrice) as 'total customer sales in 2019' from sale s1 inner join sale s2 on s1.customerID = s2.customerID where s1.date between '2019-01-01' and '2019-12-31' and s2.date between '2019-01-01' and '2019-12-31';");
    $connection = null;
    return $results;
}

# g. List every book ordered but not received within the period set has passed.
function getAllBooksNotReceived()
{
    $connection = conn();
    $results    = $connection->query("select b.title, pb.isbn, pb.quantity, p.dateDue, p.dateReceived
        from publisherOrder p
        inner join publisherOrder_book pb on p.publisherOrderID = pb.publisherOrderID
        inner join book b on pb.isbn = b.isbn
        where p.dateReceived > p.dateDue
        or (p.dateReceived is null and current_timestamp() > p.dateDue);");
    $connection = null;
    return $results;
}
?> 
