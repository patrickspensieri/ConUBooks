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
				<h3>Books</h3>
				<table class="table table-striped table-bordered">
					<thead class='thead-dark'>
						<tr>
							<th>isbn</th>
							<th>title</th>
							<th>price</th>
							<th>edition</th>
							<th>quantity</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							require 'databaseAccess.php';
							$results = getAllBooks();
							while($results != NULL && $row = $results->fetch(PDO::FETCH_ASSOC))
							{
								echo'<tr>';
								foreach($row as $column)
								{
									$pieces = explode(",", $column.',');
									echo'<td>';
									foreach($pieces as $p)
									{
										echo $p;
									}
									echo'</td>';
								}
								echo'</tr>';
							}
						?>
					</tbody>
				</table>
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
									<option value="g">List every book ordered but not received within the period set has passed.</option>
								</select>
							</div>
							<div class="form-group">
								<label for='input1'>Argument 1:</label>
								<input name="input1" id='input1' type="text" class="form-control"/>
							</div>
							<div class="form-group">
								<label for='input2'>Argument 2:</label>
								<input name="input2" id='input2' type="text" class="form-control"/>
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
								<input name="customInput" id='customInput' type="text" class="form-control"/>
							</div>
							<input type="submit" class="btn btn-primary mb-3"/>
						</form>
					</div>
				</div>
				<div class="form-group mt-3">
					<label for="output">Output:</label>
					<textarea class="form-control" readonly rows='5' id='output' style='resize:none'><?php 
						if(isset($_POST['query']))
						{
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

							while($queryResults != NULL && $row = $queryResults->fetch(PDO::FETCH_ASSOC))
							{
								foreach($row as $column)
								{
									echo $column." ";
								}
								echo "\n";
							}
						} 
						else if($_POST['customInput'] != '')
						{
							$customQueryResult;

							switch ($_POST['type'])
							{
								case "q":
									$customQueryResult = customQuery($_POST['customInput']);
									while($customQueryResult != NULL && $x = $customQueryResult->fetch(PDO::FETCH_ASSOC))
									{
										foreach($x as $y)
										{
											echo $y." ";
										}
										echo "\n";
									}
									break;
								case "t":
									$customQueryResult = customTransaction($_POST['customInput']);
									break;
							}
						}
					?></textarea>
				</div>
			</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>
