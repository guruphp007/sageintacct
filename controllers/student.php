<?php

class Student extends BaseController {

    public function index()
    {
        $db = Database::getInstance(MYSQL_HOST, MYSQL_DATABASE, MYSQL_USERNAME, MYSQL_PASSWORD);

        $arrRows    =   $db->Select("select * from student_details order by firstname, lastname");
        $arrResult  =   [];
        $arrResult['result']    =   $arrRows;
        $arrResult['success']   =   true;

        $this->response($arrResult);
    }

    public function get()
    {
        $student_id =   $_GET['id'];
        $db = Database::getInstance(MYSQL_HOST, MYSQL_DATABASE, MYSQL_USERNAME, MYSQL_PASSWORD);

        $arrRows    =   $db->Select("select * from student_details where student_id = ?", [
            'i', $student_id
        ]);
        $arrResult  =   [];
        $arrResult['result']    =   $arrRows;
        $arrResult['success']   =   true;

        $this->response($arrResult);
    }
    
    public function create()
    {
        $db = Database::getInstance(MYSQL_HOST, MYSQL_DATABASE, MYSQL_USERNAME, MYSQL_PASSWORD);

        $firstname  =   $_POST['firstname'];
        $lastname   =   $_POST['lastname'];
        $dob        =   $_POST['dob'];
        $contact_no =   $_POST['contact_no'];

        $id    =   $db->Insert("INSERT INTO student_details (firstname,lastname,dob,contact_no,created_at) VALUES (?,?,?,?,NOW())", [
            'sssi', $firstname, $lastname, $dob, $contact_no
        ]);

        $arrResult  =   [];
        $arrResult['success']   =   true;

        $this->response($arrResult);
    }

    public function edit()
    {
        $db = Database::getInstance(MYSQL_HOST, MYSQL_DATABASE, MYSQL_USERNAME, MYSQL_PASSWORD);

        $firstname  =   $_POST['firstname'];
        $lastname   =   $_POST['lastname'];
        $dob        =   $_POST['dob'];
        $contact_no =   $_POST['contact_no'];
        $student_id =   $_POST['student_id'];

        $db->Update("update student_details set firstname = ?,lastname = ?,dob = ?,contact_no = ?,updated_at = NOW() where student_id = ?",[
            'sssii', $firstname, $lastname, $dob, $contact_no, $student_id
        ]);

        $arrResult  =   [];
        $arrResult['success']   =   true;

        $this->response($arrResult);
    }

    public function delete()
    {
        $db = Database::getInstance(MYSQL_HOST, MYSQL_DATABASE, MYSQL_USERNAME, MYSQL_PASSWORD);

        $student_id =   $_POST['student_id'];
        $arrRows    =   $db->Delete("delete from student_details where student_id = ?", [
            'i', $student_id
        ]);
        $arrResult  =   [];
        $arrResult['result']    =   $arrRows;
        $arrResult['success']   =   true;

        $this->response($arrResult);
    }
}