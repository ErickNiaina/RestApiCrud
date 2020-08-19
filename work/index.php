<!DOCTYPE html>
<html>
<head>
	<title>REST API CRUD using PHP Mysql</title>
	<meta charset="utf-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container"> 
		<br>

		<h3 align="center">REST API CRUD using PHP Mysql</h3>
		<br>
		<div align="right" style="margin-top: 5px;">
			<button type="button" name="add_button" id="add_button" class="btn btn-success btn-xs">
				Add
			</button>
		</div>
		<div class="table-responsive">
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Firstname</th>
						<th>Lastname</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>
					
				</tbody>
			</table>
		</div>
		
	</div>
</body>
</html>

<div class="modal fade" role="dialog"id="apiCrudModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" id="api_crud_form">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add Data</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Enter Firstname</label>
						<input type="text" name="first_name" id="first_name" class="form-control">
					</div>
					<div class="form-group">
						<label>Enter Lastname</label>
						<input type="text" name="last_name" id="last_name" class="form-control">
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="hidden_id" id="hidden_id">
					<input type="hidden" name="action" id="action" value="insert">
					<input type="submit" name="button_action" id="button_action" class="btn btn-info" value="Insert">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>	
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		
		fetch_data();
		function fetch_data()
		{
			$.ajax({ 
				url:"fetch.php",
				success:function(data)
				{
					$('tbody').html(data);
				}
			});
		}
		
		
		$("#add_button").click(function(){
			$('#action').val('insert');
			$('#button_action').val('Insert');
			$(".modal-title").text('Add Data');
			$("#apiCrudModal").modal('show');
		})

		$("#api_crud_form").on('submit',function(event){
			event.preventDefault();
			if ($("#first_name").val() == "") {
				alert("Enter Firstname");
			}
			if ($("#last_name").val() == "") {
				alert("Enter Lastname");
			}
		 	else{
				var form_data = $(this).serialize();
				$.ajax({
		 			url:"action.php",
		 			method:"POST",
					data:form_data,
		 			success:function(data)
		 			{ 
		 				fetch_data();
		 				$("#api_crud_form")[0].reset();
						$("#apiCrudModal").modal('hide');
						if (data == 'insert') {
							alert("Data inserted using PHP API");
						}
						if(data == 'update'){
							alert("Data updated using PHP API");
						}
		 			}
				})

			}
		 })

	});
</script>