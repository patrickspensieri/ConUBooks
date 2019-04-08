<!DOCTYPE HTML>
<html>
    <head>
        <title>ConUBooks</title>
        <meta charset="utf-8"/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css">
    </head>
    <body>
	<nav class="navbar navbar-expand-lg bg-primary navbar-dark">
		<a class="navbar-brand text-light">ConUBooks</a>
	</nav>
	<div class='container'>
		<div class='row'>
			<div class='col m-3'>
				<ul class="nav nav-tabs" id="tablesTabs">
					<li class="nav-item">
						<a class="nav-link active" id="booksTab" data-toggle="tab" href="#books">Books</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="employeesTab" data-toggle="tab" href="#employees">Employees</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="customersTab" data-toggle="tab" href="#customers">Customers</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="authorsTab" data-toggle="tab" href="#authors">Authors</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="publishersTab" data-toggle="tab" href="#publishers">Publishers</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="branchesTab" data-toggle="tab" href="#branches">Branches</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="branchesTab" data-toggle="tab" href="#sales">Sales</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="branchesTab" data-toggle="tab" href="#customerOrders">Customer Orders</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="branchesTab" data-toggle="tab" href="#publisherOrders">Publisher Orders</a>
					</li>
				</ul>
				<div class="tab-content" id="tablesTabsContent">
					<div class="tab-pane fade show active border-left border-bottom border-right rounded-bottom p-3" id="books">
						<?php 
							require 'databaseAccess.php';
							createTable(getAllBooks());
						?>
					</div>
					<div class="tab-pane fade border-left border-bottom border-right rounded-bottom p-3" id="employees">
						<?php 
							createTable(getAllEmployees());
						?>
					</div>
					<div class="tab-pane fade border-left border-bottom border-right rounded-bottom p-3" id="customers">
						<?php 
							createTable(getAllCustomers());
						?>
					</div>
					<div class="tab-pane fade border-left border-bottom border-right rounded-bottom p-3" id="authors">
						<?php 
							createTable(getAllAuthors());
						?>
					</div>
					<div class="tab-pane fade border-left border-bottom border-right rounded-bottom p-3" id="publishers">
						<?php 
							createTable(getAllPublishers());
						?>
					</div>
					<div class="tab-pane fade border-left border-bottom border-right rounded-bottom p-3" id="branches">
						<?php 
							createTable(getAllBranches());
						?>

					</div>
					<div class="tab-pane fade border-left border-bottom border-right rounded-bottom p-3" id="sales">
						<?php 
							createTable(getAllSales());
						?>

					</div>
					<div class="tab-pane fade border-left border-bottom border-right rounded-bottom p-3" id="customerOrders">
						<?php 
							createTable(getAllCustomerOrders());
						?>

					</div>
					<div class="tab-pane fade border-left border-bottom border-right rounded-bottom p-3" id="publisherOrders">
						<?php 
							createTable(getPublisherOrders());
						?>
					</div>
				</div>
				<br/>
				<ul class="nav nav-tabs" id="queryTabs">
					<li class="nav-item">
						<a class="nav-link active" id="queryTab" data-toggle="tab" href="#queries">Premade Queries</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="customQueryTab" data-toggle="tab" href="#customQuery">Custom Query/Transaction</a>
					</li>
				</ul>
				<div class="tab-content" id="queryTabsContent">
					<div class="tab-pane fade show active border-left border-bottom border-right rounded-bottom p-3" id="queries">
						<form method="post">
							<div class="form-group">
								<label for='query'>Query:</label>
								<select id='query' name="query" class="form-control">
									<option value=""></option>
									<option value="a">Get detail of all books in the Bookstore.</option>
									<option value="b">Get detail of all books that are back order.</option>
									<option value="c">Get detail of all the special orders for a given customer.</option>
									<option value="d">Get detail of all purchases made by a given customer.</option>
									<option value="e">Get detail of all the sales made by a given employee on a specific date.</option>
									<option value="f">Get details of all purchases made. For each customer, return the total amount paid for the books ordered since the beginning of the year.</option>
									<option value="g">List every book ordered but not received within the set period.</option>
								</select>
							</div>
							<div class="form-group">
								<label for='input1' id='input1Label'>Argument 1:</label>
								<input name="input1" id='input1' type="text" class="form-control" disabled="true"/>
							</div>
							<div class="form-group">
								<label for='input2' id='input2Label'>Argument 2:</label>
								<input name="input2" id='input2' type="text" class="form-control" disabled="true"/>
							</div>
							<input type="submit" class="btn btn-primary mb-3"/>
						</form>
					</div>
					<div class="tab-pane fade border-left border-bottom border-right rounded-bottom p-3" id="customQuery">
						<form method="post">
							<div class="form-group">
								<label for='template'>Template:</label>
								<select id='template' name="template" class="form-control">
									<option value=""></option>
									<!-- INSERT -->
									<option value="insertEmployee">Insert Employee</option>
									<option value="insertCustomer">Insert Customer</option>
									<option value="insertPublisher">Insert Publisher</option>
									<option value="insertBranch">Insert Branch</option>
									<option value="insertAddress">Insert Address</option>
									<option value="insertAuthor">Insert Author</option>
									<option value="insertBook">Insert Book</option>
									<option value="insertPublisherOrder">Insert Publisher Order</option>
									<option value="insertPublisherShipment">Insert Publisher Shipment</option>
									<option value="insertAuthor_Book">Insert Author_Book</option>
									<option value="insertBook_Publisher">Insert Book_Publisher</option>
									<option value="insertPublisherOrder_Book">Insert PublisherOrder_Book</option>
									<option value="insertSale">Insert Sale</option>
									<option value="insertSale_Book">Insert Sale_Book</option>
									<option value="insertPublisherOrder_Book">Insert PublisherOrder_Book</option>
									<option value="insertCustomerOrder">Insert CustomerOrder</option>
									<option value="insertCustomerOrder_Book">Insert CustomerOrder_Book</option>
									<option value="insertCustomerShipment">Insert CustomerShipment</option>
									<!-- SELECT -->
									<option value="selectAuthor_Book">Select Author_Book</option>
									<option value="selectBook_Publisher">Select Book_Publisher</option>
									<option value="selectCustomerOrder_Book">Select CustomerOrder_Book</option>
									<option value="selectPublisherOrder_Book">Select PublisherOrder_Book</option>
								</select>
							</div>
							<div class="form-group">
								<label for='type'>Type:</label>
								<select id='type' name="type" class="form-control">
									<option value="q">Query</option>
									<option value="t">Transaction</option>
								</select>
							</div>
							<div class="form-group">
								<div id="editor" name="editor" style="height: 12em; width: inherit;"></div>
								<!-- hidden editorText is used by php to retrieve query from ace editor -->
								<input id="editorText" name="editorText" style="display:none"/>
							</div>
							<input type="submit" class="btn btn-primary mb-3"/>
						</form>
					</div>
				</div>
				<div class="form-group mt-3">
					<?php 
						if(isset($_POST['query']))
						{
							echo '<label for="output">Output:</label>';
							$queryResults;

							switch ($_POST['query'])
							{
								case "a":
									$queryResults = getAllBooks();
									break;
								case "b":
									$queryResults = getAllBooksBackOrdered();
									break;
								case "c":
									$queryResults = getAllSpecialOrdersByCustomer($_POST['input1']);
									break;
								case "d":
									$queryResults = getAllPurchasesByCustomer($_POST['input1']);
									break;
								case "e":
									$queryResults = getAllSalesByEmployeeOnDate($_POST['input1'], $_POST['input2']);
									break;
								case "f":
									$queryResults = getAllPurchases();
									break;
								case "g":
									$queryResults = getAllBooksNotReceived();
									break;
							}

							createTable($queryResults);
						} 
						else if($_POST['editorText'] != '')
						{
							echo '<label for="output">Output:</label>';
							$customQueryResult;

							switch ($_POST['type'])
							{
								case "q":
									$customQueryResult = customQuery($_POST['editorText']);
									createTable($customQueryResult);
									break;
								case "t":
									$customQueryResult = customTransaction($_POST['editorText']);
									break;
							}
						}
					?>
				</div>
			</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.3/ace.js" type="text/javascript" charset="utf-8"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" type="text/javascript" charset="utf-8"></script>

	<script>
		$('#editor').change(setEditorText);
		var editor = ace.edit("editor");
		editor.setTheme("ace/theme/textmate");
		editor.session.setMode("ace/mode/sql");

		// set editorText so php can read value
		function setEditorText(){
			document.getElementById('editorText').value = editor.getValue().trim();
		}
	</script>
	<script type="text/javascript">
		$('#query').change(updateQueryInputs);
		$('#template').change(updateTemplate);
		setUpQuery();
		setUpTemplate();

		function updateQueryInputs(){
			resetQueryInputs();
			var query = document.getElementById("query").value;
			switch(query) {
				case "c":
					document.getElementById('input1Label').innerHTML = 'customerID';
					document.getElementById('input1').placeholder = '5';
					document.getElementById('input2').disabled = true;
					break;
				case "d":
					document.getElementById('input1Label').innerHTML = 'customerID';
					document.getElementById('input1').placeholder = '5';
					document.getElementById('input2').disabled = true;
					break;
				case "e":
					document.getElementById('input1Label').innerHTML = 'employeeID';
					document.getElementById('input1').placeholder = '1';
					document.getElementById('input2Label').innerHTML = 'date';
					document.getElementById('input2').placeholder = '2019-03-31';
					break;
				default:
					disableQueryInputs();
			}
		}

		function resetQueryInputs(){
			document.getElementById('input1').disabled = false;
			document.getElementById('input2').disabled = false;
			document.getElementById('input1Label').innerHTML = 'Argument 1:';
			document.getElementById('input2Label').innerHTML = 'Argument 2:';
			document.getElementById('input1').placeholder = '';
			document.getElementById('input2').placeholder = '';
		}

		function disableQueryInputs(){
			document.getElementById('input1').disabled = true;
			document.getElementById('input2').disabled = true;
			document.getElementById('input1Label').innerHTML = 'Argument 1:';
			document.getElementById('input2Label').innerHTML = 'Argument 2:';
			document.getElementById('input1').placeholder = '';
			document.getElementById('input2').placeholder = '';
		}

		function updateTemplate(){
			var editor = ace.edit("editor");
			var template = document.getElementById("template").value;
			// set default type to 'transaction'
			setTransactionType(true);
			switch(template) {
				// INSERTS
				case "insertEmployee":
					editor.setValue(insertEmployeeTemplate());
					break;
				case "insertCustomer":
					editor.setValue(insertCustomerTemplate());
					break;
				case "insertPublisher":
					editor.setValue(insertPublisherTemplate());
					break;
				case "insertBranch":
					editor.setValue(insertBranchTemplate());
					break;
				case "insertAddress":
					editor.setValue(insertAddressTemplate());
					break;
				case "insertAuthor":
					editor.setValue(insertAuthorTemplate());
					break;
				case "insertBook":
					editor.setValue(insertBookTemplate());
					break;
				case "insertPublisherOrder":
					editor.setValue(insertPublisherOrderTemplate());
					break;
				case "insertPublisherShipment":
					editor.setValue(insertPublisherShipmentTemplate());
					break;
				case "insertAuthor_Book":
					editor.setValue(insertAuthor_BookTemplate());
					break;
				case "insertBook_Publisher":
					editor.setValue(insertBook_PublisherTemplate());
					break;
				case "insertPublisherOrder_Book":
					editor.setValue(insertPublisherOrder_BookTemplate());
					break;
				case "insertSale":
					editor.setValue(insertSaleTemplate());
					break;
				case "insertSale_Book":
					editor.setValue(insertSale_BookTemplate());
					break;
				case "insertCustomerOrder":
					editor.setValue(insertCustomerOrderTemplate());
					break;
				case "insertCustomerOrder_Book":
					editor.setValue(insertCustomerOrder_BookTemplate());
					break;
				case "insertCustomerShipment":
					editor.setValue(insertCustomerShipmentTemplate());
					break;
				// SELECT
				case "selectAuthor_Book":
					setTransactionType(false);
					editor.setValue(selectAuthor_BookTemplate());
					break;
				case "selectBook_Publisher":
					setTransactionType(false);
					editor.setValue(selectBook_PublisherTemplate());
					break;
				case "selectPublisherOrder_Book":
					setTransactionType(false);
					editor.setValue(selectPublisherOrder_BookTemplate());
					break;
				case "selectCustomerOrder_Book":
					setTransactionType(false);
					editor.setValue(selectCustomerOrder_BookTemplate());
					break;
				default:
					setTransactionType(false);
					editor.setValue("");
			}
		}

		// set custom query type to transaction if true, query otherwise
		function setTransactionType(isTransaction){
			if(isTransaction)
				document.getElementById('type').value = 't';
			else
				document.getElementById('type').value = 'q';
		}

		function setUpQuery(){
			$('#query').selectize({
				sortField: 'text',
				selectOnTab: true,
				closeAfterSelected: true,
				placeholder: "select a query..."
			});
		}

		function setUpTemplate(){
			$('#template').selectize({
				sortField: 'text',
				selectOnTab: true,
				closeAfterSelected: true,
				placeholder: "none"
			});
		}

		//INSERT
		function insertEmployeeTemplate(){
			return "call insertEmployee(\n123456789, \n'Andre', \n'14381111111', \n'andre@conubooks.com');";
		}

		function insertCustomerTemplate(){
			return "call insertCustomer(\n'Pablo', \n'15141111111', \n'pablo@yahoo.com');";
		}

		function insertPublisherTemplate(){
			return "call insertPublisher(\n'Penguin Random House', \n'18007333000', \n'contact@randomhouse.com');";
		}

		function insertBranchTemplate(){
			return "call insertBranch(\n5, \n'Penguin Random House Toronto', \n'14169972330', \n'toronto@randomhouse.com', \n'Tom Yates');";
		}

		function insertAddressTemplate(){
			return "insert into address values (\n2, \n'939  Nelson Street', \n'Montreal', \n'QC', \n'P0T 2Y0');";
		}

		function insertAuthorTemplate(){
			return "insert into author values (\n1, \n'George Orwell');";
		}

		function insertBookTemplate(){
			return "insert into book values (\n'9780141393049', \n'Nineteen Eighty-Four', \n19.84, \n1, \n10);";
		}

		function insertPublisherOrderTemplate(){
			return "insert into publisherOrder values (\n2, \n1, \n6, \ncurrent_timestamp() - interval 20 day, \ncurrent_timestamp() - interval 1 day);";
		}

		function insertPublisherShipmentTemplate(){
			return "insert into publisherShipment values (\n1, \n2, \n'AA 9934 4033 AF', \n'2019-01-15');";
		}

		function insertAuthor_BookTemplate(){
			return "insert into author_book values (\n1, \n'9780141393049');";
		}

		function insertBook_PublisherTemplate(){
			return "insert into book_publisher values (\n'9780141393049', \n5);";
		}

		function insertPublisherOrder_BookTemplate(){
			return "insert into publisherOrder_book values (\n1, \n'9780141393049', \n10);";
		}

		function insertSaleTemplate(){
			return "insert into sale values (\n1, \n32.34, \n3, \n2, \n'2019-03-31 11:04:59');";
		}

		function insertSale_BookTemplate(){
			return "insert into sale_book values (\n1, \n'9780141393049', \n1, \n19.84);";
		}

		function insertCustomerOrderTemplate(){
			return "insert into customerOrder values (\n1, \n4, \n1, \ncurrent_timestamp());";
		}

		function insertCustomerShipmentTemplate(){
			return "insert into customerShipment values (\n1, \n1, \n'2349 3340 0942 3334', \nnull);";
		}

		function insertCustomerOrder_BookTemplate(){
			return "insert into customerOrder_book values (\n1, \n'9780199660179', \n1);";
		}

		// SELECT
		function selectAuthor_BookTemplate(){
			return "select * \nfrom author_book;";
		}

		function selectBook_PublisherTemplate(){
			return "select * \nfrom book_publisher;";
		}

		function selectPublisherOrder_BookTemplate(){
			return "select * \nfrom publisherOrder_book \nwhere publisherOrderID = 1;";
		}

		function selectCustomerOrder_BookTemplate(){
			return "select * \nfrom customerOrder_book \nwhere customerOrderID = 1;";
		}

	</script>
    </body>
</html>
