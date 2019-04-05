<!DOCTYPE HTML>
<html>
    <head>
        <title>ConUBooks</title>
        <meta charset="utf-8"/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
							$books = getAllBooks();
							echo '<table class="table table-hover table-bordered table-striped">';
							echo '<tbody>';
							while($books != NULL && $row = $books->fetch(PDO::FETCH_ASSOC)) {
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
						?>
					</div>
					<div class="tab-pane fade border-left border-bottom border-right rounded-bottom p-3" id="employees">
						<?php 
							$employees = getAllEmployees();
							echo '<table class="table table-hover table-bordered table-striped">';
							echo '<tbody>';
							while($employees != NULL && $row = $employees->fetch(PDO::FETCH_ASSOC)) {
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
						?>
					</div>
					<div class="tab-pane fade border-left border-bottom border-right rounded-bottom p-3" id="customers">
						<?php 
							$customers = getAllCustomers();
							echo '<table class="table table-hover table-bordered table-striped">';
							echo '<tbody>';
							while($customers != NULL && $row = $customers->fetch(PDO::FETCH_ASSOC)) {
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
						?>
					</div>
					<div class="tab-pane fade border-left border-bottom border-right rounded-bottom p-3" id="authors">
						<?php 
							$authors = getAllAuthors();
							echo '<table class="table table-hover table-bordered table-striped">';
							echo '<tbody>';
							while($authors != NULL && $row = $authors->fetch(PDO::FETCH_ASSOC)) {
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
						?>
					</div>
					<div class="tab-pane fade border-left border-bottom border-right rounded-bottom p-3" id="publishers">
						<?php 
							$publishers = getAllPublishers();
							echo '<table class="table table-hover table-bordered table-striped">';
							echo '<tbody>';
							while($publishers != NULL && $row = $publishers->fetch(PDO::FETCH_ASSOC)) {
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
						?>
					</div>
					<div class="tab-pane fade border-left border-bottom border-right rounded-bottom p-3" id="branches">
						<?php 
							$branches = getAllBranches();
							echo '<table class="table table-hover table-bordered table-striped">';
							echo '<tbody>';
							while($branches != NULL && $row = $branches->fetch(PDO::FETCH_ASSOC)) {
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
						?>

					</div>
					<div class="tab-pane fade border-left border-bottom border-right rounded-bottom p-3" id="sales">
						<?php 
							$sales = getAllSales();
							echo '<table class="table table-hover table-bordered table-striped">';
							echo '<tbody>';
							while($sales != NULL && $row = $sales->fetch(PDO::FETCH_ASSOC)) {
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
						?>

					</div>
					<div class="tab-pane fade border-left border-bottom border-right rounded-bottom p-3" id="customerOrders">
						<?php 
							$customerOrders = getAllCustomerOrders();
							echo '<table class="table table-hover table-bordered table-striped">';
							echo '<tbody>';
							while($customerOrders != NULL && $row = $customerOrders->fetch(PDO::FETCH_ASSOC)) {
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
						?>

					</div>
					<div class="tab-pane fade border-left border-bottom border-right rounded-bottom p-3" id="publisherOrders">
						<?php 
							$publisherOrders = getPublisherOrders();
							echo '<table class="table table-hover table-bordered table-striped">';
							echo '<tbody>';
							while($publisherOrders != NULL && $row = $publisherOrders->fetch(PDO::FETCH_ASSOC)) {
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
								<label for='query'>Select a query:</label>
								<select id='query' name="query" class="form-control">
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
								<label for='type'>Select type:</label>
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

							echo '<table class="table table-hover table-bordered table-striped">';
							echo '<tbody>';
							while($queryResults != NULL && $row = $queryResults->fetch(PDO::FETCH_ASSOC)) {
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
						else if($_POST['editorText'] != '')
						{
							echo '<label for="output">Output:</label>';
							$customQueryResult;

							switch ($_POST['type'])
							{
								case "q":
									$customQueryResult = customQuery($_POST['editorText']);
									echo '<table class="table table-hover table-bordered table-striped">';
									echo '<tbody>';
									while($customQueryResult != NULL && $row = $customQueryResult->fetch(PDO::FETCH_ASSOC)) {
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
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.3/ace.js" type="text/javascript" charset="utf-8"></script>
	<script>
		$('#editor').change(setEditorText);
		var editor = ace.edit("editor");
		editor.setTheme("ace/theme/textmate");
		editor.session.setMode("ace/mode/sql");

		// set editorText so php can read value
		function setEditorText(){
			document.getElementById('editorText').value = editor.getValue();
		}
	</script>
	<script type="text/javascript">
		$('#query').change(updateQueryInputs);

		function updateQueryInputs(){
			resetQueryInputs();
			var query = document.getElementById("query").value;
			switch(query) {
				case "c":
					document.getElementById('input1Label').innerHTML = 'customerID';
					document.getElementById('input1').placeholder = '1';
					document.getElementById('input2').disabled = true;
					break;
				case "d":
					document.getElementById('input1Label').innerHTML = 'customerID';
					document.getElementById('input1').placeholder = '1';
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
			document.getElementById('input1Label').placeholder = '';
			document.getElementById('input2Label').placeholder = '';
		}

		function disableQueryInputs(){
			document.getElementById('input1').disabled = true;
			document.getElementById('input2').disabled = true;
			document.getElementById('input1Label').innerHTML = 'Argument 1:';
			document.getElementById('input2Label').innerHTML = 'Argument 2:';
		}
	</script>
    </body>
</html>
