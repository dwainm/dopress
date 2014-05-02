<!DOCTYPE html>
<html>
	<head>
		<title>Do This - a Backbone Forgetful Todo list app</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div id="app">
			<header>	
					<h1>DoPress</h1>
			</header>
			<form id='item-add-form' >
				<input id="item-add-text" name="item-add-text" type="text" placeholder="add todo item" />
				<input type="submit" id="add-button" value="+" / > 
			</form>	
			<ul id="list">
			<!--	<li class="item" id="1"><input type="checkbox" name="1" /><div class="description">Sample to do item</div>   </li>
				<li class="item" id="2"><input type="checkbox" name="2" /><div class="description">Sample to do item 2</div>   </li>	-->			
			</ul>
			<div id="footer">
				<div id="counter"><span class="total">x</span><span class="text">item(s) left</span></div>
				<div id="listFilter">
						<a class="all active" href="#">All</a>
						<a class="incomplete" href="#">Incomplete</a>
						<a class="completed" href="#">Completed</a>
				</div>
			</div>
				
		</div>
		<!-- Load Libraries -->
		<script type="text/javascript" src="lib/jquery.js"></script>
		<script type="text/javascript" src="lib/underscore.min.js"></script>
		<script type="text/javascript" src="lib/backbone.min.js"></script>

		<!-- Application Modles and Collections-->
		<script type="text/javascript" src="js/models/app.js"></script>
		<script type="text/javascript" src="js/models/item.js"></script>
		<script type="text/javascript" src="js/collections/items.js"></script>

		<!-- Application Views-->
		<script type="text/javascript" src="js/views/item.js"></script>
		<script type="text/javascript" src="js/views/list.js"></script>
		<script type="text/javascript" src="js/views/form.js"></script>
		<script type="text/javascript" src="js/views/footer.js"></script>
		<script type="text/javascript" src="js/views/app.js"></script>


	</body>
</html>