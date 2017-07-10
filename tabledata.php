<?php
$db_name=$_POST["db_name"];
$table_name=$_POST["tb_name"];

$conn = new mysqli("localhost", "root", "" ,$db_name);

$sqlTableData = "DESCRIBE ".$table_name;
$resultTableData = $conn->query($sqlTableData);


$tableField[] = array();
$count = 1;

    if ($resultTableData->num_rows > 0) 
    {

        echo "<br> <form method='get'>
            <table class='table table-striped table-responsive'>";
        echo "<tr>";
        echo "<th>Field</th>";
        echo "<th>Type</th>";
        echo "<th>Null</th>";
        echo "<th>Key</th>";
        echo "<th>Default</th>";
        echo "<th>Extra</th>";

        while($rowresultTableData = $resultTableData->fetch_assoc()) 
        {
            echo "<tr>";
                echo "<td>".$rowresultTableData['Field']."</td>";
                echo "<td>".$rowresultTableData['Type']."</td>";
                echo "<td>".$rowresultTableData['Null']."</td>";
                echo "<td>".$rowresultTableData['Key']."</td>";
                echo "<td>".$rowresultTableData['Default']."</td>";
                echo "<td>".$rowresultTableData['Extra']."</td>";
            echo "</tr>";
        }
        echo "</table></form><br><br>";
    }
    else
    {
      echo "<h2>No Column Found!!!</h2>";
    }
?>
