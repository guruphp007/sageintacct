<?php

class CourseModel extends BaseModel {

    public function getCourses($offset = 0, $limit = 10)
    {
        return $this->db->fetchAll("select * from course_details order by course_name limit {$offset}, {$limit}");
    }

    public function getCourseById()
    {
        $course_id =   $_GET['id'];
        $arrRows    =   $this->db->fetch("select * from course_details where course_id = ?", [
            'i', $course_id
        ]);
        return $arrRows;
    }

    public function getTotalCourses()
    {
        $arrRows    =   $this->db->fetch("select COUNT(1) as TOT from course_details");
        return $arrRows['TOT'];
    }

    public function save()
    {
        $course_name            =   $_POST['course_name'];
        $course_description     =   $_POST['course_description'];

        return $this->db->_execute("INSERT INTO course_details (course_name,course_description,created_at) VALUES (?,?,NOW())", [
            'ss', $course_name, $course_description
        ]);
    }

    public function update()
    {
        $course_name  =   $_POST['course_name'];
        $course_description   =   $_POST['course_description'];
        $course_id   =   $_POST['course_id'];

        return $this->db->_execute("update course_details set course_name = ?,course_description = ?,updated_at = NOW() where course_id = ?", [ 
            'ssi', $course_name, $course_description, $course_id
        ]);
    }

    public function delete()
    {
        $course_id =   $_POST['course_id'];
        return $this->db->_execute("delete from course_details where course_id = ?", [
            'i', $course_id
        ]);
    }

    public function getAllCourses()
    {
        return $this->db->fetchAll("select * from course_details order by course_name");
    }
}