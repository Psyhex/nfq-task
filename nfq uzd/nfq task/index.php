<?php
    
    require_once('./dbconfig.php');
    $db = new operations();
    $result=$db->view_record();
    $student_list=$db->student_list();
    $student_list_no_group=$db->get_student_without_group();
    $student_list_with_group=$db->get_student_with_group();
?>
<!DOCTYPE html>
<html>
<head>
<title>CRUD</title>
<style>
    table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>
</head>
<body>
    <?php
        $i = 0;
        while($data = mysqli_fetch_assoc($result))
        {   
            $p_name = "Project name: " . "<b>" . $data['project_name'] . "</b>" . "<br>";
            $g_number = "Number of groups: " . "<b>" . $data['group_number'] . "</b>" . "<br>";
            $n_students = "Students per group: " . "<b>" . $data['number_of_students'] . "</b>" . "<br>";
            echo $p_name;
            echo $g_number;
            echo $n_students;
            $groups = $data['group_number'];
            $students = $data['number_of_students'];
            $i++;   
        }
        if($i==0){
            header('Location: create_project.php');
            echo "tuscia";
        }
               
?>
<h3>Students</h3>
<?php $db->Store_Student(); ?>

<form method="POST">
        Student name: <input type="text" name="student_name"><br>
        <button name="submit_student">Add a student</button>
</form>
<table class="student_list">
    <tr>
            <th>Student name</th>
            <th>Group Name</th>
            <th>Action</th>
    </tr>
<?php 
    while($student_list_data = mysqli_fetch_assoc($student_list))
    {   
        echo "<tr>";
        echo "<td>" . $student_list_data['student_name'] . "</td>";
        echo "<td>" . $student_list_data['student_group'] . "</td>";
        echo "<td><a href=\"delete.php?D_ID=".$student_list_data['id']."\"".">Delete</a></td>";
        
    }    
?>
</table>

<h3> Groups </h3>
<table class="group">
<?php
while ($student_with_g = mysqli_fetch_assoc($student_list_with_group))
{
    $list_student_2arr[] = array($student_with_g['student_name'], $student_with_g['student_group']);
}

while($student_list_no_group_data = mysqli_fetch_assoc($student_list_no_group))
{
    $list_of_students_no_group[] = $student_list_no_group_data['student_name'];
}
    $groupMembers = array();
    for ($j = 0; $j < $groups; $j++)
    {
        $groupMembers[$j] = 0;
        echo "<tr>";
        echo "<th>Group #". $j+1 ." </th>";
        echo "</tr>";
        if (isset($list_student_2arr)) {
            for ($x = 0; $x < count($list_student_2arr); $x++){
                if("Group #".$j+1 == $list_student_2arr[$x][1]){
                    $groupMembers[$j]++;
                    echo "<tr>";
                    echo "<td>";
                    echo $list_student_2arr[$x][0];
                    echo "</td>";
                    echo "</tr>";
                }
            }  
            
        }
        if ($groupMembers[$j] < $students) {
            for ($k = 0; $k < ($students- $groupMembers[$j]); $k++)
            {   
                
                echo "<tr>";
                echo "<td>";
            
                echo "<form action=\"./sgadd.php\" >";
                echo "<select id=\"studentgroup". $j+1 . "_". $k+1 . "\" name=\"studentgroup". $j+1 ."_". $k+1 ."\" >";
                echo "<option value=\"\">Assign a student</option>";
            
                foreach($list_of_students_no_group as $list_of_students_no_group_single)
                {
                    echo "<option value=\"" . $list_of_students_no_group_single . "\">" . $list_of_students_no_group_single . "</option>";
                    
                }
            
                echo "</select>";
                echo "<input type=\"submit\" value=\"Submit\">";
                echo "</form>";
                    
                echo "</td>";
                echo "</tr>";
                
            }
        }
    }
?>
</table>

</body>
</html> 


