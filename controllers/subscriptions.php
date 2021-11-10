<?php

class Subscriptions extends BaseController {

    public function index()
    {
        $db = Database::getInstance(MYSQL_HOST, MYSQL_DATABASE, MYSQL_USERNAME, MYSQL_PASSWORD);

        $arrRows    =   $db->Select("select * from course_subscriptions order by fk_course_id");
        $arrResult  =   [];
        $arrResult['result']    =   $arrRows;
        $arrResult['success']   =   true;

        $this->response($arrResult);
    }
    
    public function add()
    {
        $db = Database::getInstance(MYSQL_HOST, MYSQL_DATABASE, MYSQL_USERNAME, MYSQL_PASSWORD);

        $course_id  =   $_POST['course_id'];
        $student_id   =   $_POST['student_id'];

        $id    =   $db->Insert("INSERT INTO course_subscriptions (fk_student_id,fk_course_id,created_at) VALUES (?,?,NOW())", [
            'ii', $course_id, $student_id
        ]);

        $arrResult  =   [];
        $arrResult['success']   =   true;

        $this->response($arrResult);
    }
}