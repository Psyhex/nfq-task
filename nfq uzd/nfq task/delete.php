<?php
require_once('./dbconfig.php');
$db = new operations();

if(isset($_GET['D_ID']))
{
    global $db;
    $ID = $_GET['D_ID'];
    if($db->Delete_Record($ID))
        {
            echo "Record Deleted";
            header("location:index.php");
        }
        else
        {
            echo "Something Wrong to Delete the Record"; 
        }
}
?>





  