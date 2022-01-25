<?php
require_once('./dbconfig.php');
$db = new operations();

$query = $_SERVER['QUERY_STRING'];

$str_arr = explode ("=", $query); 

$student_name_to_sql = str_replace("+"," ",$str_arr[1]);
$student_group_and_placement_from_url =  str_replace("student", "", $str_arr[0]);


$group_number_arr = explode ("_", $student_group_and_placement_from_url);
$group_number = $group_number_arr[0];

$full_len_group_number = strlen($group_number);
$only_group_len = strlen("group");



$final_group_number_name = substr($group_number, $only_group_len);

$group_name_to_sql = "Group #".$final_group_number_name;
$group_and_placment = $str_arr[0];

global $db;
if($db->Add_Student_to_Group($student_name_to_sql, $group_name_to_sql))
        {
            echo "Student added to group";
            header("location:index.php");
        }
        else
        {
            echo "Something Wrong to Delete the Record"; 
        }

?>

