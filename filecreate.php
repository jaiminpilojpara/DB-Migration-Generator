<?php
$db_name=$_POST["db_name"];
$table_name=$_POST["tb_name"];

$conn = new mysqli("localhost", "root", "" ,$db_name);

$sqlTableData = "SHOW CREATE TABLE ".$table_name;
$resultTableData = $conn->query($sqlTableData);

// $sqlcountrow = "SELECT COUNT(*) FROM ".$table_name;
// $ressqlcountrow = $conn->query($sqlcountrow);
// $rowressqlcountrow = $ressqlcountrow->fetch_assoc();
// $rowintable = $rowressqlcountrow['COUNT(*)'];
if ($resultTableData->num_rows > 0) 
    {
        while($rowresultTableData = $resultTableData->fetch_assoc()) 
        {
            $myfile = fopen("CreatedFiles/create_".ucfirst($table_name)."_table.php", "w") or die("Unable to open file!");
                        $main = '<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create'.ucfirst($table_name).'Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $'.'sql="'.$rowresultTableData["Create Table"].'";
        DB::connection()->getPdo()->exec($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
    }

}';
                        fwrite($myfile, $main);
        }
                        echo "<b>create_".ucfirst($table_name)."_table.php</b>";

        echo "</table></form><br><br>";
    }
    else
    {
      echo "<h2>No Column Found!!!</h2>";
    }
?>
