<?php
    require_once('./dbconfig.php');
    $db = new operations();
?>
<!DOCTYPE html>
<html>
<head>
<title>Create Project</title>
</head>
<body>
    <h1>Create Project</h1>
    <?php $db->Store_Record(); ?>
    <form method="POST">
        Project name: <input type="text" name="project_name"><br>
        Number of groups<input type="text" name="number_of_groups"><br>
        Students per group<input type="text" name="student_per_group"><br>
        <button name="submit_project">Submit</button>
    </form>


</body>
</html> 