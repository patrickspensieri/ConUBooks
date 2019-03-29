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
				<h1> Choose a query </h1>
				<form method = "post">
				    <select name="question">
					<option value="a">Get detail of all books in the Bookstore.</option>
					<option value="b">Get detail of all books that are back order.</option>
					<option value="c">Get detail of all the special orders for a given customer.</option>
					<option value="d">Get detail of all purchases made by a given customer.</option>
					<option value="e">Get detail of all the sales made by a given employee on a specific date.</option>
					<option value="f">Get  details  of  all  purchases  made.  For  each  customer,  return  the  total 
amount paid for the books ordered since the beginning of the year.</option>
					<option value="g">List every book ordered but not received within the period set has passed.</option>
				    </select>
				    <input id="textBox" name = "textB" type = "text"/>
				    <input id="textBox" name = "textC" type = "text"/>
				    <input id="textBox" name = "textD" type = "text"/>
				    <input id="textBox" name = "textE" type = "text"/>
				    <input type="submit"/>
				</form>
				<?php 
					require 'databaseAccess.php';
					if(isset($_POST['question']))
					{
						$PDOresults;

						switch ($_POST['question'])
						{
							case "a":
								$PDOresults = getAllBooks();
								break;
							case "b":
								$PDOresults = getAllBooksBackOrdered();
								break;
							case "c":
								$PDOresults = getAllSpecialOrdersByCustomer($_POST['textB']);
								break;
							case "d":
								$PDOresults = getAllPurchasesByCustomer($_POST['textB']);
								break;
							case "e":
								$PDOresults = getAllSalesByEmployeeOnDate($_POST['textB'],$_POST['textC']);
								break;
							case "f":
								$PDOresults = getAllPurchases();
								break;
							case "g":
								$PDOresults = getAllBooksNotReceived();
								break;
						}

						while($PDOresults != NULL && $row = $PDOresults->fetch(PDO::FETCH_ASSOC))
						{
							foreach($row as $column)
							{
								echo $column." ";
							}
							echo'<br/>';
						}
					}
				?>
			</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>
