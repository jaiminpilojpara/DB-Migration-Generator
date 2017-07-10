<?php
$conn = new mysqli("localhost", "root", "");

$db_name=$_POST["database_name"];

$sql = "SHOW TABLES FROM ".$db_name;

$resultTableName = $conn->query($sql);

if ($resultTableName->num_rows > 0) {
	echo '<div class="form-group">';
    echo '<label class="control-label col-md-2" for="Table">Table :</label>
		  <div class="col-md-5">';
    echo '<select class="form-control" id="tabledropdown" name="Table" onChange="getTableData(this.value);">
    <option selected="selected">Select Table Name</option>';
    while ($row = $resultTableName->fetch_assoc()) {
        echo '<option value="' . $row['Tables_in_'.$db_name] . '">' . $row['Tables_in_'.$db_name] . '</option>';
    }
    echo '</select></div></div>';
} else {
    echo '<center><h1>No Table Available</h1></center>';
    exit();
}
?>