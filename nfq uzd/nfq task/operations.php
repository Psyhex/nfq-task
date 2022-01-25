<?php 
    require_once('./dbconfig.php');
    $db = new dbconfig();

    class operations extends dbconfig
    {
        public function Store_Record()
        {
            global $db;
            if(isset($_POST['submit_project']))
            {
                $project_name = $db->check($_POST['project_name']);
                $number_of_groups = $db->check($_POST['number_of_groups']);
                $student_per_group = $db->check($_POST['student_per_group']);
                
                if($this->insert_record($project_name, $number_of_groups, $student_per_group))
                {
                    echo "Your Record has been saved into db";
                    header('Location: index.php');
                }
                else
                {
                    echo "Error";
                }
            }
        }

        function insert_record($p_n,$n_o_g,$s_p_g)
        {
            global $db;
            $query = "insert into project (project_name, group_number, number_of_students) values('$p_n', '$n_o_g', '$s_p_g')";
            $result = mysqli_query($db->connection, $query);

            if($result)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        public function Store_Student()
        {
            global $db;
            if(isset($_POST['submit_student']))
            {
                $student_name = $db->check($_POST['student_name']);
                if($this->insert_student($student_name))
                {
                    echo "Student added";
                    echo "<meta http-equiv='refresh' content='0'>";
                }
                else
                {
                    echo "Error! Maybe this student already exist?";
                }
            }
        }
        function insert_student($s_name)
        {
            global $db;
            $query = "insert into student (student_name) value('$s_name')";
            $result = mysqli_query($db->connection, $query);
            if($result)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        
        public function view_record()
        {   
            global $db;
            $query = "select * from project";
            $result = mysqli_query($db->connection,$query);
            return $result;
            
        }
        public function student_list()
        {
            global $db;
            $query = "select * from student";
            $student_list = mysqli_query($db->connection,$query);
            return $student_list;
        }
        public function get_student_without_group()
        {
            global $db;
            $query = "select * from `student` WHERE `student_group` = '' ";
            $student_list_no_group = mysqli_query($db->connection,$query);
            return $student_list_no_group;
        }
        public function get_student_with_group()
        {
            global $db;
            $query = "SELECT * FROM `student` WHERE student_group != \"\";";
            $student_list_with_group = mysqli_query($db->connection,$query);
            return $student_list_with_group;
        }
        public function Delete_Record($id)
        {
            global $db;
            $query = "delete from student where ID='$id'";
            $result = mysqli_query($db->connection,$query);
            if($result)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        public function Add_Student_to_Group($student_name_to_sql, $group_name_to_sql)
        {
            global $db;
            $query ="UPDATE student SET student_group = \"$group_name_to_sql\" WHERE student_name = \"$student_name_to_sql\"";
            $result = mysqli_query($db->connection,$query);
            if($result)
            {
                return true;
            }
            else
            {
                return false;
            }

        }
    }

?>