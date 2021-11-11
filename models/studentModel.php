<?php

class StudentModel extends BaseModel {
    
    public function getStudents($offset = 0, $limit = 10)
    {
        return $this->db->fetchAll("select * from student_details order by firstname, lastname limit {$offset}, {$limit}");
    }

    public function getStudentById()
    {
        $student_id =   $_GET['id'];
        $arrRows    =   $this->db->fetch("select * from student_details where student_id = ?", [
            'i', $student_id
        ]);
        return $arrRows;
    }

    public function save()
    {
        $firstname  =   $_POST['firstname'];
        $lastname   =   $_POST['lastname'];
        $dob        =   $_POST['dob'];
        $contact_no =   $_POST['contact_no'];

        return $this->db->_execute("INSERT INTO student_details (firstname,lastname,dob,contact_no,created_at) VALUES (?,?,?,?,NOW())", [
            'sssi', $firstname, $lastname, $dob, $contact_no
        ]);
    }

    public function update()
    {
        $firstname  =   $_POST['firstname'];
        $lastname   =   $_POST['lastname'];
        $dob        =   $_POST['dob'];
        $contact_no =   $_POST['contact_no'];
        $student_id =   $_POST['student_id'];

        return $this->db->_execute("update student_details set firstname = ?,lastname = ?,dob = ?,contact_no = ?,updated_at = NOW() where student_id = ?", [
            'sssii', $firstname, $lastname, $dob, $contact_no, $student_id
        ]);
    }

    public function delete()
    {
        $student_id =   $_POST['student_id'];
        return $this->db->_execute("delete from student_details where student_id = ?", [
            'i', $student_id
        ]);
    }
}