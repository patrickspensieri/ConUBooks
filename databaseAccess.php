 <?php
function conn()
{
    $config = require 'config.php';
    $servername = $config['servername'];
    $dbname     = $config['dbname'];
    $username   = $config['username'];
    $password   = $config['password'];
    try {
        $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
    $results    = $connection->query("select p1.publisherOrderID, b.isbn, b.title, p2.quantity, p1.dateDue
    from publisherOrder p1 
    join publisherOrder_book p2
    join book b
    join publisherShipment s
    where p1.publisherOrderID = s.publisherOrderID
    and p1.publisherOrderId = p2.publisherOrderID
    and b.isbn = p2.isbn
    and s.dateReceived is null;");
    $connection = null;
    return $results;
}

# c. Get detail of all the special orders for a given customer.
function getAllSpecialOrdersByCustomer($cid)
{
    $connection = conn();
    try {
        $results = $connection->query("select c.*, cb.isbn, cb.quantity, b.title
        from customerOrder c
        inner join customerOrder_book cb on cb.customerOrderID = c.customerOrderID
        inner join book b on cb.isbn = b.isbn
        where c.customerID = $cid;");
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
        $results = $connection->query("select s.*, sb.isbn, sb.quantity, sb.pricePerBook, b.title
        from sale s
        inner join sale_book sb on sb.saleID = s.saleID
        inner join book b on sb.isbn = b.isbn
        where s.customerID = $cid;");
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
        $results = $connection->query("select s.*, sb.isbn, b.title
        from sale s
        inner join sale_book sb on sb.saleID = s.saleID
        inner join book b on sb.isbn = b.isbn
        where s.employeeID = $cid 
        and s.date between '$date' and '$date 23:59:59';");
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
    $results    = $connection->query("select s1.*, sb.isbn, (select sum(s2.totalPrice)
    from sale s2
    where s1.customerID = s2.customerID
    and s2.date between '2019-01-01' and '2019-12-31'
    group by customerID) as 'total customer sales in 2019'
    from sale s1
    inner join sale_book sb on sb.saleID = s1.saleID
    where s1.date between '2019-01-01' and '2019-12-31';");
    $connection = null;
    return $results;
}

# g. List every book ordered but not received within the period set has passed.
function getAllBooksNotReceived()
{
    $connection = conn();
    $results    = $connection->query("select p.publisherOrderID, b.title, pb.isbn, pb.quantity, p.dateDue
    from publisherOrder p
    inner join publisherOrder_book pb on p.publisherOrderID = pb.publisherOrderID
    inner join book b on pb.isbn = b.isbn
    inner join publisherShipment s on s.publisherOrderID = p.publisherOrderID
    where s.dateReceived > p.dateDue
    or (s.dateReceived is null and current_timestamp() > p.dateDue);");
    $connection = null;
    return $results;
}

function getAllEmployees()
{
    $connection = conn();
    $results    = $connection->query("call getEmployee();");
    $connection = null;
    return $results;
}

function getAllCustomers()
{
    $connection = conn();
    $results    = $connection->query("call getCustomer();");
    $connection = null;
    return $results;
}

function getAllAuthors()
{
    $connection = conn();
    $results    = $connection->query("select * from author;");
    $connection = null;
    return $results;
}

function getAllPublishers()
{
    $connection = conn();
    $results    = $connection->query("call getPublisher();");
    $connection = null;
    return $results;
}

function getAllBranches()
{
    $connection = conn();
    $results    = $connection->query("call getBranch();");
    $connection = null;
    return $results;
}

function getAllSales()
{
    $connection = conn();
    $results    = $connection->query("select * from sale;");
    $connection = null;
    return $results;
}

function getAllCustomerOrders()
{
    $connection = conn();
    $results    = $connection->query("select * from customerOrder;");
    $connection = null;
    return $results;
}

function getPublisherOrders()
{
    $connection = conn();
    $results    = $connection->query("select * from publisherOrder;");
    $connection = null;
    return $results;
}

function createTable($results)
{
    echo '<table class="table table-hover table-bordered table-striped">';
    echo '<tbody>';
    while($results != NULL && $row = $results->fetch(PDO::FETCH_ASSOC)) {
        $rows = array_keys($row);
        echo '<tr>';
        for($i = 0; $i < count($rows); $i++) {
            echo '<td>'.$row[$rows[$i]].'</td>';
        }
        echo '</tr>';
    }
    echo '</tbody>';
    echo '<thead class="thead-dark">';
    echo '<tr>';
    for($i = 0; $i < count($rows); $i++) {
        echo '<th>'.$rows[$i].'</th>';
    }
    echo '</tr>';
    echo '</thead>';
    echo '</table>';
}
?> 
