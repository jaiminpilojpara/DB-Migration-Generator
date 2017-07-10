<!DOCTYPE html>
<html>
<head>
	<title>Migration File Creater</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	
</head>
<body>

<?php
$conn = new mysqli("localhost", "root", "");
?>
<br>
   	<!-- File Creation btn and message -->
	<div class="container">
		<div class="form-group">
			<div id="btncreate"></div>
			<div ><h4 id="filecreatedmsg"></h4></div>
		</div>
	</div>
	<!-- File Creation btn and message -->
<br>


<form class="form-horizontal" id="demoform" method="post" enctype="multipart/form-data"><!--Form Start-->

    
    <div class="container">
        <div class="form-group">
            <?php
				$sql = "SHOW DATABASES";
				$res = $conn->query($sql);

				if ($res->num_rows > 0) {
				    echo '<label class="control-label col-md-2" for="database">Database :</label>
						  <div class="col-md-5">';
				    echo '<select class="form-control" id="dbdropdown" name="database" onChange="getTableName(this.value);">
				    <option selected="selected">Select Databse</option>';
				    while ($row = $res->fetch_assoc()) {
				        echo '<option value="' . $row['Database'] . '">' . $row['Database'] . '</option>';
				    }
				    echo '</select>';
				} else {
				    echo '<center><h1>No Database Available</h1></center>';
				    exit();
				}
            ?>
        </div>
	</div>

	<!-- Display Tables -->
	<div id="tables"></div>
	<!-- Display Tables -->

	<!-- Display Table Data -->
	<div id="tbdata"></div>
	<!-- Display Table Data -->


</form>

<script src="clipboard.min.js"></script>

<script type="text/javascript">


$(document).on('click', '#createfile', function(e){
	
	var dbname = document.getElementById("dbdropdown").value;
	var tbname = document.getElementById("tabledropdown").value;

	$.ajax({
	type: "POST",
	url: "filecreate.php",
	data:{tb_name:tbname, db_name:dbname},
	success: function(data){
		$("#filecreatedmsg").html('File Created in <b>CreatedFiles</b> Folder with name ' + data);
	}
	});

});

function getTableName(val) {
	$.ajax({
	type: "POST",
	url: "tablename.php",
	data:'database_name='+val,
	success: function(data){
		$("#tables").html(data);
	}
	});
}

function getTableData(val) {
	var dbname = document.getElementById("dbdropdown").value;
	$.ajax({
	type: "POST",
	url: "tabledata.php",
	data:{tb_name:val, db_name:dbname},
	success: function(data){
		$('#btncreate').html('<button id="createfile" class="btn btn-default">Click To Create File</button>');
		$("#tbdata").html(data);
	}
	});
}


</script>
</body>
</html>