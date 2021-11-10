<?php

class Course extends BaseController {

    public function index()
    {
        $db = Database::getInstance(MYSQL_HOST, MYSQL_DATABASE, MYSQL_USERNAME, MYSQL_PASSWORD);

        $arrRows    =   $db->Select("select * from course_details order by course_name");
        $arrResult  =   [];
        $arrResult['result']    =   $arrRows;
        $arrResult['success']   =   true;

        $this->response($arrResult);
    }
    
    public function create()
    {
        $db = Database::getInstance(MYSQL_HOST, MYSQL_DATABASE, MYSQL_USERNAME, MYSQL_PASSWORD);

        $course_name  =   $_POST['course_name'];
        $course_description   =   $_POST['course_description'];

        $id    =   $db->Insert("INSERT INTO course_details (course_name,course_description,created_at) VALUES (?,?,NOW())", [
            'ss', $course_name, $course_description
        ]);

        $this->response($arrResult);
    }

    public function edit()
    {
        $db = Database::getInstance(MYSQL_HOST, MYSQL_DATABASE, MYSQL_USERNAME, MYSQL_PASSWORD);

        $course_name  =   $_POST['course_name'];
        $course_description   =   $_POST['course_description'];
        $course_id   =   $_POST['course_id'];

        $db->Update("update course_details set course_name = ?,course_description = ?,updated_at = NOW() where course_id = ?",[
            'ssi', $course_name, $course_description, $course_id
        ]);

        $this->response($arrResult);
    }

    public function delete()
    {
        $db = Database::getInstance(MYSQL_HOST, MYSQL_DATABASE, MYSQL_USERNAME, MYSQL_PASSWORD);

        $course_id =   $_POST['course_id'];
        $arrRows    =   $db->Delete("delete from course_details where course_id = ?", [
            'i', $course_id
        ]);
        $arrResult  =   [];
        $arrResult['result']    =   $arrRows;
        $arrResult['success']   =   true;

        $this->response($arrResult);
    }
}